<?php

namespace App\Repositories;

use App\Models\Livro;
use Illuminate\Support\Facades\DB;

class LivroRepository
{
    private $model;

    public function getLivroModel()
    {
        return $this->model;
    }

    public function __construct(Livro $livro)
    {
        $this->model = $livro;
    }

    public function livrosDisponiveis()
    {
        // dd();
        return $this->model->select(DB::raw('DISTINCT livros.id'), 'livros.*', 'pedidos.cliente_id as solicitado')->leftJoin('pedidos', function($join) {
                $join->on('livros.id', '=', 'pedidos.livro_id')
                     ->where('pedidos.cliente_id', request()->user()->id);
                })
                ->where('livros.ativo', 1)
                // ->groupBy('livros.id')
                ->get();
    }

    public function livroDisponivel($id)
    {
        return $this->model->where('ativo', 1)->where('status', 'disponivel')->where('id', $id)->first();
    }
}
