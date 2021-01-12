@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Livros
      <a href="{{ route('controle.livros.create') }}" class="btn btn-success float-right">Cadastrar</a>
    </div>
    <div class="card-body">
      <table class="table">
          <thead>
            <tr>
                <th>#ID</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Disponível</th>
                <th>Publicado</th>
                <th>Data de cadastro</th>
                <th>Opções</th>
            </tr>
          </thead>
          <tbody>
              @forelse ($livros as $livro)
                <tr>
                    <td>{{ $livro->id }}</td>
                    <td>{{ $livro->nome }}</td>
                    <td>{{ $livro->autor->nome ?? '' }}</td>
                    <td>
                        <span class="badge badge-{{ $livro->status == 'disponivel' ? 'success' : 'danger' }}">
                            {{ ucfirst($livro->status) }}
                        </span>
                    </td>
                    <td>{{ ($livro->ativo) ? 'SIM' : 'NÃO' }}</td>
                    <td>{{ $livro->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('controle.livros.destroy', $livro->id) }}" method="POST">
                            <a href="{{ route('controle.livros.edit', $livro->id) }}" class="btn btn-primary">Editar</a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger atencao">Excluir</button>
                        </form>
                    </td>
                </tr>
              @empty
                  <tr>
                      <td colspan="7">Nenhum livro cadastrado.</td>
                  </tr>
              @endforelse
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="7">{!! $livros->links() !!}</td>
              </tr>
          </tfoot>
      </table>
    </div>
</div>
@endsection
