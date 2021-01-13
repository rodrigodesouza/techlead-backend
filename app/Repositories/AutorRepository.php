<?php

namespace App\Repositories;

use App\Models\Autor;

class AutorRepository
{
    private $model;

    public function __construct(Autor $autor)
    {
        $this->model = $autor;
    }

    public function getAutor($input): int
    {
        if (!is_numeric($input['autor_id'])) {
            $autor = $this->model->updateOrCreate([
                'nome' => $input['autor_id']
            ], [
                'nome' => $input['autor_id']
            ]);
            $input['autor_id'] = $autor->id;
        }

        return $input['autor_id'];
    }
}
