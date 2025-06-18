<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonces extends Model
{
 /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'titre',
        'description',
        'photographie',
        'prix'
    ];

}
