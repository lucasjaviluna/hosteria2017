<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

    const TYPE_LIST = 'list';
    const TYPE_CUSTOM = 'custom';

    protected $dates = ['deleted_at'];
}
