<?php

namespace FilamentTiptapEditor\Actions;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
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
                'title' => ''
            ])
            ->mountUsing(function (ComponentContainer $form, array $arguments) {
                $form->fill($arguments);
            })
            ->modalHeading(function () {
                return "Линкованный текст";
            })
            ->form([
                TextInput::make('title')
            ])
            ->action(function (TiptapEditor $component, $data, $arguments) {
                $component->getLivewire()->dispatch(
                    event: 'insertFromAction',
                    type: 'relation',
                    statePath: $component->getStatePath(),
                    title: $data['title'],
                    coordinates: $arguments['coordinates'],
                );

                $component->state($component->getState());
            });
    }
}