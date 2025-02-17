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
            let link = thi.editor().getAttributes('link')

            console.log(relation, link)

            let arguments = {
                title: 'Какой-то рандомный текст',
                coordinates: this.editor().view.state.selection.ranges,
            };

            $wire.dispatchFormEvent('tiptap::setRelationContent', '{{ $statePath }}', arguments);
        }
    }"
/>
