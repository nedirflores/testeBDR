<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

<?php

    session_start();

    include_once('../bd/conexao.php');

    header( "Content-type: text/html; charset=utf-8" );

    /* Iniciando o retorno */
    $res = new StdClass();
    $res->html = "";
    $res->html .= "<table class='table table-bordered table-condensed table-hover table-responsive'>";
    $res->html .= "     <header>";
    $res->html .= "         <tr style='background-color: activecaption'>";
    $res->html .= "             <th style='text-align: center'>Foto</th>";
    //$res->html .= "             <th style='text-align: center'>Id</th>";
    $res->html .= "             <th style='text-align: left  '>Nome</th>";
    $res->html .= "             <th style='text-align: left  '>eMail</th>";
    $res->html .= "             <th style='text-align: left  '>Telefone</th>";
    $res->html .= "             <th style='text-align: center'>Ações</th>";
    $res->html .= "         </tr>";
    $res->html .= "     </header>";

    $sql = "SELECT * FROM clientes WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll( $conn::FETCH_ASSOC );

    if ( count($clientes) > 0 ){
        for ( $x = 0; $x < count($clientes); $x++ ){
            $cliente = $clientes[$x];
            $res->html .= "<tr>";
            $res->html .= "     <td style='text-align: center'><img class='img-circle'  height='30px' width='30px'  src='".$cliente['foto']."' /></td>";  
            //$res->html .= "     <td style='text-align: center'>" . $cliente["id"]       . "</td>";  
            $res->html .= "     <td style='text-align: left'>"   . $cliente["nome"]     . "</td>";  
            $res->html .= "     <td style='text-align: left'>"   . $cliente["email"]    . "</td>";  
            $res->html .= "     <td style='text-align: left'>"   . $cliente["telefone"] . "</td>";  
            $res->html .= "     <td style='text-align: center'>";
            $res->html .= '         <span type="button" data-toggle="modal" data-target="#modalEditar"  onclick="clienteEditar('  . $cliente["id"] . ' )"> <img src="imgs/editar.png" width="18" height="18"></img> </span>';
            $res->html .= '         <span type="button" data-toggle="modal" data-target="#modalExcluir" onclick="clienteExcluir(' . $cliente["id"] . ' )"> <img src="imgs/lix.png"    width="20" height="20"></img></span>';
            $res->html .= "     </td>";  
            $res->html .= "</tr>";
        }                                    
    } else {
            $res->html .= "<tr>";
            $res->html .= "     <td colspan='6' style='text-align: center'>Sem Clientes na Base.</td>";  
            $res->html .= "</tr>";
    }

    $res->html .= "</table>";
    
    echo $res->html;
    
    