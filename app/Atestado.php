<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atestado extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unidade_id', 'paciente_id', 'acompanhante_id', 'obito_id'
    ];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function acompanhante()
    {
        return $this->belongsTo(Acompanhante::class);
    }

    public function obito()
    {
        return $this->belongsTo(Obito::class);
    }
}
