<?php
error_reporting(0);
include "../Controllers/AccountController.php";

header('Content-Type: application/json; charset=utf-8');

$email  = filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL);
$passwd = filter_input(INPUT_GET, "passwd", FILTER_SANITIZE_STRING);


$data = getUserByEmailPswd($email, $passwd);

/* returns */
$return = new \stdClass();
$return->StatusCode  = $data->StatusCode;
$return->Status = $data->Status;

//On Error
if(strcmp($data->StatusCode, "OK") != 0){
    echo json_encode($return);
    exit();
}

session_start();
$_SESSION['idEmpresa']        = $data->idEmpresa;
$_SESSION["idVendedorAPPEDI"] = $data->idVendedorAPPEDI;
$_SESSION['idUsuario']        = $data->idUsuario;
$_SESSION["ehVendedor"]       = $data->ehVendedor;
$_SESSION["email"]            = $email;
$_SESSION["passwd"]           = $passwd;
$_SESSION["idEntidadeEndereco"] = $data->idEntidadeEndereco;
$_SESSION["idEntidade"]       = $data->idEntidade;
$_SESSION["nome_usuario"]     = $data->nome_usuario;

//print_r($data);
//$return->idVendedorAPPEDI = $data->idVendedorAPPEDI;
//$return->ehVendedor       = $data->ehVendedor;

echo json_encode($return);
?>