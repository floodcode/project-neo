<?php

namespace App\Models;

use App\Models\Traits\Localizable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Localizable;

    protected $table = 'category';

    const NO_CATEGORY = -1;
}
