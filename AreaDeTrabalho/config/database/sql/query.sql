USE teste_automacao;

DESC funcionarios;

/*
ALTER TABLE funcionarios ADD senha VARCHAR(8);
*/

/* 
--RENOMEANDO TABELAS NO MYSQL
RENAME TABLE paciente TO pacientes;
*/

/*
--DESCREVENDO A TABELA
*/

/*
DESC pacientes;
*/

/*ALTERANDO UMA TABELA ADICIONANDO UMA TABELA
ALTER TABLE pacientes ADD cpf VARCHAR(14);
*/

/*
ALTER TABLE pacientes ADD id_medico_responsavel INT;
*/

/*
CREATE TABLE medicos (
    id_medico INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(150) NOT NULL,
    crm VARCHAR(20) UNIQUE NOT NULL,
    especialidade VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100) UNIQUE,
    endereco VARCHAR(255),
    cidade VARCHAR(100),
    estado VARCHAR(50),
    data_admissao DATE,
    status ENUM('Ativo','Inativo') DEFAULT 'Ativo',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultima_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
*/


/*
ALTERANDO AS PROPIEDADES
ALTER TABLE medicos CHANGE id_medico cracha INT NOT NULL AUTO_INCREMENT;
*/

/*
CREATE TABLE funcionarios (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    data_nascimento DATE,
    sexo ENUM('M','F','Outro'),
    telefone VARCHAR(20),
    email VARCHAR(100),
    endereco_rua VARCHAR(100),
    endereco_num VARCHAR(10),
    endereco_bairro VARCHAR(50),
    cargo_id INT NOT NULL,
    data_admissao DATE NOT NULL,
    status ENUM('Ativo','Inativo') DEFAULT 'Ativo'
);
*/

/*
CREATE TABLE cargos (
    id_cargo INT AUTO_INCREMENT PRIMARY KEY,
    nome_cargo VARCHAR(50) NOT NULL,
    descricao TEXT
);
*/



