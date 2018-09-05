<?php

namespace App\Models;

use App\Core\Roles;
use App\Models\Traits\HasUser;
use App\Models\Traits\Localizable;
use Illuminate\Database\Eloquent\Model;

class NewsL10n extends Model
{
    protected $table = 'news_l10n';
}
