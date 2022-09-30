-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tallerAplicaciones
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tallerAplicaciones
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tallerAplicaciones` ;
USE `tallerAplicaciones` ;

-- -----------------------------------------------------
-- Table `tallerAplicaciones`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tallerAplicaciones`.`persona` (
  `idpersona` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `primerApellido` VARCHAR(45) NULL,
  `segundoApellido` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `sexo` VARCHAR(45) NULL,
  `ci` VARCHAR(45) NULL,
  PRIMARY KEY (`idpersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tallerAplicaciones`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tallerAplicaciones`.`rol` (
  `idrol` INT NOT NULL AUTO_INCREMENT,
  `nombreRol` VARCHAR(45) NULL,
  PRIMARY KEY (`idrol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tallerAplicaciones`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tallerAplicaciones`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NULL,
  `clave` VARCHAR(255) NULL,
  `token` VARCHAR(255) NULL,
  `persona_idpersona` INT NOT NULL,
  `rol_idrol` INT NOT NULL,
  PRIMARY KEY (`idusuario`, `persona_idpersona`, `rol_idrol`),
  INDEX `fk_usuario_persona_idx` (`persona_idpersona` ASC),
  INDEX `fk_usuario_rol1_idx` (`rol_idrol` ASC),
  CONSTRAINT `fk_usuario_persona`
    FOREIGN KEY (`persona_idpersona`)
    REFERENCES `tallerAplicaciones`.`persona` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_rol1`
    FOREIGN KEY (`rol_idrol`)
    REFERENCES `tallerAplicaciones`.`rol` (`idrol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tallerAplicaciones`.`noticia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tallerAplicaciones`.`noticia` (
  `idnoticia` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NULL,
  `descripcionCorta` VARCHAR(255) NULL,
  `descripcionLarga` LONGTEXT NULL,
  `foto` VARCHAR(255) NULL,
  `fechaPublicacion` DATETIME NULL,
  `llave` VARCHAR(255) NULL,
  PRIMARY KEY (`idnoticia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tallerAplicaciones`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tallerAplicaciones`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `nombreCategoria` VARCHAR(255) NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tallerAplicaciones`.`publicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tallerAplicaciones`.`publicacion` (
  `noticia_idnoticia` INT NOT NULL,
  `categoria_idcategoria` INT NOT NULL,
  INDEX `fk_publicacion_noticia1_idx` (`noticia_idnoticia` ASC),
  INDEX `fk_publicacion_categoria1_idx` (`categoria_idcategoria` ASC),
  CONSTRAINT `fk_publicacion_noticia1`
    FOREIGN KEY (`noticia_idnoticia`)
    REFERENCES `tallerAplicaciones`.`noticia` (`idnoticia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicacion_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `tallerAplicaciones`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tallerAplicaciones`.`persona`
-- -----------------------------------------------------
START TRANSACTION;
USE `tallerAplicaciones`;
INSERT INTO `tallerAplicaciones`.`persona` (`idpersona`, `nombre`, `primerApellido`, `segundoApellido`, `email`, `sexo`, `ci`) VALUES (DEFAULT, 'administrador', 'adm', 'adm', 'admin@prueba.com', 'varon', '0000000');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tallerAplicaciones`.`rol`
-- -----------------------------------------------------
START TRANSACTION;
USE `tallerAplicaciones`;
INSERT INTO `tallerAplicaciones`.`rol` (`idrol`, `nombreRol`) VALUES (1, 'administrador');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tallerAplicaciones`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `tallerAplicaciones`;
INSERT INTO `tallerAplicaciones`.`usuario` (`idusuario`, `usuario`, `clave`, `token`, `persona_idpersona`, `rol_idrol`) VALUES (1, 'admin', '$2y$04$X/EzCQzExUHTCAbERgH/Ju9halAkC.0AD/sLEC0/biawNhz31dPqm', '$2y$04$7RiztGARMb1eDEQhYeDmIupTr57tnxIHcY0xa6fg18o6sspfIPu2y', 1, 1);

COMMIT;

