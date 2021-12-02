<style>
    header{
        height:140px
    }
    nav{
        margin-top: 10px;
        height:50px;
        width:100%;
    }
    nav a{
        padding:10px;
        border-radius:3px;
        font-size:1.2em;
    }
    nav a:hover{
        text-decoration:none;
        background-color:#5897fb;
        color:black;
        transition:0.3s;
    }
    nav ul{
        display: flex;
        margin-left:150px;
    }
    nav li{
        list-style: none;
        margin-left:25px;
    }
    
    nav > ul{
        font-weight: bold;
    }
    .logo{
        width:100%;
        height:35px;
        text-align:center;
        margin-top:30px
    }
</style>

<header>
    <div class="logo">
        <img class="mb-4" src="https://plugthink.com.br/wp-content/uploads/2021/05/plug_hub.png" alt="" height="35">
    </div>
        <nav>
            <ul>
                <li><a href=".">Home</a></li>
                <li><a href="pedido.php?is_new">Pedidos</a></li>
                <li id="sair"><a href="sair.php">Sair</a></li>     
            </ul>
        </nav>
    </header>