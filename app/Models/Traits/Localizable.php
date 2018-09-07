<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Expr\AssignOp\Mod;

trait Localizable
{
    protected $l10nData = null;
    protected $l10nRelevant = null;
    protected $locale = null;

    protected $localeFallbackMapping = [
        'en' => 'ru',
        'ru' => 'uk',
        'uk' => 'ru'
    ];

    public function l10n(?string $locale = null): Model
    {
        $locale = $locale ?? $this->getLocale();

        $this->fetchTranslations();
        if (array_key_exists($locale, $this->l10nData)) {
            return $this->l10nData[$locale];
        }

        $l10nModelName = $this->l10nModelName();
        $l10nModel = new $l10nModelName();
        $l10nModel->locale = $locale;

        $this->l10nData[$locale] = $l10nModel;

        return $l10nModel;
    }

    public function l10nRelevant(): Model
    {
        if ($this->l10nRelevant !== null) {
            return $this->l10nRelevant;
        }

        $l10nModel = $this->l10n();
        if (!$l10nModel->isDirty()) {
            return $l10nModel;
        }

        $fallbackLocale = $this->localeFallbackMapping[$l10nModel->locale] ?? $l10nModel->locale;
        $relevantModel = null;
        foreach ($this->l10nData as $item) {
            if ($item->locale == $fallbackLocale) {
                $relevantModel = $item;
                break;
            }

            if ($item->created_at) {
                if ($relevantModel) {
                    if ($item->created_at->lt($relevantModel)) {
                        $relevantModel = $item;
                    }
                } else {
                    $relevantModel = $item;
                }
            }
        }

        if ($relevantModel !== null) {
            $this->l10nRelevant = $relevantModel;
            return $relevantModel;
        }

        return $l10nModel;
    }

    public function save(array $options = []): bool
    {
        $result = parent::save($options);

        if ($result) {
            $idColumn = $this->l10nIdColumn();
            $this->l10n()->$idColumn = $this->id;
            $this->l10n()->save();
        }

        return $result;
    }

    public function isTranslated(): bool
    {
        $l10nModel = $this->l10n();
        return !$l10nModel->isDirty();
    }

    public function scopeTranslated(Builder $query): Builder
    {
        $locale = $this->getLocale();

        return $query->whereHas('translations', function (Builder $q) use ($locale) {
            $q->where('locale', '=', $locale);
        });
    }

    public function translations(): HasMany
    {
        return $this->hasMany($this->l10nModelName());
    }

    public function setLocale(string $locale = null)
    {
        $this->locale = $locale;
    }

    public function getLocale(): string
    {
        if (!$this->locale) {
            $this->locale = app()->getLocale();
        }

        return $this->locale;
    }

    protected function fetchTranslations(bool $force = false)
    {
        if (!$force && $this->l10nData != null) {
            return;
        }

        $l10nData = [];
        foreach ($this->translations as $item) {
            $l10nData[$item->locale] = $item;
        }

        $this->l10nData = $l10nData;
    }

    protected function l10nModelName(): string
    {
        return get_class($this) . 'L10n';
    }

    protected function l10nTable(): string
    {
        return $this->table . '_l10n';
    }

    protected function l10nIdColumn(): string
    {
        return $this->table . '_id';
    }
}