-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para bd_tcc
CREATE DATABASE IF NOT EXISTS `bd_tcc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bd_tcc`;

-- Copiando estrutura para tabela bd_tcc.tb_cliente
CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `id_Cliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Cliente` varchar(20) NOT NULL,
  `Telefone_Cliente` varchar(16) NOT NULL,
  `Sobrenome_Cliente` varchar(20) NOT NULL,
  `Email_Cliente` varchar(30) NOT NULL,
  PRIMARY KEY (`id_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bd_tcc.tb_cliente: ~7 rows (aproximadamente)
INSERT INTO `tb_cliente` (`id_Cliente`, `Nome_Cliente`, `Telefone_Cliente`, `Sobrenome_Cliente`, `Email_Cliente`) VALUES
	(1, 'Maria', '(33) 33333-3333', 'Clara', 'Maria@gmail.com'),
	(2, 'Thiago', '(44) 44444-4444', 'Simas', 'Thiago@gmail.com'),
	(3, 'Valeria', '(55) 55555-5555', 'Almeida', 'Valeria@gmail.com'),
	(4, 'Felipe', '(17) 98841-0585', 'Santino', 'Joaquimvictor536@gmail.com'),
	(5, 'Maria', '(12) 31231-2312', 'Antonia', 'Maria@gmail.com'),
	(6, 'Emanuel', '(17) 89843-7890', 'Castilho', 'Emanuu@gmail.com'),
	(7, 'Manuela', '(18) 45893-4534', 'Sorocaba', 'ManuuEla@gmail.com');

-- Copiando estrutura para tabela bd_tcc.tb_funcionario
CREATE TABLE IF NOT EXISTS `tb_funcionario` (
  `nome` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL DEFAULT '../../arquivos/pfp.png',
  `data_upload` datetime DEFAULT current_timestamp(),
  `id_Funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Funcionario` varchar(40) NOT NULL,
  `Telefone_Funcionario` varchar(16) NOT NULL,
  `CPF_Funcionario` varchar(20) NOT NULL,
  `RG_Funcionario` varchar(20) NOT NULL,
  `Tipo_Funcionario` int(11) NOT NULL DEFAULT 0,
  `Data_Entrada` date NOT NULL,
  `Data_Saida` date DEFAULT NULL,
  `Login` varchar(40) NOT NULL,
  `Senha` varchar(20) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_Funcionario`),
  UNIQUE KEY `Telefone_Funcionario` (`Telefone_Funcionario`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bd_tcc.tb_funcionario: ~6 rows (aproximadamente)
INSERT INTO `tb_funcionario` (`nome`, `path`, `data_upload`, `id_Funcionario`, `Nome_Funcionario`, `Telefone_Funcionario`, `CPF_Funcionario`, `RG_Funcionario`, `Tipo_Funcionario`, `Data_Entrada`, `Data_Saida`, `Login`, `Senha`, `Status`) VALUES
	('', '../../arquivos/66ef173a3a4a5.jpg', '2024-09-21 15:58:02', 1, 'ADM', '(44) 44444-4444', '444.444.444-44', '44.444.444-4', 1, '2006-05-31', NULL, 'ADM@gmail.com', '123', 1),
	('', '../../arquivos/pfp.png', '2024-09-21 14:41:50', 2, 'FUNCIONARIO', '(55) 55555-5555', '555.555.555-55', '55.555.555-5', 0, '2006-05-31', NULL, 'FUNCIONARIO@gmail.com', '123', 1),
	('', '../../arquivos/pfp.png', '2024-09-21 14:41:50', 3, 'Andersson', '(66) 66666-6666', '666.666.666-66', '66.666.666-6', 0, '2006-05-31', NULL, 'Andersson@gmail.com', '123', 0),
	('', '../../arquivos/pfp.png', '2024-09-21 15:11:21', 4, 'Lucas Mura', '(17) 98841-0585', '454.545.454-55', '45.454.545-4', 0, '2024-09-21', NULL, 'LucasMura@gmail.com', '123456', 1),
	('', '../../arquivos/pfp.png', '2024-09-21 15:11:57', 5, 'Bruno Henrique', '(15) 23662-3623', '787.878.787-87', '78.878.787-8', 0, '2024-09-21', NULL, 'Bruno@enrique.com', '12345', 1),
	('', '../../arquivos/pfp.png', '2024-09-21 15:12:25', 6, 'GianLuca', '(13) 13131-3131', '898.989.898-98', '89.898.988-9', 0, '2024-09-21', NULL, 'GianLuca@gmail.com', '12345', 1);

-- Copiando estrutura para tabela bd_tcc.tb_produto
CREATE TABLE IF NOT EXISTS `tb_produto` (
  `id_Produto` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Produto` varchar(30) NOT NULL,
  `Quantidade_Estoque` int(11) NOT NULL,
  `Valor_Unitario` float NOT NULL,
  `Descricao_Produto` varchar(300) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_Produto`),
  UNIQUE KEY `Nome_Produto` (`Nome_Produto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bd_tcc.tb_produto: ~6 rows (aproximadamente)
INSERT INTO `tb_produto` (`id_Produto`, `Nome_Produto`, `Quantidade_Estoque`, `Valor_Unitario`, `Descricao_Produto`, `Status`) VALUES
	(1, 'Gel de cabelo', 0, 22.5, 'Muito bom, mas muito forte', 1),
	(2, 'Pente', 139, 2.5, 'Muito bom e muito resistente', 1),
	(3, 'Escova', 3, 4, 'Rotatoria e eletrica', 1),
	(4, 'Gel Embeleze', 111, 30.4, 'Gel da embeleze muito bom recomendo top', 1),
	(5, 'Creme de barbear', 40, 70.8, 'Creme de barbear de marca irrelevante', 1),
	(6, 'Clipe de cabelo', 12, 5, 'Muito bons, muito fortes', 1);

-- Copiando estrutura para tabela bd_tcc.tb_servico
CREATE TABLE IF NOT EXISTS `tb_servico` (
  `id_Servico` int(11) NOT NULL AUTO_INCREMENT,
  `cod_Funcionario` int(11) DEFAULT NULL,
  `cod_Cliente` int(11) DEFAULT NULL,
  `Metodo_Pagamento` varchar(15) NOT NULL,
  `Data_Servico` date NOT NULL,
  `Horario_Servico` time NOT NULL,
  `Valor_Total` float NOT NULL,
  `Descricao_Corte` varchar(200) NOT NULL,
  `tags` varchar(200) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_Servico`),
  KEY `cod_Funcionario` (`cod_Funcionario`),
  KEY `cod_Cliente` (`cod_Cliente`),
  CONSTRAINT `tb_servico_ibfk_1` FOREIGN KEY (`cod_Funcionario`) REFERENCES `tb_funcionario` (`id_Funcionario`),
  CONSTRAINT `tb_servico_ibfk_2` FOREIGN KEY (`cod_Cliente`) REFERENCES `tb_cliente` (`id_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bd_tcc.tb_servico: ~11 rows (aproximadamente)
INSERT INTO `tb_servico` (`id_Servico`, `cod_Funcionario`, `cod_Cliente`, `Metodo_Pagamento`, `Data_Servico`, `Horario_Servico`, `Valor_Total`, `Descricao_Corte`, `tags`, `Status`) VALUES
	(1, 1, 1, 'pix', '2024-05-21', '12:35:00', 255.25, 'corte simples', NULL, 0),
	(2, 2, 2, 'pix', '2024-05-21', '12:35:00', 255.25, 'corte simples', NULL, 0),
	(3, 3, 3, 'pix', '2024-05-21', '12:35:00', 255.25, 'corte simples', NULL, 0),
	(4, 4, 6, 'PIX', '2024-10-07', '12:00:00', 125, 'Corte complexo, mullet', 'corte-elaborado', 1),
	(5, 2, 4, 'DINHEIRO', '2024-10-11', '14:40:00', 50, 'Corte elaborado com miçangas', 'corte-elaborado', 1),
	(6, 2, 5, 'PIX', '2024-09-30', '12:20:00', 200, 'Tintura vermelha com mechas rosas', 'corte-elaborado / luzes / tintura', 0),
	(7, 2, 2, 'DINHEIRO', '2024-10-06', '14:14:00', 70, 'Corte padrão', 'corte-simples', 1),
	(8, 2, 7, 'CRÉDITO', '2024-10-02', '15:30:00', 75, 'Corte apenas', 'corte-simples', 1),
	(10, 5, 4, 'PIX', '2024-10-10', '16:30:00', 230, 'Corte, barba, mullet estilo lenhador', 'corte-elaborado / barba', 1),
	(11, 6, 7, 'PIX', '2024-10-08', '12:30:00', 100, 'Corte simples', 'corte-simples', 1),
	(12, 5, 2, 'PIX', '2024-10-09', '13:40:00', 141.4, 'Corte padrao basico tigela', 'corte-simples', 0);

-- Copiando estrutura para tabela bd_tcc.tb_venda_produto
CREATE TABLE IF NOT EXISTS `tb_venda_produto` (
  `id_Venda_Produto` int(11) NOT NULL AUTO_INCREMENT,
  `cod_Produto` int(11) DEFAULT NULL,
  `cod_Servico` int(11) DEFAULT NULL,
  `Quantidade_Produto` int(11) NOT NULL,
  `valor_parcial` float DEFAULT NULL,
  PRIMARY KEY (`id_Venda_Produto`),
  KEY `cod_Produto` (`cod_Produto`),
  KEY `cod_Servico` (`cod_Servico`),
  CONSTRAINT `tb_venda_produto_ibfk_1` FOREIGN KEY (`cod_Produto`) REFERENCES `tb_produto` (`id_Produto`),
  CONSTRAINT `tb_venda_produto_ibfk_2` FOREIGN KEY (`cod_Servico`) REFERENCES `tb_servico` (`id_Servico`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bd_tcc.tb_venda_produto: ~10 rows (aproximadamente)
INSERT INTO `tb_venda_produto` (`id_Venda_Produto`, `cod_Produto`, `cod_Servico`, `Quantidade_Produto`, `valor_parcial`) VALUES
	(1, 1, 1, 2, NULL),
	(2, 2, 1, 10, NULL),
	(3, 3, 2, 3, NULL),
	(4, 1, 3, 5, NULL),
	(5, 2, 3, 1, NULL),
	(6, 3, 3, 20, NULL),
	(7, 1, 6, 12, 270),
	(8, 2, 6, 1, 2.5),
	(9, 2, 12, 5, 12.5),
	(10, 3, 12, 3, 12);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
