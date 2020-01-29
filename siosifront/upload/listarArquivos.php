<?php
    header("Access-Control-Allow-Origin: *");
	
    $tipo = $_POST['tipo'];
    $diretorio = $_POST['diretorio'];

    $path = $tipo.'/'.$diretorio."/"."files/";
    $tem = 0;
    if(is_dir("./".$path)){
        $diretorio = dir($path);
        while($arquivo = $diretorio -> read()){
            if($arquivo != '.' && $arquivo != '..'){
                $tem = 1;
                echo "
                <div class='adocslista'>
                    <a class='item' target='_blank' download href='upload/".$path.$arquivo."'>".$arquivo."</a>
                    <a class='delete' id='delete-file' data-file='".$arquivo."'><i class='icon trash alternate'></i></a>
                </div>
                ";
            };
        };
        $diretorio -> close();
    };
    if($tem == 0){
        echo "
        <div class='adocslista'>
        <a> Nenhum arquivo cadastrado! </a><br />
        </div>
        ";
    };
?>