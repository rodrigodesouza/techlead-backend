<?php

function statusPedidoCor($status) {
    $cores = [
        'solicitado' => 'primary',
        'aprovado' => 'success',
        'negado' => 'danger',
        'devolvido' => 'secondary'
    ];

    return $cores[$status] ?? '';
}
