<?php

namespace FilamentTiptapEditor\Actions;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use FilamentTiptapEditor\Services\RelationSearchProvider;
use FilamentTiptapEditor\TiptapEditor;

class RelationAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'filament_tiptap_relation';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->modalWidth('lg')
            ->arguments([
                'target' => '',
            ])
            ->mountUsing(function (ComponentContainer $form, array $arguments) {
                $form->fill([
                    'target' => $arguments['target']
                ]);
            })
            ->modalHeading(function () {
                return "Связанный текст";
            })
            ->form([
                Select::make('target')
                    ->native(false)
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search) {
                        /** @var RelationSearchProvider $service */
                        $service = app(config('filament-tiptap-editor.search_provider'));

                        return $service->search($search);
                    })
                    ->options(function (string $state) {
                        /** @var RelationSearchProvider $service */
                        $service = app(config('filament-tiptap-editor.search_provider'));

                        return $service->parseModel($state);
                    })
            ])
            ->action(function (TiptapEditor $component, $data, $arguments) {
                $component->getLivewire()->dispatch(
                    event: 'insertFromAction',
                    type: 'relation',
                    statePath: $component->getStatePath(),
                    target: $data['target'],
                    coordinates: $arguments['coordinates'],
                );

                $component->state($component->getState());
            });
    }
}
