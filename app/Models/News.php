<?php

namespace App\Models;

use App\Core\Roles;
use App\Models\Traits\HasUser;
use App\Models\Traits\Localizable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Localizable;
    use HasUser;

    protected $table = 'news';

    protected function getAccessRole(): int
    {
        return Roles::ROLE_ADMIN;
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function scopeByCategory(Builder $query, $categoryId): Builder
    {
        return $query->where('category_id', '=', $categoryId);
    }
}
