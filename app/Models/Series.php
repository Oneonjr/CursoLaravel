<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome','cover'];
    // protected $with = ['temporadas'];

    public function seasons()
    {
        return $this->hasMany(Season::class); // Uma serie tem varias temporadas. //RelicioEX
    }

    protected static function booted() // assim que esta model for inicializada irá ser feito este escopo.
    {
        self::addGlobalScope('ordered',function (Builder $queryBuilder){
            $queryBuilder->orderBy('nome');
        });
    }
}
