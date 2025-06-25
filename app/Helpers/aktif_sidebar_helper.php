<?php

if (!function_exists('isActive')) {
    function isActive(string $route): string
    {
        $uri = service('uri');
        return $uri->getSegment(1) === $route ? 'active' : '';
    }
}
