@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Pedidos
      {{-- <a href="{{ route('controle.livros.create') }}" class="btn btn-success float-right">Cadastrar</a> --}}
    </div>
    <div class="card-body">

        @livewire('pedido.show', ['pedidos' => $pedidos])

    </div>
</div>
@endsection
