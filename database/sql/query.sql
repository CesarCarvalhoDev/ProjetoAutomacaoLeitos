DROP DATABASE IF EXISTS db_automacao_leitos;
CREATE DATABASE db_automacao_leitos
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;

USE db_automacao_leitos;

-- Tabela de cargos
CREATE TABLE cargos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Tabela de funcionários
CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    sexo VARCHAR(10) NOT NULL,
    idade INT NOT NULL,
    data_admissao DATE NOT NULL,
    cargo_id INT NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    FOREIGN KEY (cargo_id) REFERENCES cargos(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela de setores
CREATE TABLE setores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Tabela de leitos
CREATE TABLE leitos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    num_leito INT NOT NULL,
    id_setor INT NOT NULL,
    status_leito VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_setor) REFERENCES setores(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela de pacientes
CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    sexo VARCHAR(10) NOT NULL,
    idade INT NOT NULL,
    id_leito INT NOT NULL,
    id_func_resp INT NOT NULL,
    FOREIGN KEY (id_leito) REFERENCES leitos(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_func_resp) REFERENCES funcionarios(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela de pedidos
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status_pedido VARCHAR(100) DEFAULT 'Em aberto',
    tipo_pedido VARCHAR(100) NOT NULL,
    descricao VARCHAR(300) NOT NULL,
    id_paciente INT NOT NULL,
    id_setor INT NOT NULL,
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_setor) REFERENCES setores(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;
