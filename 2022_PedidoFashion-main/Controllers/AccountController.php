<?php
include "./config.php";

function getUserByEmailPswd($email, $passwd){
    $ch = curl_init("http://api11.mepluga.com/api/v2/olapdv/_proc/sp_Login_Validate?sToken=PDVF55&sUsuario=".$email."&sSenha=".$passwd."&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data)[0];

    return $data;
}

function isLogged($email, $passwd){
    $data = getUserByEmailPswd($email, $passwd);
    if($data->StatusCode == "OK"){
        return true;
    }
    return false;
}

//por enquanto
function getClients($iEmpresa, $sVendedorAPPEDI, $iCliente, $ehVendedor){
    $ch = curl_init("https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscaclientes?sToken=PDVF55&iEmpresa=".strval($iEmpresa)."&sVendedorAPPEDI=".$sVendedorAPPEDI."&iCliente=".$iCliente."@sEhVendedor=".$ehVendedor."@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
    //$ch = curl_init("https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscaclientes?sToken=PDVF55&iEmpresa=10&sVendedorAPPEDI=101&iCliente=895@sEhVendedor=1@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
    
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_HEADER, 0);
    //$data = curl_exec($ch);
    //curl_close($ch);
    //$data = json_decode($data);
    
    //return $data;

    $conn = new PDO('mysql:host='.getenv('DBHOST').';dbname='.getenv('DBNAME'), getenv('DBUSER'), getenv('DBPASS'));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare("CALL sp_v5_buscaclientes(:sToken, :iEmpresa, :sVendedorAPPEDI, :iCliente, :sEhVendedor)");
    $stmt->bindValue(':sToken', "aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
    $stmt->bindParam(':iEmpresa', $iEmpresa, PDO::PARAM_INT);
    $stmt->bindParam(':sVendedorAPPEDI', $sVendedorAPPEDI);
    $stmt->bindParam(':iCliente', $iCliente);
    $stmt->bindValue(':sEhVendedor', ($ehVendedor == 0 ? "N" : "S"));

    $stmt->execute();

    $q = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $q;
}

function getProducts($iEmpresa, $sVendedorAPPEDI, $iCliente, $ehVendedor, $iEntidade){
    /*$ch = curl_init("https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscarprodutos?sToken=PDVF55&iEmpresa=".strval($iEmpresa)."&sVendedorAPPEDI=".$sVendedorAPPEDI."&iCliente=".$iCliente."@sEhVendedor=".$ehVendedor."@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data);
    
    return $data;*/

    $conn = new PDO('mysql:host='.getenv('DBHOST').';dbname='.getenv('DBNAME'), getenv('DBUSER'), getenv('DBPASS'));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare("CALL sp_v5_buscarprodutos(:sToken, :iEmpresa, :sVendedorAPPEDI, :iCliente, :sEhVendedor, :iEntidade)");
    $stmt->bindValue(':sToken', "aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
    $stmt->bindParam(':iEmpresa', $iEmpresa, PDO::PARAM_INT);
    $stmt->bindParam(':sVendedorAPPEDI', $sVendedorAPPEDI);
    $stmt->bindParam(':iCliente', $iCliente);
    $stmt->bindValue(':sEhVendedor', ($ehVendedor == 0 ? "N" : "S"));
    $stmt->bindParam(':iEntidade', $iEntidade);


    $stmt->execute();

    $q = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $q;
}

function getCondicaoPgmt($iEmpresa, $sVendedorAPPEDI, $iCliente, $ehVendedor){
    $ch = curl_init("https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscacondpgto?sToken=PDVF55&iEmpresa=".strval($_SESSION['idEmpresa'])."&sVendedorAPPEDI=".$_SESSION['idVendedorAPPEDI']."&iCliente=".$_SESSION['idUsuario']."@sEhVendedor=".$_SESSION['ehVendedor']."&iEntidade=215272@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
    //$ch = curl_init("https://api1.mepluga.com/api/v2/olapdv/_proc/sp_v5_buscacondpgto?sToken=PDVF55&iEmpresa=10&sVendedorAPPEDI=101&iCliente=895@sEhVendedor=1&iEntidade=215272@&api_key=aa50eb18ee6de46083bfa382f3c288ab584e8eb13222ebb3f979aa521723c897");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data);
    
    return $data;
}


?>