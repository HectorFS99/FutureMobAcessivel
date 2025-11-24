<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'conexao.php';
    session_start();
    
    $sql_categorias_header = mysql_query("SELECT `id_categoria`, `nome`, `descricao`, `caminho_icone` FROM `categorias`");
    
    $sql_quantidade_itens_carrinho = mysql_query("SELECT COUNT(DISTINCT `id_produto`) AS quantidade_itens_unicos FROM `carrinho`");
    
    $quantidade_itens = 0;
    if ($row = mysql_fetch_assoc($sql_quantidade_itens_carrinho)) {
        $quantidade_itens = $row['quantidade_itens_unicos'];
    }
?>

<header>
    <!--PLUGIN V LIBRA -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <!-- Ferramentas de acessibilidade -->
    <button id="btn-acessibilidade" class="btn-acessibilidade">
        <i class="fa-solid fa-universal-access"></i>
    </button>
    <div class="btn-group-flutuante oculto" id="grupo-acessibilidade">
        <!-- Aumentar texto -->
        <button id="aumentar-texto">
            <img src="recursos/imagens/icones/acessibilidade/a_mais.png"/>
        </button>

        <!-- Diminuir texto -->
        <button id="diminuir-texto">
            <img src="recursos/imagens/icones/acessibilidade/a_menos.png"/>
        </button>

        <!-- Alto contraste -->
        <button id="alternar-contraste">
            <img src="recursos/imagens/icones/acessibilidade/alto_contraste.png"/>
        </button>

        <!-- Preto e branco -->
        <button id="preto-e-branco">
            <img src="recursos/imagens/icones/acessibilidade/preto_e_branco.png"/>
        </button>

        <!-- Comando de voz -->
        <button id="comando-de-voz">
            <img src="recursos/imagens/icones/acessibilidade/voz.png" style="width: 30px;"/>
        </button>
    </div>

    <nav class="navbar">
        <form class="formulario">
            <div class="input-group">
                <select id="cboCategoria" class="form-select">
                    <option selected>Todos</option>
                    <?php while ($linha = mysql_fetch_assoc($sql_categorias_header)) { ?>
                        <option value="<?php echo $linha['id_categoria']; ?>"><?php echo $linha['nome']; ?></option>
                    <?php } ?>
                </select>
                <input id="txtPesquisar" type="text" class="form-control" placeholder="Encontrar sofás, mesas...">
                <button id="btnPesquisar" type="submit" class="btn btn-laranja"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <a href="pagina-inicial.php" style="width: 70px;"><img src="recursos/imagens/logos/logo_futureMob.png" width="70" /></a>
        <div class="botoes_barra_superior">
            <a href="pagina-inicial.php" class="btn-vertical">
                <i class="fa-solid fa-house"></i>
                <span>Início</span>
            </a>
            <a href="listagem-geral-produtos.php" class="btn-vertical">
                <i class="fa-solid fa-cube"></i>
                <span>Produtos</span>
            </a>
            <a href="#" onclick="window.location.href='verifica_login.php'; return false;" class="btn-vertical">
                <i class="fa-solid fa-user"></i>
                <span>Minha Conta</span>
            </a>
            <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
                <a href="admin/adm_index.php" class="btn-vertical">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span>Admin.</span>
                </a>
            <?php } ?>

            <a href="favoritos.php" class="btn-vertical">
                <i class="fa-solid fa-heart"></i>
                <span>Favoritos</span>
            </a>
            <a id="btnCarrinho" href="carrinho.php" class="btn btn-laranja">
                <i class="fa-solid fa-cart-shopping"></i>
                <span id="contador-carrinho" style="margin-left: 1rem;"><?php echo $quantidade_itens; ?></span>
            </a>
        </div>
    </nav>
</header>
