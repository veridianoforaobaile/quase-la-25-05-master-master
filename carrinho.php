<?php 
    session_start();
    $preco = 0;
    
    include ("conecta.php");

    $comando = $pdo->prepare("SELECT * FROM carrinho WHERE usuario = :user and pedido = 0");
    $comando->bindParam(':user', $_SESSION['user']);
    $comando->execute();    
                    
    $resultado = $comando->execute();

    while( $linhas = $comando->fetch()) 
        {
            $m = $linhas["id_coisa"]; //nome da coluna xampp
            $n = $linhas["item"];

            $sql = "SELECT nome FROM produtos WHERE id_produto = :elemento";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':elemento', $n);

            // Executando a consulta
            $stmt->execute();

            $sq = "SELECT valor FROM carrinho WHERE id_coisa = :elemento";
            $stm = $pdo->prepare($sq);
            $stm->bindParam(':elemento', $m);

            // Executando a consulta
            $stm->execute();

            // Obtendo o resultado
            $resultado1 = $stm->fetchColumn();
            switch ($resultado1) {
                case "R$40,00";
                    $preco += 40;
                    break;
                case "R$60,00";
                    $preco += 60;
                    break;
                case "R$90,00":
                    $preco += 90;
                    break;
                case "R$140,00":
                    $preco += 140;
                    break;
                case "R$200,00":
                    $preco += 200;
                    break;
                case "R$500,00":
                    $preco += 500;
                    break;

            }
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - FOPPY ARCH</title>
    <link rel="stylesheet" href="css/carrinho.css" /> 
</head>
<body>
   <div class="d0">
        <div class="d1">
            <div class="tits">
                <div class="titulo">
                    <div class="flop">
                    <a href="index.html"><img src="images/floppy_arch_title.png" width="100%"></a>
                    </div>
                    <div class="criar_conta">
                        <p ><b>➝ Carrinho</b></p>    
                    </div>
                    
                </div>
                
            </div>
        </div>
        <div class="d2">
        <div class="d222">
                <div class="cima">
                    <img class="foto_adm" src="images/adm.png" >

                </div>
                <div class="cima2">
                    <a href="index.php" class="sair_alterar">← Sair</a>
                    <a href="entrar.php" class="sair_alterar">Meu Perfil</a>
                </div>
                <hr class="hr1">
                    <p class="nome_adm">Valor Total ➝ R$<?php echo $preco; ?>,00</p>
                    <Button class="adicionar" onclick="pedido()">Finalizar Compra</Button>
            </div>
            <hr class="hr2">
            <div class="d21" id="puta">
                <?php
                    include ("conecta.php");
                        $comando = $pdo->prepare("SELECT * FROM carrinho WHERE usuario = :user AND pedido = 0");
                        $comando->bindParam(':user', $_SESSION['user']);
                        $comando->execute();    
                    
                        $resultado = $comando->execute();

                        while( $linhas = $comando->fetch()) 
                            {
                                $m = $linhas["id_coisa"]; //nome da coluna xampp
                                $n = $linhas["item"];

                                                            echo('
                                <div class="perfil">
                                    <img class="fotos_perfis" src="');
                                   

                                    // Preparando a consulta
                                    $sql = "SELECT caminhofoto FROM produtos WHERE id_produto = :elemento";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindParam(':elemento', $n);

                                    // Executando a consulta
                                    $stmt->execute();

                                    // Obtendo o resultado
                                    $resultado = $stmt->fetchColumn();
                                    echo("$resultado");

                                    echo ('">
                                    <div class="cimabaixo">
                                        <p class="nome_perfil">');
                                        $sql = "SELECT nome FROM produtos WHERE id_produto = :elemento";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->bindParam(':elemento', $n);
    
                                        // Executando a consulta
                                        $stmt->execute();
                                        $sq = "SELECT valor FROM carrinho WHERE id_coisa = :elemento";
                                        $stm = $pdo->prepare($sq);
                                        $stm->bindParam(':elemento', $m);

                                        // Executando a consulta
                                        $stm->execute();

                                        // Obtendo o resultado
                                        $resultado1 = $stm->fetchColumn();
                                        switch ($resultado1) {
                                            case "R$40,00":
                                                $rs = "32gb";
                                                $preco += 40;
                                                break;
                                            case "R$60,00";
                                                $rs = "64gb";
                                                $preco += 60;
                                                break;
                                            case "R$90,00":
                                                $rs = "128gb";
                                                $preco += 90;
                                                break;
                                            case "R$140,00":
                                                $rs = "240gb";
                                                $preco += 140;
                                                break;
                                            case "R$200,00":
                                                $rs = "480gb";
                                                $preco += 200;
                                                break;
                                            case "R$500,00":
                                                $rs = "960gb";
                                                $preco += 500;
                                                break;

                                        }
                                        $capacidade = $rs;

                                        
                                        // Obtendo o resultado
                                        $resultado = $stmt->fetchColumn();
                                        echo("$resultado");
                                        echo(" ($capacidade)");
                                        echo('
                                        </p>
                                        <div class="botoes_perfil">');
                                        
                                        echo $resultado1;

                                        echo('
                                        
                                        </div>
                                        
                                        <div style="background-color:red;   font-weight: bold; width:10%; height:20%; display: flex; border-radius:10px;justify-content: center;
                                        justify-items: center;
                                        align-items: center;
                                        align-content: center;" onclick="Enviar(\'' . $m . '\')">X</div>
                                    </div>
                                </div>
                                <hr class="hr3">
                            ');

                                
                            }

                ?>
            </div>
            
            
        </div>

        
        <?php echo $preco; ?>
    </div>  
</body>
<script>
    if ("<?php echo $_SESSION['user']; ?>" === "none") {
            alert("Primeiramente faça login");
            window.open("entrar.php","_self");
        }
    function pedido() {
        window.open("pedido.php","_self");
    }
    function Enviar(codigo) {
        window.open("excluir_carrinho.php?codigo="+codigo,"_self")
    }
    texto_menu.style.display="inline";
    menu.style.display="none";
    function ocultar()
    {
        texto_menu.style.display="none";
        menu.style.display="inline";
    }
    function aparecer()
    {
        texto_menu.style.display="inline";
        menu.style.display="none";
    }        
    function voltarPagina() 
    {
        window.history.back();
    }
</script>
</html>