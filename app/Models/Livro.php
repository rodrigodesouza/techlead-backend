<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'autor_id',
        'descricao',
        'status',
        'ativo',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }
}
