CREATE DATABASE IF NOT EXISTS gestao_estoque;
USE gestao_estoque;

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    data_validade DATE NOT NULL
);