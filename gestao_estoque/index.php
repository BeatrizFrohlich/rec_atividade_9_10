<?php
require_once('config/database.php');

$stmt = $pdo->prepare("SELECT * FROM produtos ORDER BY id DESC");
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque de Produtos</title>
</head>
<body>

    <h2>Lista de Produtos</h2>
    <p><a href="cadastrar.php"><button type="button">Cadastrar Novo Produto</button></a></p>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Validade</th>
            <th>Ações</th>
        </tr>

        <?php if (count($produtos) > 0): ?>
            <?php foreach ($produtos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nome']) ?></td>
                    <td><?= htmlspecialchars($p['categoria']) ?></td>
                    <td><?= htmlspecialchars($p['descricao']) ?></td>
                    <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                    <td><?= $p['quantidade'] ?></td>
                    <td><?= date('d/m/Y', strtotime($p['data_validade'])) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $p['id'] ?>">Editar</a> | 
                        <a href="excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Nenhum produto cadastrado.</td>
            </tr>
        <?php endif; ?>
    </table>

</body>
</html>