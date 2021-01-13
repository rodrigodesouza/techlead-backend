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

    public function scopeFilter($query, $input)
    {
        if (isset($input['cliente_id'])) {
            $query->where('pedidos.cliente_id', $input['cliente_id']);
        }
        if (isset($input['status_pedido'])) {
            $query->where('pedidos.status_pedido', $input['status_pedido']);
        }
        if (isset($input['nome'])) {
            $query->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id')
            ->where('clientes.name', 'like', "%". $input['nome'] . "%")
            ->select('pedidos.*', 'clientes.name');
        }
        return $query;
    }
}
