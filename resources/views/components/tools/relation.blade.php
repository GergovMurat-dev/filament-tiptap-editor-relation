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
            let relation = this.editor().getAttributes('relation');

            let arguments = {
                target: relation.target || null,
                coordinates: this.editor().view.state.selection.ranges,
            };

            $wire.dispatchFormEvent('tiptap::setRelationContent', '{{ $statePath }}', arguments);
        }
    }"
/>
