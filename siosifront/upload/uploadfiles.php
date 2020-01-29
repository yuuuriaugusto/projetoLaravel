<?
	header("Access-Control-Allow-Origin: *");
	
    try {
		$name = $_POST['nome'];
		$tipo = $_POST['tipo'];
    	$files = [];


		if (isset($_FILES['arquivos-files']) && count($_FILES['arquivos-files']) > 0) {
			$files = reArrayUploadFiles($_FILES['arquivos-files']);
		}else {
			throw new Exception("Não foram anexados arquivos, ou os arquivos são inválidos!");
		};


	    $error_upload = [];
	    foreach ($files as $key => $file) {
	        if ($file['error']) {
	            if (isset($file ['name'])) {
	                $error_upload[] = $file ['name'] . ' - ' . $file ['error'];
	            } else {
	                $error_upload[] = $file ['error'];
	            };
	        };
	    };
	    if (count($error_upload) > 0) {
	        throw new Exception(implode('; ', $error_upload));
		};
		
		// aqui a parte de salvar
		if(!is_dir($tipo.'/')){
			mkdir($tipo.'/');
		};
		if(!is_dir($tipo.'/'.$name.'/')){
			mkdir($tipo.'/'.$name.'/');
		};
		$destino = $tipo.'/'.$name.'/'.'files/';
		if(!is_dir($destino)){
			mkdir($destino);
		};

	    foreach ($files as $key => $file) {
			$filenewname = $destino.$file['name'];
			move_uploaded_file($file['path'], $filenewname);
		};
 
		echo json_encode(['success'=>'true']);
	} catch (Exception $e) {
		echo json_encode(['success'=>'false', 'message'=>$e->getMessage()]);
	};

	function reArrayUploadFiles($files) {
		$array = [];
		$i = 0;
		if (!$files['name'][0]){
			$i = 1;
		};
		for ($i; $i < sizeof($files['name']); $i++) {
			$array[] = [
				'name'=>$files['name'][$i],
				'path'=>$files['tmp_name'][$i],
				'size'=>$files['size'][$i],
				'error'=>$files['error'][$i],
			];
		};
		return $array;
	};
?>