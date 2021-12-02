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


    //$t = getClients($_SESSION['idEmpresa'], $_SESSION['idVendedorAPPEDI'], $_SESSION['idUsuario'], $_SESSION['ehVendedor']);
    //var_dump($t);
    //exit();
?>

<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link href="assets/select2/css/select2.css" rel="stylesheet" />

        <style>
            body{
                background:#eee;
            }

            
        </style>
    </head>
<body>
    

    <?php include "views/header-menu.php"; ?>

    <div class="container mt-3 justify-content-center">
        <h2 class="CP">Consulta de Pedidos</h2>
    </div>
    <br>


     <!--<div class="container mt-2 justify-content-center">
        <div class="form-row justify-content-center">
            <div class="form-group col-md-2">
                <a type="button" href="pedido.php?is_new" class="btn btn-light border border-primary m-1 w-100">Novo Pedido</a>
            </div>

           <div class="form-group col-md-2">
                <a href="itens.php" type="button" class="btn btn-light border border-primary m-1 w-100">Itens</a>
            </div>
        </div>
    </div> -->

    <div class="container mt-3">

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
                <label for="inputEmail4" class="font-weight-bold">Data Inicial</label>
                <input type="date" class="form-control" id="dataEmissao">
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4" class="font-weight-bold">Data Final</label>
                <input type="date" class="form-control" id="dataEntrega">
            </div>

        </div>


        <div class="form-row justify-content-center">
        
            <div class="form-group col-md-2">
                <button id="bt_search" type="button" class="btn btn-success border border-sucess m-1 w-100">Procurar</button>
            </div>
            <div class="form-group col-md-2">
                <a type="button" href="pedido.php?is_new" class="btn btn-primary border border-primary m-1 w-100">Novo Pedido</a>
            </div>
        </div>

    </div>

    
    <!--
    <div class="mt-2 ml-2 mr-2">
        <div class="column w-100" style="background-color:#aaa;">
            <h5>Column 1</h5>
            <p>Some text..</p>
        </div>
    </div>

    <div class="mt-2 ml-2 mr-2">
        <div class="column w-100" style="background-color:#ccc;">
            <h5>Column 3</h5>
            <p>Some text..</p>
        </div>
    </div> -->


    <div class="container-fluid mt-0">
        <div class="row justify-content-center">
            <aside class="col mr-5 ml-5 cnt">
                <div class="card mt-0">
                    <div class="table-responsive">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col" width="15" style="color:blue; font-size:1.1em;">Controle</th>
                                    <th scope="col" width="50" style="color:green; font-size:1.1em;">Cód Cliente</th>
                                    <th scope="col" width="300" style="color:black; font-size:1.1em;">Cliente</th>
                                    <th scope="col" style="color:darkgoldenrod; font-size:1.1em;" >Data Emissão</th>
                                    <th scope="col"  style="color:red; font-size:1.1em;">Data Entrega</th>
                                    <th scope="col"  style="color:#810070; font-size:1.1em;">Ped. Cliente</th>
                                    <th scope="col"  style="color:#487eb0; font-size:1.1em;">Ped. Repr.</th>
                                    <th scope="col" style="color:#9e5938; font-size:1.1em;">TotalPedido</th>
                                    <th scope="col" width="15" style="color:#3f1007; font-size:1.1em;">Options</th>
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




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="assets/select2/js/select2.js"></script>

    <script>

        function openItens(pedido_id) {
            Object.assign(document.createElement('a'), {
                target: '_blank',
                href: "itens.php?id="+pedido_id,
            }).click();
        }

        $("#bt_search").click(function() {
            get_itens();
        });

        $( document ).ready(function() {
            get_itens();
        });

        function FormataStringData(data) {
            var dia  = data.split("/")[0];
            var mes  = data.split("/")[1];
            var ano  = data.split("/")[2];

            return ano + '-' + ("0"+mes).slice(-2) + '-' + ("0"+dia).slice(-2);
            // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
        }

        
        function get_itens() {

            $.ajax({
                url: '<?php echo 'https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscapedidos?sToken=01200210210120&sEmpresa='.$_SESSION['idEmpresa'].'&sVendedorAPPEDI='.$_SESSION['idVendedorAPPEDI'].'&sEhVendedor='.$_SESSION['ehVendedor'].'&sEntidade='?>'+$("#select_cliente").val()+'<?php echo '&sVendedor=0&sNumeroPedido=0&sDataInicial='; ?>'+FormataStringData($("#dataEmissao").val())+'<?php echo '&sDataFinal=';?>'+FormataStringData($("#dataEmissao").val())+'<?php echo '&sPedidoInicial=0&iLimitePedidos=999&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897'; ?>',
                
                type: 'POST',
                success: function(response){
                    $("#contentt").text("");
                    console.log(response);
                    response.forEach(row => {

                        var dtCriacao = new Date(row.dtCriacao);
                        var dtCriacaoF = ('0' + dtCriacao.getDay()).slice(-2)+"/"+('0' + dtCriacao.getMonth()).slice(-2)+"/"+dtCriacao.getFullYear();

                        var dtEntrega = new Date(row.DataEntrega);
                        var dtEntregaF = ('0' + dtEntrega.getDay()).slice(-2)+"/"+('0' + dtEntrega.getMonth()).slice(-2)+"/"+dtEntrega.getFullYear();
                        
                        var pedido_cliente = row.PedidoCliente == null ? "" : row.PedidoCliente;

                        var newRowContent = '<tr><td style="color:blue;">'+row.idLstPedido+'</td><td style="color:green;">'+row.idEntidade+'</td><td style="color:black;">'+row.entidade+'</td><td style="color:darkgoldenrod;">'+dtCriacaoF+'</td><td style="color:red;">'+dtEntregaF+'</td><td style="color:#810070;">'+pedido_cliente+'</td><td></td><td style="color:#9e5938;">'+row.TotalPedido+'</td><td>';
                        if(row.PedidoStatus == 5){
                            newRowContent += '<a href="pedido.php?edit='+row.idLstPedido+'" class="btn btn-warning" style="color:white;">Editar</a>';
                        }
                        newRowContent += '</td></tr>';
                        $("#contentt").append(newRowContent);
                    });
                }
            });

            /*
            $.ajax({
                url: 'https://api11.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscapedidos',
                type: 'POST',
                beforeSend: function(request) {
                    request.setRequestHeader("X-DreamFactory-API-Key", "aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
                },
                data: {
                    "sToken": "aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897",
                    "iUser": <?php //echo $_SESSION['idUsuario']; ?>,
                    "iEmpresa": <?php //echo strval($_SESSION['idEmpresa']); ?>,
                    "sVendedorAPPEDI": <?php //echo strval($_SESSION['idVendedorAPPEDI']); ?>,
                    //"iCliente ": <?php //echo $_SESSION['idUsuario']; ?>,
                    "sEhVendedor": <?php //echo $_SESSION['ehVendedor']; ?>,
                    "iEntidade": $("#select_cliente").val(),
                    //"sNumeroPedido": "",
                    "sDataInicial": $("#dataEmissao").val(),
                    "sDataFinal": $("#dataEntrega").val(),
                    //"iPedidoInicial": "",
                    "iLimitePedidos": 20,
                    
                },
                success: function(response){
                    console.log(response);
                }
            });*/
        }
    </script>

</body>
</html>