<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cnpj', 'nome_fantasia', 'razao_social', 'email', 'logomarca', 'status'
    ];

    public function unidades()
    {
        return $this->hasMany(Unidade::class);
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
