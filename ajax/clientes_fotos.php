<?php
// verifica se foi enviado um arquivo 
if(isset($_FILES['fotoCliente']['name']) && $_FILES["fotoCliente"]["error"] == 0)
{

//	echo "VocÃª enviou o arquivo: <strong>" . $_FILES['arquivo']['name'] . "</strong><br />";
//	echo "Este arquivo Ã© do tipo: <strong>" . $_FILES['arquivo']['type'] . "</strong><br />";
//	echo "TemporÃ¡riamente foi salvo em: <strong>" . $_FILES['arquivo']['tmp_name'] . "</strong><br />";
//	echo "Seu tamanho Ã©: <strong>" . $_FILES['arquivo']['size'] . "</strong> Bytes<br /><br />";

	$arquivo_tmp = $_FILES['fotoCliente']['tmp_name'];
	$nome = $_FILES['fotoCliente']['name'];
	
	// Pega a extensao
	$extensao = strrchr($nome, '.');

	// Converte a extensao para mimusculo
	$extensao = strtolower($extensao);

	// Somente imagens, .jpg;.jpeg;.gif;.png
	// Aqui eu enfilero as extesÃµes permitidas e separo por ';'
	// Isso server apenas para eu poder pesquisar dentro desta String
	if(strstr('.jpg;.jpeg;.gif;.png;.jfif', $extensao))
	{
            
		// Cria um nome Ãºnico para esta imagem
		// Evita que duplique as imagens no servidor.
		$novoNome = rand(111,999999999) . $extensao;
		
		// Concatena a pasta com o nome
		$destino = '../fotos/' . $novoNome; 
		
		// tenta mover o arquivo para o destino
		if( @move_uploaded_file( $arquivo_tmp, $destino  ))
		{
                        echo json_encode([ 'status' => true, 'nameFile' => $novoNome ]);

		}
		else
                        echo json_encode([ 'status' => false, 'nameFile' => "" ]);
	}
	else{
                echo json_encode([ 'status' => false, 'nameFile' => "" ]);
        }
}
else
{
        echo json_encode([ 'status' => false, 'nameFile' => "" ]);

}

