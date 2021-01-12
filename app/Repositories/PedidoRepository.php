<?php

namespace App\Repositories;

use App\Models\Pedido;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoRepository
{
    private $model;

    public function __construct(Pedido $pedido, LivroRepository $livroRepository)
    {
        $this->model = $pedido;
        $this->maximoEmprestimo = 5;
        $this->livroRepository = $livroRepository;
        $this->livro = $this->livroRepository->getLivroModel();
    }

    public function solicitaLivro()
    {
        DB::beginTransaction();

        try {
            $input = request()->all();
            if ($this->totalEmprestados() >= $this->maximoEmprestimo) {
                return response()->json([
                    'message' => "Você só pode emprestar no máximo $this->maximoEmprestimo livros.",
                    'error' => true
                ]);
            }

            if (!$this->livro->find($input['livro_id'])) {
                return response()->json([
                    'message' => "Livro não encontrado!",
                    'error' => true
                ], 404);
            }

            $solicitacao = $this->model->create([
                'cliente_id'    => request()->user()->id,
                'livro_id'      => $input['livro_id'],
                'status_pedido' => 'solicitado',
            ]);

            DB::commit();

            return response()->json([
                'solicitacao' => $solicitacao->only(['status_pedido', 'created_at', 'updated_at']),
                'message' => "Sua solicitação foi enviada! Avisaremos você em breve.",
            ], 201);

        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();

            return response()->json([
                    'message' => "Houve um erro ao solicitar o pedido.",
                    'error' => true
                ], 500);
        }

    }

    protected function totalEmprestados()
    {
        return $this->model->where('cliente_id', request()->user()->id)->where('status_pedido', 'aprovado')->count();
    }

    public function pedidos()
    {
        return $this->model->orderBy('created_at', 'asc')->paginate(5);
    }
}
