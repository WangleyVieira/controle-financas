<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsavel extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'cadastrado_por_usuario'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'cadastrado_por_usuario');
    }
}
