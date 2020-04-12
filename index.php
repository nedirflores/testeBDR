<?php

    include_once('./bd/conexao.php');

    $arrStatus = [
        0 => '<span style="width:60px" class="btn btn-xs btn-danger "> Inativo </span>',
        1 => '<span style="width:60px" class="btn btn-xs btn-info   "> Ativo  </span>'
    ];
    
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link href="bootstrap/css/select2.min.css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.mask.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js" ></script>
        <script type="text/javascript" src="bootstrap/js/npm.js"></script>
        <script src="bootstrap/js/select2.min.js"></script>
        <link rel="shortcut icon" href="imgs/favicon.png" />
        <title>Teste BDR</title>
    </head>
 
    <body>
         
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    
                    <center>
                    
                        <h1>Clientes</h1>
                 
                        <table  style="width: 100%" class="">
                            <header> 
                                <tr> 
                                    <th style="float: right">
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEditar"  onclick="clienteIncluir()"> Novo Cliente </button> 
                                    </th> 
                                </tr> 
                            </header>
                        </table> <br>
                        
                        <div id='page-data'>
                        
                        <br><br>
                            
                    </center>
                        
                </div>     
            </div>     
        </div>     
    </body>
</html>

<div class="modal fade" id="modalEditar" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editarModalLabel">Editar Cliente</h3>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <table class="">
                        <input type="hidden" id="idCliente" name="idCliente"> </td>
                        <input type="hidden" id="acao" name="acao"> </td>
                        <tr>
                            <td style="width: 80px">Nome</td>
                            <td><input type="text" class="form-control" id="nmCliente" name="nmCliente" style="width: 100%"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Email</td>
                            <td><input type="text" class="form-control" id="emailCliente" name="emailCliente" onblur="checarEmail();" style="width: 100%"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Telefone</td>
                            <td><input type="text" class="form-control" id="foneCliente" name="foneCliente" maxlength="14" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" style="width: 50%"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Foto</td>
                            <td><img name="clienteImagem" id="clienteImagem" class="img-circle" src="" width="150px" height="150px"></td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Arquivo</td>
                            <td> <input type="file" class="form-control" id="fotoCliente" name="fotoCliente"  style="width: 100%"> </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary"   data-dismiss="modal" onclick="clienteSalvar();">Salvar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExcluir" role="dialog" aria-labelledby="excluirModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="excluirModalLabel">Excluir Cliente</h3>
            </div>
            <div class="modal-body">
                <form class="table-form">
                    <table class="">
                        <tr>
                            <td style="width: 80px">ID</td>
                            <td><input type="text" class="form-control" id="idClientex" name="idClientex" style="width: 150px" readonly="true"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Nome</td>
                            <td><input type="text" class="form-control" id="nmClientex" name="nmClientex" style="width: 250px" readonly="true"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Email</td>
                            <td><input type="text" class="form-control" id="emailClientex" name="emailClientex" style="width: 250px" readonly="true"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="clienteExcluirConfirma();" data-dismiss="modal">Excluir</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#foneCliente").mask("(00) 00000-0009");
    
    function checarEmail(){
        if( document.forms[0].emailCliente.value=="" 
            || document.forms[0].emailCliente.value.indexOf('@')==-1 
            || document.forms[0].emailCliente.value.indexOf('.')==-1 )
            {
              mostraDialogo( "E-MAIL", "Por favor, informe um E-MAIL válido!"  , "warning", );
              $("#page-data").focus();
            }
    }    
    
    function listar() {
        $.ajax({
            url: "./ajax/clientes_lista.php",
            type: "POST",
            dataType: "html",
            success: function (res) {
                $("#page-data").html(res);
            }
        });
    }
    
    function clienteEditar( idRef ) {
        $.ajax({
            url: "./ajax/clientes_crud.php",
            type: "POST",
            dataType: "json",
            data: { acao: 1, id: idRef },
            success: function (res) {
                $("#acao").val("2");
                $("#idCliente").val(res.Id);
                $("#nmCliente").val(res.nome);
                $("#emailCliente").val(res.email);
                $("#foneCliente").val(res.telefone);
                $('#clienteImagem').attr('src', 'fotos/' + res.foto);
                $('#fotoCliente').val('');
           }
        });
    }
    
    var nmArqFoto;
    var formEditar;
    function readURL(input) {
       if(input.files.length > 4) { }
       
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#clienteImagem').attr('src', e.target.result);
               }

               reader.readAsDataURL(input.files[0]);
           }
    }

    $('#fotoCliente').change(function (event) {
        readURL(this);
        formEditar = new FormData();
        formEditar.append('fotoCliente', event.target.files[0]); // para apenas 1 arquivo
        //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção
    });

    function clienteSalvar( ) {
        nmArqFoto = "";
        if ( $('#fotoCliente').val() != null && $('#fotoCliente').val() !== '' ){
            
            if ( $("#acao").val() === '2' ){
                $.ajax({
                    url: "./ajax/clientes_crud.php",
                    type: "POST",
                    dataType: "json",
                    data: { acao: 5, id: $("#idCliente").val() },
                    success: function (res) {
                        if ( res.status == true ){
                            //mostraDialogo( "Foto", "Excluida com sucesso!" , "info", );
                        } else {
                            //mostraDialogo( "Foto", res.erro  , "danger", );
                        }
                   }
                });
                
            }
            
            $.ajax({
                url: "./ajax/clientes_fotos.php",
                type: "POST",
                dataType: "json",
                processData: false,
                contentType: false,
                data: formEditar,
                success: function (res) {
                    nmArqFoto = res.nameFile;
                    $.ajax({
                        url: "./ajax/clientes_crud.php",
                        type: "POST",
                        dataType: "json",
                        data: { 
                            acao: $("#acao").val(),
                            id: $("#idCliente").val(),
                            nome: $("#nmCliente").val(),
                            email: $("#emailCliente").val(),
                            telefone: $("#foneCliente").val(),
                            foto: nmArqFoto,
                        },
                        success: function (res) {
                            if ( res.status == true ){
                                mostraDialogo( "Cliente", "Salvo com sucesso!" , "info", );
                                listar();
                            } else {
                                mostraDialogo( "Cliente", res.erro  , "danger", );
                            }
                       }
                    });
                }
            });
        } else {

            $.ajax({
                url: "./ajax/clientes_crud.php",
                type: "POST",
                dataType: "json",
                data: { 
                    acao: $("#acao").val(),
                    id: $("#idCliente").val(),
                    nome: $("#nmCliente").val(),
                    email: $("#emailCliente").val(),
                    telefone: $("#foneCliente").val(),
                    foto: nmArqFoto,
                },
                success: function (res) {
                    if ( res.status == true ){
                        mostraDialogo( "Cliente", "Salvo com sucesso!" , "info", );
                        listar();
                    } else {
                        mostraDialogo( "Cliente", res.erro  , "danger", );
                    }
               }
            });
        }
    }
    
    function clienteIncluir() {
        $("#acao").val("3");
        $("#idCliente").val("");
        $("#nmCliente").val("");
        $("#emailCliente").val("");
        $("#foneCliente").val("");
        $('#clienteImagem').attr("src", "");
        $('#fotoCliente').val("");
    }
    
    function clienteExcluir( idRef ) {
        $.ajax({
            url: "./ajax/clientes_crud.php",
            type: "POST",
            dataType: "json",
            data: { acao: 1, id: idRef },
            success: function (res) {
                $("#idClientex").val(res.Id);
                $("#nmClientex").val(res.nome);
                $("#emailClientex").val(res.email);
           }
        });
    }

    function clienteExcluirConfirma() {
        var idRef = $("#idClientex").val();
        $.ajax({
            url: "./ajax/clientes_crud.php",
            type: "POST",
            dataType: "json",
            data: { acao: 4, id: idRef },
            success: function (res) {
                mostraDialogo( "Cliente", "Excluido com sucesso!", "danger", );
                listar();
           }
        });
    }
    
    listar();

</script>

