<?php

if ($acao == '' && $param == '') {
    echo json_encode(['ERROR' => 'Caminho não encontrado!']);
}

if($acao == 'adiciona' && $param == '') {
    $sql = "INSERT INTO clientes (";
    $cont = 1;
    foreach (array_keys($_POST) as $indice){
        if(count($_POST) > $cont) {
            $sql .= "{$indice},";
        } else {
            $sql .= "{$indice}";
        }
        $cont++;
    }
    $sql .= ") VALUES (";

    $cont = 1;
    foreach (array_values($_POST) as $valor){
        if(count($_POST) > $cont) {
            $sql .= "'{$valor}',";
        } else {
            $sql .= "'{$valor}'";
        }
        $cont++;
    }
    $sql .= ")";

    $db = DB::connect();
    $rs = $db->prepare($sql);
    $exec = $rs->execute();

    if($exec) {
        echo json_encode(["Dados" => 'Dados foram inseridos com sucesso.']);
    } else {
        echo json_encode(["Dados" => 'Houve algum erro na inserção dos dados.']);
    }
}