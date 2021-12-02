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

    $chave_pedido = 0;

    if(isset($_GET['ipedido'])){
        $chave_pedido = $_GET['ipedido'];
    }
    //var_dump($chave_pedido);

    //$t = getProducts($_SESSION['idEmpresa'], $_SESSION['idVendedorAPPEDI'], $_SESSION['idUsuario'], $_SESSION['ehVendedor'], $_SESSION['idEntidade']);
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
        label{
            font-size:1.1em;
            font-weight:500;
        }
    </style>
</head>


<body>
    <div class="container mt-2 justify-content-center">
            <div class="form-row justify-content-center">
            <div class="form-group col-md-2">
                <a type="button" href="./" class="btn btn-danger border border-danger m-1 w-100">Fechar</a>
            </div>

            <div class="form-group col-md-2">
                <button id="save_duplicar" type="button" class="btn btn-success border border-sucess m-1 w-100">Salvar e Duplicar</button>
            </div>

            <div class="form-group col-md-2">
                <button id="save_novo" type="button" class="btn btn-info border border-info m-1 w-100">Salvar e novo</button>
            </div>

            <div class="form-group col-md-2">
                <button id="save_close" type="button" class="btn btn-primary m-1 w-100">Salvar</button>
            </div>
        </div>
    </div>
    
    <?php
        //var_dump($_SESSION['idVendedorAPPEDI']);
        //$t = getProducts($_SESSION['idEmpresa'], $_SESSION['idVendedorAPPEDI'], $_SESSION['idUsuario'], $_SESSION['ehVendedor']);
        //var_dump($t);
    ?>
    

    <div class="container mt-2">
        <div class="form-row justify-content-center">
            <div class="form-group col-md-5">
           
                <label for="inputState">Selecione o produto</label>
                
                <select class="js-example-basic-single form-control" name="state" id="select_product">
                    <?php
                        $t = getProducts($_SESSION['idEmpresa'], $_SESSION['idVendedorAPPEDI'], $_SESSION['idUsuario'], $_SESSION['ehVendedor'], $_SESSION['idEntidade']);
                        if($t[0]['comErro'] == 1):
                            echo '<option>...</option>';
                        else:
                        foreach ($t as $item): ?>
                            <option value="<?php echo $item['idProduto']; ?>"><?php echo $item['Produto']; ?></option>
                        <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="form-group col-md-5">
           
                <label for="inputState">Selecione a cor</label>
                
                <select class="js-example-basic-single form-control" name="state" id="select_cor">
                    
                </select>
            </div>



        </div>


        <div class="form-row justify-content-center">
            <div class="form-group col-md-2">
                <label for="inputEmail4">Caixas</label>
                <input type="number" value="1" class="form-control" id="inputCaixas">
            </div>

            <div class="form-group col-md-1">

            </div>

            <div class="form-group col-md-1" style="width:100%; margin-right:10px;">
                <label for="inputEmail4" >Desconto%</label>
                <input type="input" class="form-control" id="desconto_percentual" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4">Preco Unitario</label>
                <input type="input" class="form-control" id="preco_unitario">
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4">Desconto R$</label>
                <input type="input" disabled class="form-control" id="destonto_vlr" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4">Total R$</label>
                <input type="input" disabled class="form-control" id="total_valor">
            </div>
        </div>


        <div class="form-row justify-content-center">
            <div class="form-group col-md-8">
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">33</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input33">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">34</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input34">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">35</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input35">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">36</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input36">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">37</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input37">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">38</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input38">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">39</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input39">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">40</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input40">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">41</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input41">
                </div>
                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">42</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input42">
                </div>

                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">43</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input43">
                </div>

                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">44</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input44">
                </div>

                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">45</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input45">
                </div>

                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">46</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input46">
                </div>

                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">47</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input47">
                </div>

                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">48</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input48">
                </div>

                <div style="float:left;" class="text-center">
                    <label for="inputEmail4">49</label>
                    <input type="input" class="form-control" style="width:40px !important; padding:0;" id="input49">
                </div>

            </div>

            <div class="form-group col-md-2">
                <div style="margin-left:-50px;" class="mr-3">
                    <label for="inputEmail4">Romaneio</label>
                    <input type="input" class="form-control" disabled style="width:70px !important;" id="romaneio">
                </div>
                <div style="float:right; margin-top:-70px;" class="ml-3">
                    <label for="inputEmail4">Qtd Total</label>
                    <input type="input" class="form-control" disabled style="width:70px !important;" id="qtd_total">
                </div>
            </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-3 mt-1">
            <img alt="" id="image_main" src="assets/" style="display: block; margin: 0px; width: 100%; height: 100%; border-radius: 0px;">
            </div>


            <div class="form-group col-md-3">
                <label for="inputEmail4">Status Pedido</label>
                <select id="inputStatusPedido" class="form-control">
                    <option value="0">Status Pedido...</option>
                    <option value="1">Em Digitação</option>
                    <option value="2">Integrado</option>
                </select>
                
                <label for="inputEmail4" class="mt-2">OC Cliente</label>
                <input type="input" class="form-control" id="oc_cliente">

                <label for="inputEmail4" class="mt-2">Ref Cliente</label>
                <input type="input" class="form-control" id="ref_cliente">

            </div>

            <div class="form-group col-md-4 ml-4">
                <div style="min-height:80px;">
                    <div style="float:right;" class="ml-3">
                        <label for="inputEmail4">Total Pedido</label>
                        <input type="input" class="form-control" style="" disabled id="input41">
                    </div>
                    <div style="float:right;" >
                        <label for="inputEmail4">Nro Itens</label>
                        <input type="input" class="form-control" disabled style="width:70px !important;" id="input41">
                    </div>
                </div>
                
                <div>
                    <label for="inputEmail4">Tag</label>
                    <input type="input" class="form-control" id="tag_input">
                </div>
                <div style="margin-top:10px;">
                    <label for="inputEmail4">Legenda Cliente</label>
                    <input type="input" class="form-control" id="leg_cliente">
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

        const grade_numeros = [
            {"Posicao01": '#input33'},
            {"Posicao02": '#input34'},
            {"Posicao03": '#input35'},
            {"Posicao04": '#input36'},
            {"Posicao05": '#input37'},
            {"Posicao06": '#input38'},
            {"Posicao07": '#input39'},
            {"Posicao09": '#input40'},
            {"Posicao09": '#input41'},
            {"Posicao10": '#input42'},
            {"Posicao11": '#input43'},
            {"Posicao12": '#input44'},
            {"Posicao13": '#input45'},
            {"Posicao14": '#input46'},
            {"Posicao15": '#input47'},
            {"Posicao16": '#input48'},
            {"Posicao17": '#input49'}
        ];

        function calcula_precos() {
            var total = 0;
            var preco_un = 0;
            var desconto = $("#desconto_percentual").val();
            


            desconto_frac = (100 - desconto)/100;
            preco_unitario = desconto_frac * $("#preco_unitario").val();
            total = (preco_unitario * $("#qtd_total").val()).toFixed(2);
            
            var desconto_unitario = ($("#preco_unitario").val() * desconto)/100;

            $("#destonto_vlr").val(desconto_unitario);

            console.log(total);
            $("#total_valor").val(total);
        }

        $("#desconto_percentual").change(function() {
            calcula_precos();
        });

        $("#preco_unitario").change(function() {
            calcula_precos();
        });

        //========================

        function calculos() {
            var caixas = $("#inputCaixas").val();
            var romaneio = 0;
            var qtd_total = 0;

            //Calcula Romaneio
            grade_numeros.forEach(element => {
                const inp = Object.entries(element)[0][1];
                var valor = $(inp).val() != '' ? parseInt($(inp).val()) : 0;
                romaneio += valor;
            });
            $("#romaneio").val(romaneio);
            

            //Qtd Total
            qtd_total = romaneio*caixas;
            $("#qtd_total").val(qtd_total);
        }

        $("#inputCaixas").change(function() {
            calculos();
            calcula_precos();
        });


        grade_numeros.forEach(element => {
            const inp = Object.entries(element)[0][1];
            $(inp).change(function() {
                calculos();
                calcula_precos();
            });
        });

        //

        $( "#save_duplicar" ).click(function() {
            salvar_pedido_item();
        });

        $( "#save_novo" ).click(function() {
            salvar_pedido_item();
            clear_inputs();
        });

        $("#save_close").click(function() {
            salvar_pedido_item();
        });

        function clear_inputs(){
            $('input').val('');
        }

        function salvar_pedido_item(){
            
            $.ajax({
                url: 'https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_pedidoitem_criar',
                type: 'POST',
                beforeSend: function(request) {
                    request.setRequestHeader("X-DreamFactory-API-Key", "aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
                },
                data: {
                    "params": {
                        "sToken": "aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897",
                        "iUser": <?php echo $_SESSION['idUsuario']; ?>,
                        "iEmpresa": <?php echo strval($_SESSION['idEmpresa']); ?>,
                        "iEntidade": <?php echo strval($_SESSION['idEntidade']); ?>,
                        "iPedido": <?php echo $chave_pedido; ?>,
                        "iProduto": $("#select_product").val(),
                        "iCor": $("#select_cor").val(),
                        "dQtd": $("#qtd_total").val(),
                        "dQtdCX": $("#inputCaixas").val(),
                        "dValor": $("#total_valor").val(),
                        "dValorCx": $("#preco_unitario").val(),
                        //"iListaItem": "",
                        //"iStatus": "",
                        "iFaixaPreco": 0,
                        //"iTabelaPreco": "",
                        "sLatidude": 0,
                        "sLongitude": 0,
                        //"iCommand": "",
                        //"sExtra": "",
                        "dRomaneio": $("#romaneio").val(),
                        "dDescontoPerc": $("#desconto_percentual").val(),
                        "dDescontoVlr": $("#destonto_vlr").val(),
                        "sOCCliente": $("#oc_cliente").val(),
                        "sTag": $("#tag_input").val(),
                        "sRefCliente": $("#ref_cliente").val(),
                        "sLegendaCliente": $("#leg_cliente").val(),
                        "Qtd01": $("#input33").val() != '' ? $("#input33").val() : 0,
                        "Qtd02": $("#input34").val() != '' ? $("#input34").val() : 0,
                        "Qtd03": $("#input35").val() != '' ? $("#input35").val() : 0,
                        "Qtd04": $("#input36").val() != '' ? $("#input36").val() : 0,
                        "Qtd05": $("#input37").val() != '' ? $("#input37").val() : 0,
                        "Qtd06": $("#input38").val() != '' ? $("#input38").val() : 0,
                        "Qtd07": $("#input39").val() != '' ? $("#input39").val() : 0,
                        "Qtd08": $("#input40").val() != '' ? $("#input40").val() : 0,
                        "Qtd09": $("#input41").val() != '' ? $("#input41").val() : 0,
                        "Qtd10": $("#input42").val() != '' ? $("#input42").val() : 0,
                        "Qtd11": $("#input43").val() != '' ? $("#input43").val() : 0,
                        "Qtd12": $("#input44").val() != '' ? $("#input44").val() : 0,
                        "Qtd13": $("#input45").val() != '' ? $("#input45").val() : 0,
                        "Qtd14": $("#input46").val() != '' ? $("#input46").val() : 0,
                        "Qtd15": $("#input47").val() != '' ? $("#input47").val() : 0,
                        "Qtd16": $("#input48").val() != '' ? $("#input48").val() : 0,
                        "Qtd17": $("#input49").val() != '' ? $("#input49").val() : 0,
                    }
                },
                success: function(response){
                    console.log(response);
                    swal("Good job!", "Item Salvo", "success");
                }
            });
        }


        function produto_change_event(data){
            $.ajax({
                url: '<?php echo "https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscarprodutoscores?sToken=PDVF55&iEmpresa=".strval($_SESSION['idEmpresa'])."&sVendedorAPPEDI=".$_SESSION['idVendedorAPPEDI']."&iCliente=".$_SESSION['idUsuario']."@sEhVendedor=".$_SESSION['ehVendedor']."&iProduto="; ?>'+data.id+'<?php echo "@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897"; ?>',
                success: function(response){
                    $('#select_cor').empty();

                    console.log(response);

                    $("#image_main").attr("src", response[0]['Imagem']);

                    response.forEach(element => {
                        //console.log(element);
                        $('#select_cor').append($('<option>', {
                            value: element.idCor,
                            text: element.Cor
                        }));
                    });

                    //Atualiza Grade
                    grade_numeros.forEach(element => {
                        const inp = Object.entries(element)[0][1];
                        $(inp).prop('disabled', false);
                        $(inp).css("background-color","#fff");
                    });

                    grade_numeros.forEach(element => {
                        const key = String(Object.entries(element)[0][0]);
                        const value = response[0][key];

                        //console.log(typeof(value));

                        if(value == ''){
                            input_id = Object.entries(element)[0][1];
                            //console.log(input_id);
                            $(input_id).prop('disabled', true);
                            $(input_id).css("background-color","#a1a1a1");
                        }
                    });
                   
                }
            });
        }

        $(document).ready(function() {
            $('#select_product').select2();
            $('#select_cor').select2();

            var data = {};
            data.id = $("#select_product option:first").val();
            produto_change_event(data);
        });


        $('#select_product').on('select2:select', function (e) {
            var data = e.params.data;
            //console.log(data);
            produto_change_event(data);
        });
    </script>

    
</body>

</html>