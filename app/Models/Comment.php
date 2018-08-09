<?php

namespace App\Models;

use App\Core\Roles;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\HasUser;

class Comment extends Model
{
    use HasUser;

    protected $table = 'comments';

    protected function getAccessRole(): int
    {
        return Roles::ROLE_MODERATOR;
    }

}
