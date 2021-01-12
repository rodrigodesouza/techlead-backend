@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Pedidos
      {{-- <a href="{{ route('controle.livros.create') }}" class="btn btn-success float-right">Cadastrar</a> --}}
    </div>
    <div class="card-body">
      <table class="table">
          <thead>
            <tr>
                <th>#ID</th>
                <th>Cliente</th>
                <th>Titulo</th>
                {{-- <th>Autor</th> --}}
                <th>Status</th>
                <th>Data do pedido</th>
                <th>Opções</th>
            </tr>
          </thead>
          <tbody>
              @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente->name ?? '' }}</td>
                    <td>{{ $pedido->livro->nome ?? '' }}</td>
                    {{-- <td>{{ $pedido->autor->nome ?? '' }}</td> --}}
                    <td>
                        <label class="badge badge-info text-white">
                            {{ $pedido->status_pedido }}
                        </label>
                    </td>
                    <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('controle.livros.edit', $pedido->id) }}" class="btn btn-primary">Aprovar</a>
                        <a href="{{ route('controle.livros.edit', $pedido->id) }}" class="btn btn-danger">Recusar</a>
                        {{-- <form action="{{ route('controle.livros.destroy', $pedido->id) }}" method="POST">
                            <a href="{{ route('controle.livros.edit', $pedido->id) }}" class="btn btn-primary">Editar</a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger atencao">Excluir</button>
                        </form> --}}
                    </td>
                </tr>
              @empty
                  <tr>
                      <td colspan="6">Nenhum pedido encontrado.</td>
                  </tr>
              @endforelse
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="6">{!! $pedidos->links() !!}</td>
              </tr>
          </tfoot>
      </table>
    </div>
</div>
@endsection
