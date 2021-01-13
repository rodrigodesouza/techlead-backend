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
                  <span class="badge badge-{{ statusPedidoCor($pedido->status_pedido) }} text-white">
                      {{ ucfirst($pedido->status_pedido) }}
                  </span>
              </td>
              <td>{{ $pedido->created_at->format('d/m/Y \à\s H:i') }}</td>
              <td>

                  @if($pedido->status_pedido == 'solicitado')
                    @if ($pedido->total_aprovado < 5)
                        <a href="javascript:void()" wire:click.prevent="alteraStatus({{ $pedido->id }}, 'aprovado')" class="btn btn-primary" disabled="{{ ($pedido->status_pedido == 'aprovado') ?  true : false }}">Aprovar</a>
                    @else
                        <button class="btn btn-warning">({{ $pedido->total_aprovado }}) emprestados</button>
                    @endif
                    <a href="javascript:void()" wire:click.prevent="alteraStatus({{ $pedido->id }}, 'negado')" class="btn btn-danger" disabled="{{ ($pedido->status_pedido == 'negado') ?  true : false }}">Recusar</a>
                  @endif
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
