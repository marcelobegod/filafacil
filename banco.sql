-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema filafacil
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema filafacil
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `filafacil` DEFAULT CHARACTER SET utf8 ;
USE `filafacil` ;

-- -----------------------------------------------------
-- Table `filafacil`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filafacil`.`usuario` (
  `id_usu` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_usu` VARCHAR(50) NOT NULL,
  `email_usu` VARCHAR(100) NOT NULL,
  `senha_usu` VARCHAR(45) NOT NULL,
  `tel_usu` VARCHAR(45) NOT NULL,
  `CPF_usu` VARCHAR(13) NULL DEFAULT NULL,
  `CNPJ_usu` VARCHAR(15) NULL DEFAULT NULL,
  `nivel_usu` VARCHAR(10) NOT NULL DEFAULT 'usuario',
  `foto_usu` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usu`),
  UNIQUE INDEX `email_usu` (`email_usu` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;

<?php
	
?>


-- -----------------------------------------------------
-- Table `filafacil`.`criarfila`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filafacil`.`criarfila` (
  `id_criar_fila` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_fila` VARCHAR(45) NOT NULL,
  `qtd_fila` INT(11) NULL DEFAULT NULL,
  `data_criacao_fila` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `data_inicio_fila` DATE NOT NULL,
  `cod_acess_fila` VARCHAR(30) NULL DEFAULT NULL,
  `posicao_fila` INT(11) NOT NULL DEFAULT 0,
  `pessoa_idUsu` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_criar_fila`),
  INDEX `pessoa_idUsu` (`pessoa_idUsu` ASC) VISIBLE,
  CONSTRAINT `criarfila_ibfk_1`
    FOREIGN KEY (`pessoa_idUsu`)
    REFERENCES `filafacil`.`usuario` (`id_usu`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `filafacil`.`acessofila_especial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filafacil`.`acessofila_especial` (
  `id_acess_esp` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_acess_esp` VARCHAR(50) NULL DEFAULT NULL,
  `email_acess_esp` VARCHAR(15) NULL DEFAULT NULL,
  `telefone_acess_esp` VARCHAR(15) NOT NULL,
  `cod_acess_fila` VARCHAR(30) NULL DEFAULT NULL,
  `data_acesso_esp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `id_criar_fila` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_acess_esp`),
  INDEX `id_criar_fila` (`id_criar_fila` ASC) VISIBLE,
  CONSTRAINT `acessofila_especial_ibfk_1`
    FOREIGN KEY (`id_criar_fila`)
    REFERENCES `filafacil`.`criarfila` (`id_criar_fila`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `filafacil`.`acessofila_padrao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filafacil`.`acessofila_padrao` (
  `id_acess_pdr` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_acess_pdr` VARCHAR(50) NULL DEFAULT NULL,
  `email_acess_pdr` VARCHAR(15) NULL DEFAULT NULL,
  `telefone_acess_pdr` VARCHAR(15) NOT NULL,
  `cod_acess_fila` VARCHAR(30) NULL DEFAULT NULL,
  `data_acesso_pdr` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `id_criar_fila` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_acess_pdr`),
  INDEX `id_criar_fila` (`id_criar_fila` ASC) VISIBLE,
  CONSTRAINT `acessofila_padrao_ibfk_1`
    FOREIGN KEY (`id_criar_fila`)
    REFERENCES `filafacil`.`criarfila` (`id_criar_fila`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
