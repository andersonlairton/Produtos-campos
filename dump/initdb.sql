
CREATE TABLE `Categoria` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`descricao` TEXT NOT NULL COLLATE 'latin1_swedish_ci',
	`status` TINYINT(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;

CREATE TABLE `Produtos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`descricao` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'latin1_swedish_ci',
	`categoria_id` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `FK__Categoria` (`categoria_id`) USING BTREE,
	CONSTRAINT `FK__Categoria` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;
