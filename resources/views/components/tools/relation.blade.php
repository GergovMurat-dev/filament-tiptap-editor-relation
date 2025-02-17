@props([
    'statePath' => null,
    'icon' => 'link',
    'label' => 'Отношение',
    'active' => true,
])

@php
    $useActive = $active ? 'relation' : false;
@endphp

<x-filament-tiptap-editor::button
    action="openModal()"
    :active="$useActive"
    :label="$label"
    :icon="$icon"
    x-data="{
        openModal() {
            let arguments = {
                title: 'Какой-то рандомный текст',
                coordinates: this.editor().view.state.selection.ranges,
            };

            $wire.dispatchFormEvent('tiptap::setRelationContent', '{{ $statePath }}', arguments);
        }
    }"
/>
