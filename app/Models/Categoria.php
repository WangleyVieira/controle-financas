<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $fillable = ['descricao', 'tipo_categoria_id', 'cadastradoPorUsuario'];

    public function tipoCategoria()
    {
        return $this->belongsTo(TipoCategoria::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }
}
