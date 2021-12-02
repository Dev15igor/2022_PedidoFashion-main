<?php
    include "Controllers/AccountController.php";
    session_start();

    if(isset($_SESSION['email']) && isset($_SESSION['passwd'])){
        if(!isLogged($_SESSION['email'], $_SESSION['passwd'])){
            header("Location: login.php");
            exit();
        }
    }else{
        header("Location: login.php");
        exit();
    }


    $is_new = false;
    if(isset($_GET['is_new'])){
        $is_new = true;
    }

    $edit = 0;

    if(isset($_GET['edit'])){
        $edit = $_GET['edit'];
    }

    //$t = getClients($_SESSION['idEmpresa'], $_SESSION['idVendedorAPPEDI'], $_SESSION['idUsuario'], $_SESSION['ehVendedor']);
    //var_dump($t);
    //exit();

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="assets/select2/css/select2.css" rel="stylesheet" />

    <title>Pedido Express!</title>
    <style>
        body{
            background:#eee;
        }
    </style>
</head>


<body>

<?php include "views/header-menu.php"; ?>

    <div class="container mt-2 justify-content-center">
            <div class="form-row justify-content-center">

                <div class="form-group col-md-2">
                    <button type="button" id="save_fechar" class="btn btn-primary m-1 w-100">Salvar</button>
                </div>

            

                <div class="form-group col-md-2">
                    <button type="button" id="save_duplicate" class="btn btn-secondary border border-secondary m-1 w-100" <?php if ($is_new == true){echo 'disabled';} ?>>Duplicar</button>
                </div>

                <div class="form-group col-md-2">
                    <button type="button" id="save_novo" class="btn btn-info border border-info m-1 w-100" <?php if ($is_new == true){echo 'disabled';} ?>>Novo Pedido</button>
                </div>

                <div class="form-group col-md-2">
                    <a type="button" href="./" class="btn btn-danger border border-danger m-1 w-100">Cancelar</a>
                </div>
            
            </div>
    </div>
    
    <?php
        //var_dump($_SESSION['idVendedorAPPEDI']);
        //$t = getClients($_SESSION['idEmpresa'], $_SESSION['idVendedorAPPEDI'], $_SESSION['idUsuario'], $_SESSION['ehVendedor']);
        //var_dump($t);
    ?>
    

    <div class="container mt-2">
        <div class="form-row justify-content-center">
            <div class="form-group col-md-4">
           
                <label for="inputState" class="font-weight-bold">Selecione o cliente</label>
                
                <select class="js-example-basic-single form-control" name="state" id="select_cliente">
                    <?php
                        $t = getClients($_SESSION['idEmpresa'], $_SESSION['idVendedorAPPEDI'], $_SESSION['idUsuario'], $_SESSION['ehVendedor']);
                        if($t[0]['comErro'] == 1):
                            echo '<option>...</option>';
                        else:
                        foreach ($t as $item): ?>
                            <option value="<?php echo $item['idEntidade']; ?>"><?php echo $item['Fantasia']; ?></option>
                        <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Data Emissão</label>
                <input type="date" class="form-control" id="dataEmissao">
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Data Entrega</label>
                <input type="date" class="form-control" id="dataEntrega">
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Pedido</label>
                <input type="input" class="form-control" id="pedido_" placeholder="21.0000">
            </div>
        </div>


        <div class="form-row justify-content-center">
            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Pedido Cliente</label>
                <input type="input" class="form-control" id="sPedidoCliente">
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Pedido Representante</label>
                <input type="input" class="form-control" id="sPedidoRepre">
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Marca</label>
                <input type="input" class="form-control" id="inputMarca">
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Tag</label>
                <input type="input" class="form-control" id="inputTag" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">% Comissão</label>
                <input type="input" class="form-control" id="inputComissao">
            </div>
        </div>


        <div class="form-row justify-content-center">
            <div class="form-group col-md-3">
                <label for="inputEmail4" class="font-weight-bold">Condição de Pagamento</label>
                <select id="condicao_pagamento" class="form-control">
                    <option>...</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="inputEmail4" class="font-weight-bold">Transportadora Preferencial</label>
                <select id="transportadora" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Tabela de Preços</label>
                <select id="tabela_precos" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Total Pedido R$</label>
                <input type="input" class="form-control" disabled id="total_pedido">
            </div>
        </div>


        <div class="form-row justify-content-center">
            <div class="form-group col-md-2 mt-1">
                <label></label>
                <button data-ipedido="" type="button" id="incluir_item_bt" class="btn btn-success border border-sucess m-1 w-100">Incluir Itens</button>
            </div>

            <!--<div class="form-group col-md-2 mt-1">
                <label></label>
                <button type="button" class="btn btn-light border border-primary m-1 w-100">Remover Item</button>
            </div>-->

            <div class="form-group col-md-3">
                <label for="inputEmail4" class="font-weight-bold">WhatsApp Cliente</label>
                <input type="input" class="form-control" id="inputWppCliente" placeholder="WhatsApp Cliente">
            </div>

            <div class="form-group col-md-3">
                <label for="inputEmail4" class="font-weight-bold">Status Pedido</label>
                <select id="inputStatusPedido" class="form-control">
                    <option value="0">Status Pedido...</option>
                    <?php if($is_new): ?>
                        <option value="1" selected>Em Digitação</option>
                    <?php else: ?>
                        <option value="2" selected>Integrado</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <aside class="col mr-5 ml-5 cnt">
                <div class="card mt-0">
                    <div class="table-responsive">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col" class="text-center" with="15" Style="color:blue;">Cód Produto</th>
                                    <th scope="col" style="color:#009432;">Produto</th>
                                    <th scope="col" style="color:#1B1464;">Quantidade</th>
                                    <th scope="col" style="color:#487eb0;">Valor Unitário</th>
                                    <th scope="col" style="color:#b33939;">Valor Total</th>
                                    <th scope="col" width="20">Options</th>
                                </tr>
                            </thead>
                            <tbody id="contentt">
                                <!--<tr>
                                    <td class="text-center text-secondary">IT001</td>
                                    <td>ds</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </aside>
        </div>

    </div>


    <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="max-width:none;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Incluir Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="iframe_itens" src="itens.php" class="w-100" style="min-height: calc(90vh - 80px);"></iframe>
      </div>
    </div>
  </div>
</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="assets/select2/js/select2.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        
        var pedido_idd = <?php echo $edit; ?>;

        function dialog(message, yesCallback, noCallback) {
            $('.title').html(message);
            var dialog = $('#modal_dialog').dialog();

            $('#btnYes').click(function() {
                dialog.dialog('close');
                yesCallback();
            });
            $('#btnNo').click(function() {
                dialog.dialog('close');
                noCallback();
            });
        }


        function FormataStringData(data) {
            var dia  = data.split("/")[0];
            var mes  = data.split("/")[1];
            var ano  = data.split("/")[2];

            return ano + '-' + ("0"+mes).slice(-2) + '-' + ("0"+dia).slice(-2);
            // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
        }

        function openItens(pedido_id) {
            /*
            Object.assign(document.createElement('a'), {
                target: '_blank',
                href: "itens.php?id="+pedido_id,
            }).click();*/

            
        }

        $("#incluir_item_bt").click(function () {
            //salvar_pedido(1);
            //$(".modal").show();
            if(pedido_idd == 0){
                swal("Error", "O pedido não foi salvo", "error");
            }else{
                $('#iframe_itens').attr("src", "itens.php?ipedido="+pedido_idd);
                $(".modal").show(); 
            }
            
            
        });
        $("#closeModal").click(function (){
            $(".modal").hide(); 
            get_pedido_itens($("#closeModal").data("ipedido"));
        });

        $("#save_fechar").click(function (){
            //Validar Campos

            salvar_pedido();
            /*Object.assign(document.createElement('a'), {
                href: ".",
            }).click();*/
        });

        $("#save_duplicate").click(function() {
            //salvar_pedido();
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to do this?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    salvar_pedido();
                }
            });
        });

        $("#save_novo").click(function() {
           /// salvar_pedido();
            //clear_inputs();
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to do this?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    salvar_pedido();
                    clear_inputs();
                }
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            //$('#select_cliente').find("option:eq(1)").click()
            //$('.js-example-basic-single').val('3'); // Select the option with a value of '1'
            //$('.js-example-basic-single').trigger('change');
            var data = {
                "id": $("#select_cliente option:eq(0)").val(),
            };
            $('.js-example-basic-single').trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            });


            <?php if($edit != 0){echo 'get_pedido_itens('.$edit.'); get_pedido_for_edit('.$edit.');';} ?>

        });

        function get_pedido_for_edit(pedido_id){
            $.ajax({
                url: '<?php echo 'https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscapedidos_id?sToken=01200210210120&sEmpresa='.$_SESSION['idEmpresa'].'&sVendedorAPPEDI='.$_SESSION['idVendedorAPPEDI'].'&sEhVendedor='.$_SESSION['ehVendedor'].'&sEntidade='?>'+$("#select_cliente").val()+'<?php echo '&sVendedor=0&sNumeroPedido=';?>'+pedido_id+'<?php echo '&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897'; ?>',
                type: 'POST',
                success: function(response){
                    console.log(response);
                    $("#sPedidoCliente").val(response[0]['TokenPedido']);
                    $("#sPedidoCliente").prop('disabled', true);
                }
            });
        }


        function get_pedido_itens(pedido_id) {
            $.ajax({
                url: '<?php echo 'https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscapedidositens?sToken=01200210210120&sEmpresa='.$_SESSION['idEmpresa'].'&sVendedorAPPEDI='.$_SESSION['idVendedorAPPEDI'].'&sEhVendedor='.$_SESSION['ehVendedor'].'&sEntidade='?>'+$("#select_cliente").val()+'<?php echo '&sVendedor=0&sNumeroPedido=';?>'+pedido_id+'<?php echo '&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897'; ?>',
                type: 'POST',
                success: function(response){
                    $("#contentt").text("");
                    console.log(response);
                    var total_pedido = 0;
                    response.forEach(row => {
                        total_pedido += parseFloat(row.ValorTotal);
                        var newRowContent = '<tr><td class="text-center" style="color:blue;">'+row.idProduto+'</td><td style="color:#009432;">'+row.Nome_Amigavel+'</td><td style="color:#1B1464;">'+parseInt(row.Quantidade)+'</td><td style="color:#487eb0;">'+parseFloat(row.ValorUnitario).toFixed(4)+'</td><td style="color:#b33939;">'+parseFloat(row.ValorTotal).toFixed(2)+'</td>';
                        newRowContent += '<td><a onclick="remove_item('+row.idLstPedido+', '+row.idlstPedidoItem+');" class="btn btn-primary" style="color:#FFF; background:#e74c3c; border-color:#e74c3c;">Remove</a></td>';
                        newRowContent += '</tr>';
                        $("#contentt").append(newRowContent);
                    });
                    $("#total_pedido").val(total_pedido.toFixed(2));
                }
            });
        }

        function remove_item(pedido_id, pedido_item_id){
            $.ajax({
                url: '<?php echo 'https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_removepedidositens_id?sToken=01200210210120&sEmpresa='.$_SESSION['idEmpresa'].'&sVendedorAPPEDI='.$_SESSION['idVendedorAPPEDI'].'&sEhVendedor='.$_SESSION['ehVendedor'].'&sEntidade='?>'+$("#select_cliente").val()+'<?php echo '&sVendedor=0&sNumeroPedido=';?>'+pedido_id+'<?php echo '&slstPedidoItem=';?>'+pedido_item_id+'<?php echo '&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897'; ?>',
                type: 'POST',
                success: function(response){
                    get_pedido_itens(pedido_id);
                }
            });
        }

        function clear_inputs(){
            $('input').val('');
        }

        function salvar_pedido(open_itens=0){
            
            $.ajax({
                url: 'https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_pedidocriar',
                type: 'POST',
                beforeSend: function(request) {
                    request.setRequestHeader("X-DreamFactory-API-Key", "aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
                },
                data: {
                    "params": {
                        "iEmpresa": <?php echo strval($_SESSION['idEmpresa']); ?>,
                        "iOrigem":9,
                        "iLista":0,
                        "iUsuario": <?php echo $_SESSION['idUsuario']; ?>,
                        "sPedidoCliente": $("#sPedidoCliente").val(),
                        "sPedidoRepre": $("#sPedidoRepre").val(),
                        "iEntidade": $("#select_cliente").val(),
                        "dValor": $("#total_pedido").val(),
                        "iEntidadeEndereco": <?php echo $_SESSION['idEntidadeEndereco']; ?>,
                        "iTabelaPreco": $("#tabela_precos").val(),
                        "iCondicoesPagamento": $("#condicao_pagamento").val(),
                        "iTransportadora": $("#transportadora").val(),
                        "iFrete": 0,
                        "iCupom": 0,
                        "dTotalDesconto" : 0,
                        "dTotalAcrescimo": 0,
                        "dTotalFrete": 0,
                        "dTotalFidelidade": 0,
                        "dTotalCupom": 0,
                        "iRotaVendaEntrega": 0,
                        "sObservacao": "",
                        "sLatitude": "",
                        "sLongitude": "",
                        "sDataEmissao": FormataStringData($("#dataEmissao").val()),
                        "sDataEntrega": FormataStringData($("#dataEntrega").val()),
                        "sMarca": $("#inputMarca").val(),
                        "sTag": $("#inputTag").val(),
                        "dComissao": parseInt($("#inputComissao").val()),
                        "sWhatsCli": $("#inputWppCliente").val(),
                        "sStatusPedido": parseInt($("#inputStatusPedido").val()),
                        "sExtra1":""
                    }
                },
                success: function(response){
                    console.log(response);
                    row = response[0];
                    pedido_idd = row.ChavePedido;
                    $("#incluir_item_bt").data("ipedido", row.ChavePedido);
                    $("#closeModal").data("ipedido", row.ChavePedido);
                    get_pedido_itens(row.ChavePedido);
                    if(open_itens == 1){
                        $('#iframe_itens').attr("src", "itens.php?ipedido="+row.ChavePedido);
                        $(".modal").show(); 
                    }

                    swal("Good job!", "Pedido Salvo", "success");
                    //var newRowContent = '<tr onclick="openItens('+row.ChavePedido+')"><td class="text-center text-secondary">'+row.iEmpresa+'</td><td>'+row.sPedidoCliente+'</td><td>'+row.VendaPermitida+'</td><td></td></tr>';
                    //$("#contentt").append(newRowContent);
                }
            });
        }

        $('.js-example-basic-single').on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data);
            $.ajax({
                url: '<?php echo "https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscacondpgto?sToken=PDVF55&iEmpresa=".strval($_SESSION['idEmpresa'])."&sVendedorAPPEDI=".$_SESSION['idVendedorAPPEDI']."&iCliente=".$_SESSION['idUsuario']."@sEhVendedor=".$_SESSION['ehVendedor']."&iEntidade="; ?>'+data.id+'<?php echo "@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897"; ?>',
                success: function(response){
                    $('#condicao_pagamento').empty();

                    response.forEach(element => {
                        //console.log(element);
                        $('#condicao_pagamento').append($('<option>', {
                            value: element.iCondicaoPadrao,
                            text: element.condicoes_pagamento
                        }));
                    });
                   
                }
            });

            $.ajax({
                url: '<?php echo "https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscatransportadora?sToken=PDVF55&iEmpresa=".strval($_SESSION['idEmpresa'])."&sVendedorAPPEDI=".$_SESSION['idVendedorAPPEDI']."&iCliente=".$_SESSION['idUsuario']."@sEhVendedor=".$_SESSION['ehVendedor']."&iEntidade="; ?>'+data.id+'<?php echo "@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897"; ?>',
                success: function(response){
                    $('#transportadora').empty();
                    //console.log(response);

                    response.forEach(element => {
                        //console.log(element);
                        $('#transportadora').append($('<option>', {
                            value: element.idTransportadora,
                            text: element.transportadora
                        }));
                    });
                   
                }
            });

            $.ajax({
                url: '<?php echo "https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscatabpreco?sToken=PDVF55&iEmpresa=".strval($_SESSION['idEmpresa'])."&sVendedorAPPEDI=".$_SESSION['idVendedorAPPEDI']."&iCliente=".$_SESSION['idUsuario']."@sEhVendedor=".$_SESSION['ehVendedor']."&iEntidade="; ?>'+data.id+'<?php echo "@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897"; ?>',
                success: function(response){
                    $('#tabela_precos').empty();

                    

                    response.forEach(element => {
                        console.log(element);
                        $('#tabela_precos').append($('<option>', {
                            value: element.iTabelaPreco,
                            text: element.TabelaPreco
                        }));
                    });
                   
                }
            });


        });
    </script>
</body>

</html>