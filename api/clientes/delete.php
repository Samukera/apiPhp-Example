<?php

if ($acao == '' && $param == '') {
    echo json_encode(['ERROR' => 'Caminho não encontrado!']);
}

if($acao == 'deleta' && $param == '') {
    echo json_encode(['ERROR' => 'É necessário um cliente']);
}
if($acao == 'deleta' && $param != '') {
    

    $db = DB::connect();
    $rs = $db->prepare("DELETE FROM clientes WHERE id = {$param}");
    $exec = $rs->execute();

    if($exec) {
        echo json_encode(["Dados" => 'Dados foram removidos com sucesso.']);
    } else {
        echo json_encode(["Dados" => 'Houve algum erro na remoção dos dados.']);
    }
}