<?php

namespace FilamentTiptapEditor\Extensions\Marks;

use Tiptap\Marks\Link;
use Tiptap\Utils\HTML;

class Relation extends Link
{
    public static $name = 'relation';

    public function addOptions(): array
    {
        return [
            'openOnClick' => true,
            'linkOnPaste' => true,
            'autoLink' => false,
            'protocols' => [],
            'HTMLAttributes' => [
                'target' => null,
                'model' => null,
                'id' => null,
            ],
        ];
    }

    public function addAttributes(): array
    {
        return [
            'target' => [
                'default' => $this->options['HTMLAttributes']['target'],
                'parseHTML' => function ($DOMNode) {
                    return $DOMNode->getAttribute('target');
                }
            ],
            'model' => [
                'default' => $this->options['HTMLAttributes']['model'],
            ],
            'id' => [
                'default' => $this->options['HTMLAttributes']['id'],
            ]
        ];
    }

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'relation'
            ]
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = []): array
    {
        return [
            'relation',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0
        ];
    }
}