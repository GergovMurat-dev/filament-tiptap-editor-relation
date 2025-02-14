<?php

namespace FilamentTiptapEditor\Services;

interface RelationSearchProvider
{
    public function search(string $input): array;

    public function parseModel(string $uuid): array;
}