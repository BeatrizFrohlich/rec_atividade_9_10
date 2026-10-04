<?php
require_once('config/database.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->execute([':id' => $id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header('Location: index.php');
    exit;
}

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
        $sql = "UPDATE produtos 
                SET nome = :nome, categoria = :categoria, descricao = :descricao, 
                    preco = :preco, quantidade = :quantidade, data_validade = :data_validade 
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':categoria' => $categoria,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':quantidade' => $quantidade,
            ':data_validade' => $data_validade,
            ':id' => $id
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
    <title>Editar Produto</title>
</head>
<body>

    <h2>Editar Produto #<?= $produto['id'] ?></h2>

    <?php if ($erro): ?>
        <p><strong><?= $erro ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <p>
            <label>Nome:*</label><br>
            <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
        </p>
        <p>
            <label>Categoria:*</label><br>
            <input type="text" name="categoria" value="<?= htmlspecialchars($produto['categoria']) ?>" required>
        </p>
        <p>
            <label>Descrição:</label><br>
            <textarea name="descricao"><?= htmlspecialchars($produto['descricao']) ?></textarea>
        </p>
        <p>
            <label>Preço (R$):*</label><br>
            <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required>
        </p>
        <p>
            <label>Quantidade:*</label><br>
            <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required>
        </p>
        <p>
            <label>Data de Validade:*</label><br>
            <input type="date" name="data_validade" value="<?= $produto['data_validade'] ?>" required>
        </p>
        <p>
            <button type="submit">Atualizar Produto</button>
            <a href="index.php">
                <button type="button">Cancelar</button>
            </a>
        </p>
    </form>

</body>
</html>