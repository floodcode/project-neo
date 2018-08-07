<?php

namespace App\Models;

use App\Core\Roles;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\UserAccess;

class Comment extends Model
{
    use UserAccess;

    protected $table = 'comments';

    protected function getAccessRole(): int
    {
        return Roles::ROLE_MODERATOR;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
