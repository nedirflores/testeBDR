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
        <script type="text/javascript" src="js/funcoes.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js" ></script>
        <script type="text/javascript" src="bootstrap/js/npm.js"></script>
        <script src="bootstrap/js/select2.min.js"></script>
        <link rel="shortcut icon" href="imgs/favicon.png" />
        <title>Teste BDR</title>
    </head>
 
    <body>
         
        <div class="container-fluid">
            <div class="col-md-4 col-md-offset-4">
                <div class="row">
                    
                    <center>
                    
                        <h1>Clientes</h1>
                 
                        <table  style="width: 100%" class="">
                            <header> 
                                <tr> 
                                    <th style="float: right">
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalIncluir"  onclick="clienteIncluir()"> Novo Cliente </button> 
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
                <form class="table-form">
                    <table class="">
                        <input type="hidden" id="idCliente" name="idCliente"> </td>
                        <tr>
                            <td style="width: 80px">Nome</td>
                            <td><input type="text" class="form-control" id="nmCliente" name="nmCliente" style="width: 100%"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Email</td>
                            <td><input type="text" class="form-control" id="emailCliente" name="emailCliente" style="width: 100%"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Telefone</td>
                            <td><input type="text" class="form-control" id="foneCliente" name="foneCliente" style="width: 40%"> </td>
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

<div class="modal fade" id="modalIncluir" role="dialog" aria-labelledby="incluirModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="incluirModalLabel">Incluir Cliente</h3>
            </div>
            <div class="modal-body">
                <form class="table-form">
                    <table class="">
                        <tr>
                            <td style="width: 80px">Nome</td>
                            <td><input type="text" class="form-control" id="nmClienten" name="nmClienten" style="width: 250px"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Email</td>
                            <td><input type="text" class="form-control" id="emailClienten" name="emailClienten" style="width: 250px"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Telefone</td>
                            <td><input type="text" class="form-control" id="foneClienten" name="foneClienten" style="width: 150px"> </td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Foto</td>
                            <td><img name="clienteImagemn" id="clienteImagemn" class="img-circle" src="" width="150px" height="150px"></td>
                        </tr>
                        <tr> <td colspan="2">&nbsp;</td> </tr>
                        <tr>
                            <td style="width: 80px">Arquivo</td>
                            <td> <input type="file" class="form-control" id="fotoClienten" name="fotoClienten"  style="width: 100%"> </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary"   data-dismiss="modal" onclick="clienteIncluirConfirma();">Salvar</button>
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
            data: { forma: 1, id: idRef },
            success: function (res) {
                $("#idCliente").val(res.Id);
                $("#nmCliente").val(res.nome);
                $("#emailCliente").val(res.email);
                $("#foneCliente").val(res.telefone);
                //$('#clienteImagem').attr('src', 'fotos/' + res.foto);
           }
        });
    }
    
    function clienteIncluir() {
        $("#nmClienten").val("");
        $("#emailClienten").val("");
        $("#foneClienten").val("");
        $("#fotoClienten").val("");
    }
    
    function clienteIncluirConfirma( ) {
        $.ajax({
            url: "./ajax/clientes_crud.php",
            type: "POST",
            dataType: "json",
            data: { 
                forma: 3, 
                id: "",
                nome: $("#nmClienten").val(),
                email: $("#emailClienten").val(),
                telefone: $("#foneClienten").val(),
                foto: $("#fotoClienten").val()
            },
            success: function (res) {
                mostraDialogo( "Cliente", "Incluido com sucesso!", "success", );
                listar();
           }
        });
    }

    function clienteSalvar( ) {
        $.ajax({
            url: "./ajax/clientes_crud.php",
            type: "POST",
            dataType: "json",
            data: { 
                forma: 2, 
                id: $("#idCliente").val(),
                nome: $("#nmCliente").val(),
                email: $("#emailCliente").val(),
                telefone: $("#foneCliente").val(),
                foto: $("#fotoCliente").val()
            },
            success: function (res) {
                if ( res.status == true ){
                    mostraDialogo( "Cliente", "Salvo com sucesso!", "info", );
                    listar();
                } else {
                    mostraDialogo( "Cliente", res.erro  , "danger", );
                }
           }
        });
    }

    function clienteExcluir( idRef ) {
        $.ajax({
            url: "./ajax/clientes_crud.php",
            type: "POST",
            dataType: "json",
            data: { forma: 1, id: idRef },
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
            data: { forma: 4, id: idRef },
            success: function (res) {
                mostraDialogo( "Cliente", "Excluido com sucesso!", "danger", );
                listar();
           }
        });
    }
    
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
    
    $("#fotoCliente").change(function(){
        readURL(this);
    });
    
    function readURLn(input) {
       if(input.files.length > 4) { }
       
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#clienteImagemn').attr('src', e.target.result);
               }

               reader.readAsDataURL(input.files[0]);
           }
    }
    
    $("#fotoClienten").change(function(){
        readURLn(this);
    });
    
    
    listar();

</script>

