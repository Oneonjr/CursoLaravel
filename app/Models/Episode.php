<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['numero'];

    public function temporadas()
    {
        return $this->belongsTo(Season::class);
    }
}
