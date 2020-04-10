<?php

    session_start();

    include_once('../bd/conexao.php');

    extract( $_POST );
    
    if ( isset( $_POST["foto"] ) ){
        
        if( $_FILES["foto"]["name"] ){ // se receber um input file com uma nova imagem

            $destino = 'fotos/';

            include_once('classes/class.upload.php');
            $handle = new upload($_FILES["foto"]);

            $newName 	 	= 'image_'.f_geraCodData();
            $extensao 		= f_extensao($_FILES["foto"]["name"]);

            $file 			= $newName.'.'.$extensao ;
            $filename 		= $destino.$newName.'.'.$extensao ;

            if ($handle->uploaded) {
                $handle->auto_create_dir 	= true;
                $handle->file_new_name_body	= $newName ;
                $handle->file_overwrite	= true ;
                $handle->no_upload_check	= true ;
                $handle->allowed 		= array('image/png','image/jpeg','image/pjpeg','image/gif');
                //$handle->allowed 		= array('application/pdf');
                $filesize 			= $handle->file_src_size;
                $type                           = $handle->file_src_mime;
                $pixels 			= $handle->image_src_pixels;
                $width                          = $handle->image_src_x;
                $height 			= $handle->image_src_y;

                $handle->process($destino);
                $handle->clean();
              //echo $handle->error;
              //echo $handle->log;

                $foto = $file;	
            }

            //echo $newName;

        } else {
        
            $foto = '';
        
        }
    
    }

    if ( $forma === '1' ){
        
        $sql = "SELECT * FROM clientes WHERE id='" . $id . "';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $clientes = $stmt->fetchAll( $conn::FETCH_ASSOC );

        $id       = "";  
        $nome     = "";  
        $email    = "";  
        $telefone = "";  
        $foto     = "";  

        if ( count($clientes) > 0 ){
            for ( $x = 0; $x < count($clientes); $x++ ){
                $cliente  = $clientes[$x];
                $id       = $cliente["id"];  
                $nome     = $cliente["nome"];
                $email    = $cliente["email"];
                $telefone = $cliente["telefone"];
                $foto     = $cliente["foto"];
            }                                    
        }

        echo json_encode([
            'Id'       => $id,
            'nome'     => $nome,
            'email'    => $email,
            'telefone' => $telefone,
            'foto'     => $foto
        ]);
        
    } else if ( $forma === '2' ){
        
                
        $sql = "UPDATE clientes SET nome='" . $nome . "',email='" . $email . "',telefone='" . $telefone . "',foto='" . $foto . "' WHERE id='" . $id . "';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        echo json_encode([ 'status' => true ]);
                
        
    } else if ( $forma === '3' ){
        
        
        $sql = "INSERT INTO `clientes`(`id`, `nome`, `email`, `telefone`, `foto` ) VALUES ( NULL,'" . $nome . "','" . $email . "','" . $telefone  . "','" . $foto . "');";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        echo json_encode([ 'status' => true ]);
        
    } else if ( $forma === '4' ){

        $sql = "DELETE FROM `clientes` WHERE id='" . $id . "';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        echo json_encode([ 'status' => true ]);
        
    }    
    
    