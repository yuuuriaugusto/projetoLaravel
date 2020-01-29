<?php
    header("Access-Control-Allow-Origin: *");

    $tipo = $_POST['tipo'];
    $diretorio = $_POST['diretorio'];
    $nome = $_POST['nomefile'];

    $path = $tipo.'/'.$diretorio."/"."files/".$nome;

    if (!unlink($path)){
        echo json_encode(['success'=>'false', 'message'=>'Erro ao deletar arquivo '.$path]);
    }else{
        echo json_encode(['success'=>'true']);
    };  
    
?>