<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{
    protected $table = 'apartamentos';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'predio_id', 'finalidade_id', 'andar', 'numero', 'quartos', 'banheiros', 'metros', 'status'
    ];

    public function finalidade()
    {
        return $this->belongsTo(Finalidade::class, 'finalidade_id');
    }

    public function predio()
    {
        return $this->belongsTo(Predio::class, 'predio_id');
    }
}
