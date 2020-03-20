<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    protected $table = 'predios';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'nome', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep'
    ];

    public function setCepAttribute($value)
    {
        $this->attributes['cep'] = str_replace(['.', '-', ' ',], ['','',''], $value);
    }

    public function apartamentos()
    {
        return $this->hasMany(Apartamento::class, 'predio_id');
    }
}
