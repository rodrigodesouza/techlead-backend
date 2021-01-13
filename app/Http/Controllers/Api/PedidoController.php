<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PedidoRepository;

class PedidoController extends Controller
{
    public function __construct(PedidoRepository $pedidoRepository)
    {
        $this->pedidoRepository = $pedidoRepository;
    }

    public function solicitaLivro()
    {
        return $this->pedidoRepository->solicitaLivro();
    }
    public function devolverLivro()
    {
        $id = request()->get('pedido_id');
        return $this->pedidoRepository->alteraStatus($id, 'devolvido');
    }

    public function index()
    {
        $input = request()->all();
        $input['cliente_id'] = request()->user()->id;
        $order = $input['order'] ?? 'desc';
        $limit = $input['limit'] ?? 15;

        return $this->pedidoRepository->pedidos($input, $limit, $order);
    }

    /**
     * Retorna a lista de livros emprestados ao cliente
     */
    public function emprestados()
    {
        $cliente_id = request()->user()->id;
        return $this->pedidoRepository->pedidos(['cliente_id'  => $cliente_id, 'status_pedido' => 'aprovado'], 20, 'desc');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
