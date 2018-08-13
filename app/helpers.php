<?php

function includeScript(string $path): string
{
    return '<script src="' . $path . '?version=' . config('app.version') . '"></script>';
}

function includeExternalScript(string $path): string
{
    return '<script src="' . $path . '"></script>';
}

function includeStyle(string $path): string
{
    return '<link rel="stylesheet" href="' . $path . '?version=' . config('app.version') . '">';
}

function includeExternalStyle(string $path): string
{
    return '<link rel="stylesheet" href="' . $path . '">';
}

function recaptchaAvailable(): bool
{
    return !empty(config('recaptcha.key')) && !empty(config('recaptcha.secret'));
}

function userHasRole(string $roleName): bool
{
    $user = auth()->user();
    if (!$user) {
        return false;
    }

    return $user->hasRoleName($roleName);
}