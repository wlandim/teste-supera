<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_id', 'municipio', 'email', 'logomarca', 'tipo', 'status'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function atestados()
    {
        return $this->hasMany(Atestado::class);
    }
}
