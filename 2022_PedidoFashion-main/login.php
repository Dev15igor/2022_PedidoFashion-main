<?php
    include "Controllers/AccountController.php";
    session_start();

    if(isset($_SESSION['email']) && isset($_SESSION['passwd'])){
        if(isLogged($_SESSION['email'], $_SESSION['passwd'])){
            header("Location: index.php");
            exit();
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pedido Express!</title>
    <style>
        html, body {
        height: 100%;
        }

        body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #28375e;
        }

        .form-signin {
        background-color:white;
        border-radius:5px;
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
        box-shadow: 2px 3px 3px 2px rgba(0, 0, 0, 0.2)
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>
</head>


<body class="text-center">
    <form href="#" class="form-signin">
      <img class="mb-4" src="https://plugthink.com.br/wp-content/uploads/2021/05/plug_hub.png" alt="" height="35">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <div id="alert" class="alert alert-danger" style="display:none;" role="alert">
            
        </div>
      </div>
      <button id="btEnviar" class="btn btn-lg btn-primary btn-block" type="input">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© 2021</p>
    </form>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>

        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        $("form").submit(function(e){
            e.preventDefault();
            let inputEmail = $("#inputEmail").val();
            let inputPassword = $("#inputPassword").val();

            $.ajax({
                url: "api/login.php?email="+inputEmail+"&passwd="+inputPassword,
                success: function(response){

                    if(response['StatusCode'] == "OK"){
                        window.location.replace("index.php");
                    }else{
                        $("#alert").text(response['Status']);
                        $("#alert").show();
                    }
                }
            });
        });
    </script>

</body>

</html>