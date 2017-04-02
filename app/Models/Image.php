<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{

    use SoftDeletes;

  //  protected $softDelete = true;

    protected $dates = ['deleted_at'];

    public static $rules = [
        'file.*' => 'required | mimes:png,gif,jpeg,jpg,bmp'
    ];

    public static $messages = [
        'file.*.mimes' => 'Uploaded file is not in image format',
        'file.required' => 'Image is required'
    ];
}
