<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['numero'];

    public function series( )
    {
       return $this->belongsTo(Series::class); //Pertence � uma serie. //RelicioEX

    }

    public function episodes( )
    {
        return $this->hasMany(Episode::class);
    }
}
