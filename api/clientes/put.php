<?php

if ($acao == '' && $param == '') {
    echo json_encode(['ERROR' => 'Caminho não encontrado!']);
}

if($acao == 'atualiza' && $param == '') {
    echo json_encode(['ERROR' => 'É necessário um cliente']);
}
if($acao == 'atualiza' && $param != '') {
    array_shift($_POST);

    $sql = "UPDATE clientes SET ";
    $cont = 1;

    foreach (array_keys($_POST) as $indice){
        if(count($_POST) > $cont) {
            $sql .= "{$indice} = '{$_POST[$indice]}', ";
        } else {
            $sql .= "{$indice} = '{$_POST[$indice]}' ";
        }
        $cont++;
    }
    $sql .= "WHERE id = {$param}";

    $db = DB::connect();
    $rs = $db->prepare($sql);
    $exec = $rs->execute();

    if($exec) {
        echo json_encode(["Dados" => 'Dados foram atualizados com sucesso.']);
    } else {
        echo json_encode(["Dados" => 'Houve algum erro na atualização dos dados.']);
    }
}