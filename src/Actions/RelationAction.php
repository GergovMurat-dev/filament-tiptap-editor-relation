<?php

namespace FilamentTiptapEditor\Actions;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use FilamentTiptapEditor\Services\RelationSearchProvider;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\HtmlString;

class RelationAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'filament_tiptap_relation';
    }

    protected function setUp(): void
    {
        parent::setUp();

        /** @var RelationSearchProvider $service */
        $service = app(config('filament-tiptap-editor.search_provider'));

        $this
            ->modalWidth('lg')
            ->arguments([
                'target' => '',
            ])
            ->mountUsing(function (ComponentContainer $form, array $arguments) {
                $form->fill([
                    'target' => $arguments['target'] ?? $arguments['selectedText'] ?? ''
                ]);
            })
            ->modalHeading(function () {
                return "Связанный текст";
            })
            ->form([
                Select::make('target')
                    ->live()
                    ->label('Связь')
                    ->native(false)
                    ->required()
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search) use ($service) {
                        return $service->search($search);
                    })
                    ->rule("regex:{$service::getUuidPattern()}")
                    ->options(function (Get $get) use ($service) {
                        $state = $get('target');

                        $pattern = $service::getUuidPattern();

                        if ($state === null) {
                            return [];
                        }

                        return preg_match($pattern, $state)
                            ? $service->parseModel($state)
                            : $service->search($state);
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
            })
            ->extraModalFooterActions(function (Action $action): array {
                if ($action->getArguments()['target']) {
                    return [
                        $action->makeModalSubmitAction('remove_relation', [])
                            ->label('Удалить')
                            ->color('danger')
                            ->extraAttributes(function () use ($action) {
                                return [
                                    'x-on:click' => new HtmlString("\$dispatch('unset-relation', {'statePath': '{$action->getComponent()->getStatePath()}'}); close()")
                                ];
                            }),
                    ];
                }

                return [];
            });;
    }
}
