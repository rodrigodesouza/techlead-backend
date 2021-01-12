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

    protected $appends = ['resumo'];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

    public function getResumoAttribute()
    {
        return $this->attributes['resumo'] = \Str::limit($this->attributes['descricao'], 100, '...');
    }
}
