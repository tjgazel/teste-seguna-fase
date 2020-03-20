<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finalidade extends Model
{
    protected $table = 'finalidades';

    public $timestamps = false;

    protected $fillable = ['descricao'];

    public function apartamentos()
    {
        return $this->hasMany(Apartamento::class, 'finalidade_id');
    }
}
