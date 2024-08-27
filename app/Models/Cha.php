<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cha extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_from',
        'name_from',
        'id_to',
        'name_to',
        'chatroom',
        'message'
    ];
}
