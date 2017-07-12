/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.11 : Database - sortmylife-api
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `sortmylife-symfony`;

/*Table structure for table `author` */

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` longtext COLLATE utf8_unicode_ci,
  `birthday` datetime DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `author` */

insert  into `author`(`id`,`name`,`bio`,`birthday`,`photo`,`created_at`,`updated_at`) values (2,'Aldous Huxley','Aldous Leonard Huxley foi um escritor inglês e um dos mais proeminentes membros da família Huxley. Passou parte da sua vida nos Estados Unidos, e viveu em Los Angeles de 1937 até a sua morte, em 1963.','1984-07-26 00:00:00','http://www.esquerda.net/sites/default/files/aldous-huxley2.jpg','2017-06-07 16:41:20','2017-06-07 18:46:09');
insert  into `author`(`id`,`name`,`bio`,`birthday`,`photo`,`created_at`,`updated_at`) values (3,'Jostein Gaarder','Jostein Gaarder é um escritor, professor de filosofia e intelectual norueguês. É autor de romances filosóficos, contos, e histórias. É filho de um casal de professores.','1952-08-08 00:00:00','http://citacoes.in/media/authors/21371_jostein-gaarder.jpeg','2017-06-07 18:45:21','2017-06-07 18:45:21');

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_author` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CBE5A3319B986D25` (`id_author`),
  CONSTRAINT `FK_CBE5A3319B986D25` FOREIGN KEY (`id_author`) REFERENCES `author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `book` */

insert  into `book`(`id`,`id_author`,`title`,`description`,`image`,`year`,`created_at`,`updated_at`) values (1,2,'Admirável mundo novo','Admirável Mundo Novo (Brave New World na versão original em língua inglesa) é um romance distópico escrito por Aldous Huxley e publicado em 1932 que narra um hipotético futuro onde as pessoas são pré-condicionadas biologicamente e condicionadas psicologicamente a viverem em harmonia com as leis e regras sociais, dentro de uma sociedade organizada por castas.','https://amnprojeto.files.wordpress.com/2011/11/aldous.jpg',1932,'2017-06-07 16:53:28','2017-06-07 18:42:15');
insert  into `book`(`id`,`id_author`,`title`,`description`,`image`,`year`,`created_at`,`updated_at`) values (2,2,'As Portas da Percepção','As Portas da Percepção é um livro de 1954, escrito por Aldous Huxley, onde o autor pormenoriza as suas experiências alucinatórias quando tomou mescalina.','http://culturadigital.br/contraculturadigital/files/2012/02/7780_716.jpg',1954,'2017-06-07 18:41:36','2017-06-07 18:41:36');
insert  into `book`(`id`,`id_author`,`title`,`description`,`image`,`year`,`created_at`,`updated_at`) values (3,3,'O mundo de sofia','O Mundo de Sofia é um romance escrito por Jostein Gaarder, publicado em 1991.','https://i1.wp.com/3.bp.blogspot.com/-LFcX_2S5wA0/U1WUUH6N94I/AAAAAAAAD1s/O0gZWtZNAdE/s1600/o_mundo_de_sofia.jpg',1991,'2017-06-07 18:46:48','2017-06-07 18:46:48');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
