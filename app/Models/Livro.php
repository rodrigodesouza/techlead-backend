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

    protected $appends = ['resumo', 'status_disponivel'];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

    public function getResumoAttribute()
    {
        return $this->attributes['resumo'] = \Str::limit($this->attributes['descricao'], 100, '...');
    }

    public function getStatusDisponivelAttribute()
    {
        // retorna status para mudança do botão no site; se pode ou não solicitar, se foi aprovado ou livro indisponível.
        // disponivel: livro com status 'disponivel' e nenhuma pedido 'solicitado' do usuario atual
        $status = 'disponivel';

        if ($this->status == 'indisponivel') {
            $solicitacao = Pedido::where('livro_id', $this->id)
                            ->where('status_pedido', 'aprovado')
                            ->orderBy('pedidos.id', 'desc')
                            ->first();

            //indisponivel: há um pedido 'aprovado' com cliente_id != do cliente atual
            if ($solicitacao->cliente_id != request()->user()->id) {
                $status = 'indisponivel';
            }
            // solicitado_aprovado: há um pedido 'aprovado' com cliente_id = cliente atual
            if ($solicitacao->cliente_id == request()->user()->id) {
                $status = 'solicitado_aprovado';
            }
        } else {
            $solicitacao = Pedido::where('livro_id', $this->id)
                            ->where('status_pedido', 'solicitado')
                            ->where('cliente_id', request()->user()->id)
                            ->orderBy('pedidos.id', 'desc')
                            ->first();

            // solicitado: há um pedido 'solicitado' com cliente_id = cliente atual
            if (isset($solicitacao->id)) {
                $status = 'solicitado';
            }
        }

        return $status;
    }

}
