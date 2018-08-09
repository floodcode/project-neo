<?php

namespace App\Models;

use App\Core\Roles;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\HasUser;

class News extends Model
{
    use HasUser;

    protected $table = 'news';

    protected function getAccessRole(): int
    {
        return Roles::ROLE_ADMIN;
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
