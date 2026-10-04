<?php
require_once('config/database.php');

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $data_validade = $_POST['data_validade'];

    if (empty($nome) || empty($categoria) || empty($preco) || empty($quantidade) || empty($data_validade)) {
        $erro = "Preencha todos os campos obrigatórios!";
    } else {
        $sql = "INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, data_validade) 
                VALUES (:nome, :categoria, :descricao, :preco, :quantidade, :data_validade)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':categoria' => $categoria,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':quantidade' => $quantidade,
            ':data_validade' => $data_validade
        ]);

        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>

    <h2>Cadastrar Novo Produto</h2>

    <?php if ($erro): ?>
        <p><strong><?= $erro ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <p>
            <label>Nome:*</label><br>
            <input type="text" name="nome" required>
        </p>
        <p>
            <label>Categoria:*</label><br>
            <input type="text" name="categoria" required>
        </p>
        <p>
            <label>Descrição:</label><br>
            <textarea name="descricao"></textarea>
        </p>
        <p>
            <label>Preço (R$):*</label><br>
            <input type="number" step="0.01" name="preco" required>
        </p>
        <p>
            <label>Quantidade:*</label><br>
            <input type="number" name="quantidade" required>
        </p>
        <p>
            <label>Data de Validade:*</label><br>
            <input type="date" name="data_validade" required>
        </p>
        <p>
            <button type="submit">Salvar Produto</button>
            <a href="index.php">
                <button type="button">Voltar</button>
            </a>
        </p>
    </form>

</body>
</html>