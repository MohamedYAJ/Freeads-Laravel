<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photos extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'annonce_id'];

    public function annonce()
    {  
        return $this->belongsTo(Annonce::class);
    }
}
