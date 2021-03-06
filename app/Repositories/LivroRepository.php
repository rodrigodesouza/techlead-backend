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
        return $this->model
                ->with('autor')
                ->where('livros.ativo', 1)
                ->get();
    }

    public function livroDisponivel($id)
    {
        return $this->model->where('ativo', 1)->where('status', 'disponivel')->where('id', $id)->first();
    }
}
