<?php

namespace App\Core;

class Locale
{
    const DEFAULT_LOCALE = 'uk';

    const PSEUDO_LOCALE = 'ach';

    /**
     * Available locales
     */
    protected static $locales = [
        'uk' => 'uk',
        'en' => 'en',
        'ru' => 'ru',
        'ach' => 'translate'
    ];

    public static function init()
    {
        $host = request()->getHttpHost();
        $locale = self::getLocaleByHost($host);
        app()->setLocale($locale);
    }

    public static function getLocales(): array
    {
        return array_keys(self::$locales) - [self::PSEUDO_LOCALE];
    }

    public static function getSubdomains(): array
    {
        return array_values(array_filter(self::$locales));
    }

    public static function getLocaleByHost(string $host): string
    {
        preg_match('/([a-z]+)\..+/', $host, $matches);
        if (!count($matches))
        {
            return self::DEFAULT_LOCALE;
        }

        $subdomain = $matches[1];
        $subdomains = array_flip(self::$locales);
        if (array_key_exists($subdomain, $subdomains)) {
            return $subdomains[$subdomain];
        }

        return self::DEFAULT_LOCALE;
    }
}