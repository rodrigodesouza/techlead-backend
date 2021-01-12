@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Livros / {{ (isset($livro->id)) ? 'Editar' : 'Cadastrar' }}
    </div>
    <div class="card-body">
        @if(isset($livro->id))
            {!! Form::model($livro ?? null, ['route' => ['controle.livros.update', $livro->id]]) !!}
            @method('put')
        @else
            @method('post')
            {!! Form::model($livro ?? null, ['route' => 'controle.livros.store']) !!}
        @endif
            <div class="form-group">
              <label for="nome">Nome</label>
              {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'aria-describedby' => "nomeHelp", 'maxlength' => 255, 'required']) !!}
              {{-- <small id="nomeHelp" class="form-text text-muted">Nome do livro</small> --}}
            </div>
            <div class="form-group">
              <label for="autor_id">Autor</label>
              {!! Form::select('autor_id', ['' => '']+$autors, null, ['class' => 'form-control select2', 'maxlength' => 255, 'required']) !!}
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                {!! Form::textarea('descricao', null, ['class' => 'form-control', 'rows' => 5]) !!}
              </div>
            <div class="form-group form-check">
              {!! Form::checkbox('ativo', 1, null, ['class' => 'form-check-input', 'id' => 'ativo']) !!}
              <label class="form-check-label" for="ativo">Publicar</label>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('controle.livros.index') }}" class="btn btn-default float-right">Calcelar</a>
        {!! Form::close() !!}
    </div>
  </div>
@endsection
@section('scripts')
    <script>
    $(document).ready(function() {
        $('.select2').select2({
            tags: true,
            placeholder: 'Nome do autor'
        });
    });
    </script>
@endsection
