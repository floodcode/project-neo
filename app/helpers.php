<?php

/**
 * CDN might be used in future
 */
function includeScript(string $path): string
{
    return '<script src="' . $path . '"></script>';
}

function includeExternalScript(string $path): string
{
    return '<script src="' . $path . '"></script>';
}

/**
 * CDN might be used in future
 */
function includeStyle(string $path): string
{
    return '<link rel="stylesheet" href="' . $path . '">';
}

function includeExternalStyle(string $path): string
{
    return '<link rel="stylesheet" href="' . $path . '">';
}

function recaptchaAvailable(): bool
{
    return !empty(config('recaptcha.key')) && !empty(config('recaptcha.secret'));
}