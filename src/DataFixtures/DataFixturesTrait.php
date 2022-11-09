<?php

namespace App\DataFixtures;

use JsonException;

trait DataFixturesTrait
{
    /**
     * @throws JsonException
     */
    protected function loadData(string $fileName): array
    {
        return json_decode(file_get_contents(
            __DIR__ . '/' . $fileName . '.json'),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
    }
}