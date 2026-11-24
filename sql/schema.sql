CREATE DATABASE IF NOT EXISTS ecoleta
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE ecoleta;


CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS coletas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome_contato VARCHAR(120) NOT NULL,
    telefone VARCHAR(30) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    material ENUM('Papel', 'Plástico', 'Vidro', 'Metal', 'Eletrônicos', 'Óleo de cozinha', 'Outros') NOT NULL,
    data_desejada DATE NOT NULL,
    observacoes TEXT NULL,
    status ENUM('Recebida', 'Em andamento', 'Concluída', 'Cancelada') NOT NULL DEFAULT 'Recebida',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_coletas_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS pontos_coleta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    materiais VARCHAR(255) NOT NULL,
    icone VARCHAR(20) DEFAULT '♻',
    cor_icone VARCHAR(20) DEFAULT 'green',
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS mensagens_contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL,
    assunto VARCHAR(180) NOT NULL,
    mensagem TEXT NOT NULL,
    lida TINYINT(1) NOT NULL DEFAULT 0,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


INSERT INTO pontos_coleta (nome, categoria, descricao, endereco, materiais, icone, cor_icone) VALUES
('Ecoponto Central', 'RECICLÁVEIS', 'Recebimento de papel, plástico e metal limpos e separados.', 'Av. Principal, 100', 'Papel,Plástico,Metal', '♻', 'green'),
('Ponto Tecnológico', 'ESPECIAIS', 'Exemplo de local para descarte de pequenos eletrônicos e cabos.', 'Rua da Tecnologia, 250', 'Eletrônicos', '⌁', 'blue'),
('Estação do Vidro', 'VIDRO', 'Exemplo de recebimento de garrafas e potes de vidro vazios.', 'Rua Ambiental, 80', 'Vidro', '◇', 'yellow');


INSERT INTO usuarios (nome, email, senha_hash) VALUES
('Usuário Demo', 'demo@ecoleta.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe.3z/4d7xZ3.G8z.lF8/G0y1s7.0e1K2');