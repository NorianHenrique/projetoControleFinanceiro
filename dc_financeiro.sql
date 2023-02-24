-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "despesa" --------------------------------------
CREATE TABLE `despesa`( 
	`id` Int( 0 ) AUTO_INCREMENT NOT NULL,
	`id_usuario` Int( 0 ) NOT NULL,
	`descricao` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`vencimento` Date NOT NULL,
	`data_pagamento` Date NULL DEFAULT NULL,
	`situacao` VarChar( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`date_create` Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` Timestamp NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT NULL,
	`valor` Double( 10, 2 ) NOT NULL DEFAULT 0.00,
	`pagamento` VarChar( 30 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`desconto` Double( 10, 2 ) NOT NULL DEFAULT 0.00,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 17;
-- -------------------------------------------------------------


-- CREATE TABLE "pagamento" ------------------------------------
CREATE TABLE `pagamento`( 
	`id` Int( 0 ) AUTO_INCREMENT NOT NULL,
	`nome` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- -------------------------------------------------------------


-- CREATE TABLE "usuario" --------------------------------------
CREATE TABLE `usuario`( 
	`id` Int( 0 ) AUTO_INCREMENT NOT NULL,
	`email` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`nome_completo` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`login` VarChar( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`senha` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`telefone` VarChar( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	`date_create` Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` Timestamp NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 5;
-- -------------------------------------------------------------


-- Dump data of "despesa" ----------------------------------
BEGIN;

INSERT INTO `despesa`(`id`,`id_usuario`,`descricao`,`vencimento`,`data_pagamento`,`situacao`,`date_create`,`date_update`,`valor`,`pagamento`,`desconto`) VALUES 
( '1', '1', 'Conta de Luz', '2022-02-25', '2022-02-19', 'Pago', '2022-02-19 01:18:04', '2022-02-20 15:37:20', '180.00', 'Dinheiro', '0.00' ),
( '3', '1', 'Internet', '2022-02-22', NULL, 'Apagar', '2022-02-19 03:06:53', '2022-02-20 15:38:32', '99.99', 'Dinheiro', '0.00' ),
( '4', '1', 'Conta de Água', '2022-02-19', '2022-02-19', 'Pago', '2022-02-19 23:17:56', '2022-02-20 15:40:50', '79.00', 'Debito', '0.00' ),
( '5', '1', 'Conta de Telefone', '2022-02-20', '2021-02-19', 'Pago', '2022-02-19 23:17:58', '2022-02-20 15:43:49', '45.00', 'Credito', '0.00' ),
( '6', '1', 'Gás', '2022-02-10', NULL, 'Apagar', '2022-02-19 23:17:59', '2022-02-20 16:54:54', '100.00', 'Credito', '0.00' ),
( '7', '1', 'Alimentação', '2022-02-10', '2022-02-19', 'Pago', '2022-02-19 23:18:00', '2022-02-20 16:11:42', '513.00', 'Debito', '27.00' ),
( '8', '1', 'Gasolina', '2022-02-24', NULL, 'Apagar', '2022-02-19 23:18:01', '2022-02-20 16:12:23', '28.50', 'Debito', '1.50' ),
( '9', '1', 'Remédio', '2022-02-22', NULL, 'Apagar', '2022-02-19 23:18:01', '2022-02-20 15:41:37', '89.98', 'Credito', '0.00' ),
( '10', '1', 'Escola', '2022-02-19', NULL, 'Apagar', '2022-02-19 23:18:02', '2022-02-20 15:41:46', '435.90', 'Credito', '0.00' ),
( '11', '1', 'Aluguel', '2022-02-18', '2022-02-19', 'Pago', '2022-02-19 23:18:03', '2022-02-20 15:43:38', '678.89', 'Debito', '0.00' ),
( '12', '1', 'Diaria', '2022-02-28', NULL, 'Apagar', '2022-02-19 23:18:03', '2022-02-20 16:06:30', '108.00', 'Dinheiro', '12.00' ),
( '13', '1', 'Manutenção Carro', '2022-02-19', '2022-02-18', 'Pago', '2022-02-19 23:18:03', '2022-02-20 15:43:09', '675.00', 'Dinheiro', '0.00' ),
( '14', '1', 'Gasolina', '2022-02-11', NULL, 'Apagar', '2022-02-19 23:18:04', '2022-02-20 15:42:18', '70.00', 'Credito', '0.00' ),
( '15', '1', 'Conta de Telefone', '2022-02-17', '2022-02-19', 'Pago', '2022-02-19 23:18:06', '2022-02-20 15:42:04', '35.90', 'Credito', '0.00' ),
( '16', '1', 'Hospedagem', '2022-02-22', '2022-02-20', 'Pago', '2022-02-20 15:55:27', NULL, '450.00', 'dinheiro', '0.00' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "pagamento" --------------------------------
BEGIN;

INSERT INTO `pagamento`(`id`,`nome`) VALUES 
( '1', 'Dinheiro' ),
( '2', 'Debito' ),
( '3', 'Credito' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "usuario" ----------------------------------
BEGIN;

INSERT INTO `usuario`(`id`,`email`,`nome_completo`,`login`,`senha`,`telefone`,`date_create`,`date_update`) VALUES 
( '1', 'eduardo@dankicode.com', 'eduardo ', 'eduardo', '$2y$10$1l/xz97.Bos.BWnrg2HzrupSBNt1Q8s5D/3tuChSlE8GUb1dBTA4W', '2299999-9999', '2022-02-18 02:32:01', '2022-02-17 23:10:40' ),
( '2', 'teste@dankicode.com', 'teste', 'teste', '$2y$10$NxXo/tPH1jqjbVOpZA0vX.h9bBpXHBehYtQK0suUrBMaVOMPtsPNW', '2298899-2888', '2022-02-18 21:44:43', NULL );
COMMIT;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


