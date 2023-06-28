<?php

if (! function_exists('getPaginatedResourceData')) {
    function getPaginatedResourceData(mixed $resource): array
    {
        return [
            'items' => $resource['data'],
            'total' => $resource['meta']['total'],
        ];
    }
}
