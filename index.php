<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: https://hipersenna.com.br/login.php');
    exit();
}

//include('config/config.php');

// Inclui a navbar
//include('config/navbar.php');

// Obtém o nome do usuário logado
$user_name = $_SESSION['nome_usuario'];

// Obtém informações adicionais do usuário logado
$sql = 'SELECT user_filial FROM usuarios WHERE user_name = :user_name';
$query = $conexao_pdo->prepare($sql);
$query->bindParam(':user_name', $user_name, PDO::PARAM_STR);
$query->execute();
$usuario_info = $query->fetch(PDO::FETCH_ASSOC);
$row_filial = $usuario_info['user_filial'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/formProd.css">
    <script src="./js/dados.js" defer></script>
    <script src="./js/formProd.js?=2" defer></script>
    <script src="./js/descricao.js" defer></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Vencimento</title>
</head>
<body>
<header class="cabecalho">
    <nav class="navigation">
        <div class="logo">
            <img src="./assets/img/logo-hipersenna.png" alt="Logo do HiperSenna">
        </div>
    </nav>
</header>
<main class="conteudo">
<section class="validade">
    <h1 class="titulo">Validade</h1>
    <p>Insira as informações dos produtos abaixo</p>
    <div class="inserir_validade form_container">
        <form class="form__validade_prod">
            <div class="mb-3 line">
                <label for="codProd" class="form-label">Código do produto</label>
                <div class="input_container">
                    <input type="number" class="form-control" id="codProd">
                    <div class="result_container">
                        <p class="result_descricao"></p>
                    </div>
                </div>
                <div class="data-quantidade_container">
                    <div class="input__data_container">
                        <label for="data">Data de validade</label>
                        <input type="date" name="data" id="data" class="form-control" placeholder="DD/MM/AAAA">
                    </div>
                    <div class="input__quantidade_container">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" name="quantidade" id="quantidade" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary" id="prodInserir">Inserir</button>
                <div class="form-text">Digite o código do produto e espere o sistema encontrar a descrição correta</div>
            </div>
            <div class="list__prod_container table-responsive">
                <table class="table table-striped text-nowrap" id="produtos">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Desc</th>
                            <th scope="col">Dt. Validade</th>
                            <th scope="col">Quant.</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="produtosList">
                         
                    </tbody>
                </table>
            </div>
            <div class="button_container">
                <a href="./index.html"><button type="button" class="btn btn-secondary">Voltar</button></a>
                <button type="submit" class="btn btn-primary" id="next">Enviar</button>
            </div>
        </form>
    </div>
</section>
</main>
</body>
</html>