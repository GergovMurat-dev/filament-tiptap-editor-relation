<?php

namespace FilamentTiptapEditor\Services;

interface RelationSearchProvider
{
    public function search(string $input, ?array $options = null): array;

    public function parseModel(?string $uuid): array;

    public static function getUuidPattern(): string;

    public static function validateRoute(): string;
}