<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'livro_id',
        'cliente_id',
        'status_pedido',
        'user_id',
        'prazo_devolucao',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}
