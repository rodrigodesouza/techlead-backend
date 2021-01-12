<?php

namespace App\Repositories;

use App\Models\Pedido;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoRepository
{
    private $model;

    public function getModel()
    {
        return $this->model;
    }

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
            $livro = $this->livro->find($input['livro_id']);

            if (!$livro) {
                return response()->json([
                    'message' => "Livro não encontrado!",
                    'error' => true
                ], 404);
            }

            if ($livro->status == 'indisponivel') {
                // segurança para não solicitar livro indisponível
                return response()->json([
                    'message' => "Livro não disponível!",
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

    public function alteraStatus($id, $status)
    {
        DB::beginTransaction();
        try {
            $pedido = $this->getModel()->find($id);

            if ($status == 'aprovado') {
                // $livro = $this->livroRepository->getLivroModel()->where('status', 'disponivel')
                //                         ->where('id', $pedido->livro_id)->update(['status' => 'indisponivel']);
                if (isset($pedido->livro->id) and $pedido->livro->status == 'disponivel') {
                    $this->getModel()
                            ->where('livro_id', $pedido->livro_id)
                            ->where('id', '!=', $id)
                            ->where('status_pedido', 'solicitado')
                            ->update(['status_pedido' => 'negado']);

                    $pedido->livro->update(['status' => 'indisponivel']);
                    $pedido->update(['status_pedido' => $status]);
                }
            } else if ($status == 'devolvido') {
                $pedido->livro->update(['status' => 'disponivel']);
                $pedido->update(['status_pedido' => $status]);
            } else {
                $pedido->update(['status_pedido' => $status]);
            }

            DB::commit();

            return $pedido;

        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
            throw $e;
        }
    }
}
