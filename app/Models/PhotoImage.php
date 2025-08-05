<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'photo_id',
        'image'
    ];
}
