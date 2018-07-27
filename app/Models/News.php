<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    public function canEdit(User $user = null): bool
    {
        if ($user === null) {
            return false;
        }

        return $this->user_id == $user->id;
    }
}
