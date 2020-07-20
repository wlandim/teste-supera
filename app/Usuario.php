<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_id', 'cpf', 'nome', 'usuario'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
