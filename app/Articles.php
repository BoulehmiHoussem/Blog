<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
     protected $fillable = [
        'title', 'body', 'created_by',
    ];
}
