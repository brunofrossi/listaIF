<?php
    include '../conexao.php';
    session_start();
    $servidor=$_SESSION['servidor']; 
    if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)or ($_SESSION['servidor']<>1) )
    {
  unset($_SESSION['email']);
  unset($_SESSION['senha']);
  header('location:index.php');
  }

  $id = $_SESSION['id'];

    if(isset($_GET["ativar"])){
        //Query Atualizar
        $idcomercio=$_GET["ativar"];
        $sql="UPDATE `comercio` SET  aprovado=1  WHERE idcomercio = $idcomercio";
        $conexao->query($sql);

        if($conexao->errno > 0){
            echo "<script>alert('Erro ao cadastrar o registro');</script>";
            echo var_dump($sql);
            echo var_dump($conexao);
        }
    }    
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
   <?php
    include("menu.php");
    ?>
    <!-- /Menu -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom bg-sup">
            <button class="btn btn-primary bt-menu" id="menu-toggle">
                <img src="icons/list.svg" alt="" width="24" height="24" title="Facebook">
            </button>
            <div class="d-flex justify-content-end sair-bt">
                <a href="sair.php" class="btn btn-danger">Sair</a>
            </div>
        </nav>

      <div class="container-fluid">
            <div class="row">
                <div class="espaco"> &nbsp; </div>

                
                <!--CARD-->
                <div class="col-xs-12 col-md-10 offset-md-1">
                    <!--<div class="image-flip">
                        <div class="mainflip">
                            <div class="frontside">-->
                               
                                <!--Listando os cadastros-->
                                <div calss="table-responsive">
                                    <table class="table table-hover">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>Responsavel</th>
                                        <th> </th>
                                    </tr>
                                    <?php
                                        //Exibir os itens gravados
                                        $sql = "SELECT * FROM comercio  WHERE 	aprovado =0";
                                        $resultado= $conexao->query($sql);
                                        while($linha=$resultado->fetch_array()){
                                            echo "<tr>";
                                            echo "<td>".$linha["nome_fantasia"]."</td>";
                                            echo "<td>".$linha["telefone"]."</td>";
                                            echo "<td>".$linha["nome_responsavel"]."</td>";
                                            echo "<td><a href='activate.php?ativar=".$linha["idcomercio"]."'><img src='icons/card-heading.svg' alt='Alterar' title='Alterar'> Ativar</a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                    </table>
                                </div>
                                <!-- ./Listando os cadastros -->

                            <!-- </div>
                        </div>
                    </div> -->
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
<!--Script-->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>
</html>