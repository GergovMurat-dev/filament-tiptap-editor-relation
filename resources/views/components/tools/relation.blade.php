@props([
    'statePath' => null,
    'icon' => 'redo',
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

            let { from, to } = this.editor().view.state.selection;

            let text = this.editor().view.state.doc.textBetween(from, to);

            let arguments = {
                target: relation.target || null,
                coordinates: this.editor().view.state.selection.ranges,
                selectedText: text || null
            };

            $wire.dispatchFormEvent('tiptap::setRelationContent', '{{ $statePath }}', arguments);
        }
    }"
/>
