<?php
    include '../conexao.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$Titulo_head;?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/simple-sidebar.css" rel="stylesheet" id="sidebar-css">
    <link href="css/style.css" rel="stylesheet" id="style">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>

<div class="d-flex" id="wrapper">
<!-- Menu -->
<div class="bg-light border-right" id="sidebar-wrapper">
    <img src="../assets/logoif.png" />
        <div class="sidebar-heading cabecalho-titulo text-center"><?php echo $Titulo_menu?><p class="text-right p-cadastro"></p>
        </div>
            <div class="list-group list-group-flush">
                <a href="./register.php" class='list-group-item list-group-item-action bg-light'>Cadastrar</a>
            </div>
            <div class="list-group list-group-flush">
                <a href="../index.php" class='list-group-item list-group-item-action bg-light'>Voltar</a>
            </div>
        </div>
<!-- /Menu -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom bg-sup">
            <button class="btn btn-primary bt-menu" id="menu-toggle">
                <img src="icons/chevron-right.svg" alt="" width="24" height="24" title="Facebook">
            </button>
        </nav>

      <div class="container-fluid">
            <div class="row">
                <div class="espaco"> &nbsp; </div>

                <!--CARD-->
                <div class="col-xs-12 col-md-10 offset-md-1">
                    <div class="image-flip">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="col-xs-6">

                                            <!-- FORMULÁRIO -->
                                            <div id="formulario-cadastro">
                                                <form method="POST"  enctype="multipart/form-data">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-12 col-md-3 col-form-label">E-mail:</label>
                                                            <div class="col-sm-12 col-md-9">
                                                                <input type="email" name="txtEmail" class="campo form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-12 col-md-3 col-form-label">Senha:</label>
                                                            <div class="col-sm-12 col-md-9">
                                                                <input type="password" name="txtSenha" class="campo form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                        <div class="col-sm-12">
                                                        <label class="form-check-label" for="disabledFieldsetCheck">
                                                        Não tem conta? <a href="./register.php">CADASTRE-SE.</a> 
                                                            </label><br>
                                                            <input type="submit" value="Logar" name="btLogar" class="btn btn-primary" >
                                                        </div>
                                                        
                                                        </div>
                                                    </div>  
                                                </form>
                                            </div>
                                            <!-- ./FORMULÁRIO -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./CARD-->
               
                

                
                <div class="espaco"> &nbsp; </div>
            </div>
            
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<?php
    include("rodape.php");
?>
<!-- validação de dados -->

<?php
    if(isset($_POST["btLogar"])){
        $email=$_POST["txtEmail"];
        $senha=$_POST["txtSenha"];

        if(isset($email)and isset($senha)){
            $senha=md5($senha);
           $sql="SELECT * FROM usuario WHERE email='$email' and senha='$senha'";
           $retorno = $conexao->query($sql);
           if($retorno->num_rows>0){
            $line=$retorno->fetch_array();
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['id'] = $line['idusuario'];  
            $_SESSION['servidor'] = $line['servidor'];          
            echo "<script>document.location='systemHome.php'</script>";
           
            }else{
            echo "<script>alert('Usuário ou senha incorreto');</script>";
            }
        }else{
            echo "<script>alert('Usuário ou senha incorreto');</script>";
            }
    }
?>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>
</html>