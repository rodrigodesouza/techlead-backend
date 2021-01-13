<div class="list-group list-group-flush">
    <a href="{{ route('controle.dashboard') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
    <a href="{{ route('controle.livros.index') }}" class="list-group-item list-group-item-action bg-light">Livros</a>
    <a href="{{ route('controle.pedidos.index') }}" class="list-group-item list-group-item-action bg-light">Pedidos</a>

    <a class="list-group-item list-group-item-action bg-light" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Controle de acesso &#9660;
    </a>
    <div class="collapse" id="collapseExample">
        <a href="javascript:;" class="list-group-item list-group-item-action bg-light">Usuários</a>
        <a href="javascript:;" class="list-group-item list-group-item-action bg-light">Permissões</a>
    </div>
</div>
