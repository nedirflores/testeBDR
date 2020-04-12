<?php

    session_start();

    include_once('../bd/conexao.php');

    extract( $_POST );
    
    if ( $acao === '1' ){
        
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
        
    } else if ( $acao === '2' ){
        
        if ( $foto !== "" ){
            $sql = "UPDATE clientes SET nome='" . $nome . "',email='" . $email . "',telefone='" . $telefone . "',foto='" . $foto . "' WHERE id='" . $id . "';";
        } else {
            $sql = "UPDATE clientes SET nome='" . $nome . "',email='" . $email . "',telefone='" . $telefone . "' WHERE id='" . $id . "';";
        }        
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        echo json_encode([ 'status' => true ]);
                
        
    } else if ( $acao === '3' ){
        
        $sql = "INSERT INTO `clientes`(`id`, `nome`, `email`, `telefone`, `foto` ) VALUES ( NULL,'" . $nome . "','" . $email . "','" . $telefone  . "','" . $foto . "');";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        echo json_encode([ 'status' => true ]);
        
    } else if ( $acao === '4' ){

        $sql = "DELETE FROM `clientes` WHERE id='" . $id . "';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        echo json_encode([ 'status' => true ]);
        
    } else if ( $acao === '5' ){
        
        $sql = "SELECT foto FROM clientes WHERE id='" . $id . "';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $clientes = $stmt->fetchAll( $conn::FETCH_ASSOC );

        $foto = "";  

        if ( count($clientes) > 0 ){
            for ( $x = 0; $x < count($clientes); $x++ ){
                $cliente  = $clientes[$x];
                $foto     = "../fotos/" . $cliente["foto"];
            }                                    
        }
        
        if ( !unlink( $foto ) )
        {
            echo json_encode([ 'status' => false ]);
        }
        else 
        {
            echo json_encode([ 'status' => true ]);
        }
        
    }
    
    