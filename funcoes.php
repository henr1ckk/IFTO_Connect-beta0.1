<?php
function tempoDesde($dataPostagem) {
    date_default_timezone_set('America/Sao_Paulo'); // Defina o fuso horário correto
    $dataPostagem = new DateTime($dataPostagem);
    $agora = new DateTime();
    $diferenca = $agora->diff($dataPostagem);

    if ($diferenca->y > 0) {
        return $diferenca->y . ' ano' . ($diferenca->y > 1 ? 's' : '') . ' atrás';
    } elseif ($diferenca->m > 0) {
        return $diferenca->m . ' mês' . ($diferenca->m > 1 ? 'es' : '') . ' atrás';
    } elseif ($diferenca->d > 0) {
        return $diferenca->d . ' dia' . ($diferenca->d > 1 ? 's' : '') . ' atrás';
    } elseif ($diferenca->h > 0) {
        return $diferenca->h . ' hora' . ($diferenca->h > 1 ? 's' : '') . ' atrás';
    } elseif ($diferenca->i > 0) {
        return $diferenca->i . ' minuto' . ($diferenca->i > 1 ? 's' : '') . ' atrás';
    } else {
        return 'agora mesmo';
    }
}
?>
