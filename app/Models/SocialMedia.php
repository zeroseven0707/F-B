<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $guarded = ['id'];
    protected $hidden = [
        'web_id',
    ];
    use HasFactory;
}
