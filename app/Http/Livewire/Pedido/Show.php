<?php

namespace App\Http\Livewire\Pedido;

use App\Models\Livro;
use App\Repositories\LivroRepository;
use App\Repositories\PedidoRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public function render(PedidoRepository $pedidoRepository)
    {
        $filtro = request()->all();
        $pedidos = $pedidoRepository->pedidos($filtro, 15, 'desc');

        return view('livewire.pedido.show', ['pedidos' => $pedidos, 'filtro' => $filtro]);
    }

    public function alteraStatus(PedidoRepository $pedidoRepository, $id, $status)
    {
        return $pedidoRepository->alteraStatus($id, $status);
    }
}
