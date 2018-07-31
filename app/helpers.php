<?php

function includeAsset(string $path)
{
    return '<script src="' . $path . '"></script>';
}

function includeStyle(string $path)
{
    return '<link rel="stylesheet" href="' . $path . '">';
}