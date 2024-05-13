-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para reservas_tis
CREATE DATABASE IF NOT EXISTS `reservas_tis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `reservas_tis`;

-- Volcando estructura para tabla reservas_tis.ambiente
CREATE TABLE IF NOT EXISTS `ambiente` (
  `ID_AMBIENTE` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TIPO` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `REFERENCIAS` json NOT NULL,
  `CAPACIDAD` int NOT NULL,
  `DATA` enum('SI','NO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ESTADO` enum('HABILITADO','NO HABILITADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_AMBIENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.ambiente: ~48 rows (aproximadamente)
DELETE FROM `ambiente`;
INSERT INTO `ambiente` (`ID_AMBIENTE`, `TIPO`, `NOMBRE`, `REFERENCIAS`, `CAPACIDAD`, `DATA`, `ESTADO`, `created_at`, `updated_at`) VALUES
	('0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'Aula comun', '690A', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('0f5b1b2e-012d-4725-ae34-1f0692d9d991', 'Aula comun', '622', '["Centro de estudiantes Electromecanica", "Fotocopiadora Informatica"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('136eedd3-f082-42c0-aacd-0063d5f3562f', 'Aula comun', '690MAT', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('1a732a32-4d03-44ef-b68f-415295d316d2', 'Aula comun', '691C', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('1cc57a33-84ea-492c-87e5-f6a79b302e03', 'Aula comun', '693B', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('1eea46c6-2f09-49f2-bead-f3efab2b0e65', 'Aula comun', '690MAT', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('28bda7e0-431a-4d59-bb24-6a91d31c32a8', 'Aula comun', '652', '["Edificio central", "Cajas facultativas"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('2b56ffbe-fbcb-4c9d-adc0-c13749585e98', 'Aula comun', '625C', '["Biblioteca FCyT", "CAE"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('2ba22ebd-98b8-453d-83b0-2932719e2cb9', 'Aula comun', '692E', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('48b81aa7-58a8-498c-a279-53a66d5c55ae', 'Aula comun', '690D', '"[\\"Edificio nuevo\\",\\"Planta baja\\"]"', 150, 'NO', 'HABILITADO', '2024-05-04 08:47:20', '2024-05-04 08:47:20'),
	('49d7e8f2-f034-4b1b-a522-baebd41b2931', 'Aula comun', '690MAT', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('4d609316-26c8-4eea-8712-4b10557b4812', 'Aula comun', '690E', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('4f0c9cf2-e60c-4c17-8339-89a9a3f7361b', 'Aula comun', '608A', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('4fc37e0b-fbd6-42ec-98dd-0de200d7a4b1', 'Aula comun', '690MAT', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('58ee914d-2c7e-4b15-99f7-a79b6dcfa836', 'Aula comun', '681A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('5d7d0044-0aab-44c5-9e51-a4e7ee7b4667', 'Aula comun', '617', '["Centro de estudiantes Fisica", "Laboratorios de Fisica"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('5fe66ff0-bb2a-4940-8bbb-57363a2478ba', 'Aula comun', '692G', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('668a058c-ad61-48d2-a189-7215ebcab256', 'Aula comun', '642', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('6e5e3c20-8d52-4c7a-95a6-d5f4e38c1afd', 'Aula comun', '690E', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('72e1e337-30d5-4b49-8a0b-0cc0d3993c90', 'Aula comun', '691C', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('77b4c945-39af-4ad1-9109-1947f2bd1847', 'Aula comun', '692A', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('7b3a1bae-2462-44fa-8a2a-2658364f1de2', 'Aula comun', 'CAE', '["Biblioteca FCyT", "Segundo piso Biblioteca FCyT", "Parqueo docentes"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('7fbdd864-47f1-4eae-b9dd-87846aadd5f4', 'Aula comun', '692A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('846d1b36-bc53-4137-9b18-f664b9988d4e', 'Aula comun', '652', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('892f0cb5-7fdc-43da-b1ef-7ea8ea33718b', 'Aula comun', '681A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('8b8e4680-c970-4aea-8c0c-b71e3d45f237', 'Aula comun', '691C', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('9223467c-7564-44e6-8e42-5054da002985', 'Aula comun', '622', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('95c4f2bf-b3bb-435f-bb1a-cece1d21ecf9', 'Aula comun', '692B', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('95fae875-e318-4b97-aabf-9d549c357159', 'Aula comun', '681A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('99167a52-8ebe-4b25-99f9-c14db0c8232a', 'Aula comun', '690MAT', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('a099246b-9a37-4a88-b8a5-3cd917ca51ee', 'Aula comun', '691F', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('a186dee8-926a-4e19-b564-41df44e83233', 'Aula comun', '623', '["Centro de estudiantes Electromecanica", "Fotocopiadora Matematicas", "Areas verdes frente la puerta"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('a426ee14-886d-4b73-874a-86181341c512', 'Aula comun', '651', '["Edificio central", "Cajas facultativas"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('a70b77a8-dd33-4b57-86bc-b77bf5eddc41', 'Aula comun', '621', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('ae3c573d-ae0c-49af-a34c-2c4179957975', 'Aula comun', '690A', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('b1ab67fe-a380-4384-8d51-bef8a2883bc2', 'Aula comun', 'CAE', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('b8098afb-c2fa-48ce-a854-6341d0808901', 'Aula comun', '690MAT', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('b91b9688-bdc9-4cdb-8ee7-30b27dbd55b6', 'Aula comun', '690MAT', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('ba42b079-c7d6-4448-b21f-efaa161cd409', 'Aula comun', '608A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('ba8d666e-601d-46bf-bbe4-88fa9b9e2623', 'Aula comun', '607', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('c4b98beb-9fa9-43c0-997b-0263a67bf630', 'Aula comun', '625C', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('c694c7e4-9f03-4857-b282-7922962b4038', 'Aula comun', '693A', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('c94b2136-c5eb-4225-9f9f-f1287a91289d', 'Aula comun', '692H', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('c9c828ac-6062-4523-8cc1-0a2f7d6c4419', 'Aula comun', '692A', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('d5dfd6a7-ea25-4299-a52c-481bf133c7eb', 'Aula comun', '624', '["Centro de estudiantes Electronica", "Fotocopiadora Tecno"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('d76626c3-8858-4ca2-8c07-ee87dd022997', 'Aula comun', 'INFLAB', '["Laboratorios de informatica y sistemas", "Edificio MEMI", "Parqueo docentes"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('dd5dc074-315f-4e12-bb63-99813856cd01', 'Auditorio', 'Auditorio FCYT', '"[\\"Biblioteca FCyT\\",\\"Area verde frente la puerta\\"]"', 250, 'SI', 'HABILITADO', '2024-04-16 17:00:28', '2024-04-16 17:00:28'),
	('e45c03dd-abb3-4252-a029-b92fda3df07c', 'Aula comun', '617', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('f2433f5a-3285-4ffb-b9b2-c890141fa144', 'Aula comun', '691B', '"[\\"Edificio de aulas\\",\\"Area verde\\"]"', 150, 'NO', 'HABILITADO', '2024-05-04 08:42:46', '2024-05-04 08:42:46'),
	('f85bf540-718b-40f0-9b5c-e761b59daad4', 'Aula comun', '691B', '"[\\"Edificio de aulas\\",\\"Area verde\\"]"', 150, 'NO', 'HABILITADO', '2024-05-04 08:43:30', '2024-05-04 08:43:30'),
	('fb7df519-919a-47fe-8151-712dc5777aaf', 'Aula comun', '690E', 'null', 0, 'NO', 'HABILITADO', NULL, NULL);

-- Volcando estructura para tabla reservas_tis.docente
CREATE TABLE IF NOT EXISTS `docente` (
  `ID_DOCENTE` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NOMBRE` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GRUPO` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CELULAR` int NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_DOCENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.docente: ~47 rows (aproximadamente)
DELETE FROM `docente`;
INSERT INTO `docente` (`ID_DOCENTE`, `NOMBRE`, `GRUPO`, `CELULAR`, `EMAIL`, `created_at`, `updated_at`) VALUES
	('007ff40d-5105-47d1-9744-82a199a8436f', 'FERNANDEZ TERRAZAS ERIKA', '1', 0, '', NULL, NULL),
	('039c16c5-4de9-48d6-8238-f24e657c5eb6', 'VARGAS COLQUE AIDEE', '4', 0, '', NULL, NULL),
	('1570c086-4356-433b-9ba1-9777c192a6db', '. POR DESIGNAR', '3', 0, '', NULL, NULL),
	('15def56d-8940-4265-a2b1-123493c6fbee', 'VARGAS COLQUE AIDEE', '4', 0, '', NULL, NULL),
	('166fa387-ef06-44e9-8a3b-208ae69a15da', 'FERNANDEZ TERRAZAS ERIKA', '1', 0, '', NULL, NULL),
	('22daa7a1-81d4-49ce-ae01-44d10201b837', 'QUISPE CHOQUE VLADIMIR', '13', 0, '', NULL, NULL),
	('275e16e1-5fdf-41bb-9399-653941e76f71', 'ZURITA ORELLANA RIMER MAURICIO', '13', 0, '', NULL, NULL),
	('2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', 'SORUCO MAITA JOSE ANTONIO', '1', 0, '', NULL, NULL),
	('2e196af2-f995-4628-849c-81e83596bb3a', '. POR DESIGNAR', '3', 0, '', NULL, NULL),
	('34d07248-6027-4a4c-986e-2f882cadbb34', 'ZURITA ORELLANA RIMER MAURICIO', '13', 0, '', NULL, NULL),
	('354db6b6-be0f-4aca-a9ea-3c31e412c49d', 'TORRICO TROCHE MILKA MONICA', 'M', 0, '', NULL, NULL),
	('436e5f90-d102-44a2-b7cd-db1389e7ab49', 'SORUCO MAITA JOSE ANTONIO', '1', 0, '', NULL, NULL),
	('44890f63-6d86-4690-a07d-a87a4f4c86d1', '. POR DESIGNAR', 'H2', 0, '', NULL, NULL),
	('46f460de-2da8-4ce8-8ffe-5a646073e95a', 'RODRIGUEZ BILBAO ERIKA PATRICI', '1', 0, '', NULL, NULL),
	('4a72b14b-9529-4aa9-83fa-ebb55a210e82', 'RELOS PACO SANTIAGO', '1', 0, '', NULL, NULL),
	('4f97364e-8534-48fd-981f-822aa93d94a4', 'GONZALES CASTELLON CARLOS ESTE', '11', 0, '', NULL, NULL),
	('64725dc2-1bc6-476d-aba3-798559eb9c5a', 'VARGAS COLQUE AIDEE', '2', 0, '', NULL, NULL),
	('740b9a22-e069-4393-b883-558b58d977aa', 'RODRIGUEZ BILBAO ERIKA PATRICI', '1', 0, '', NULL, NULL),
	('7b2cbbf4-a668-4399-88c1-d5400658ece3', 'SORUCO MAITA JOSE ANTONIO', '1', 0, '', NULL, NULL),
	('7cf7f927-02c7-4442-a8dc-d045b4c612d7', 'CARRASCO CALVO ALVARO HERNANDO', '5', 0, '', NULL, NULL),
	('7f010330-f7e5-44cd-9976-7ec92d492785', 'SORUCO MAITA JOSE ANTONIO', '1', 0, '', NULL, NULL),
	('968acc82-30de-4bbf-8b40-9be8d5251468', 'SALINAS PERICON WALTER OSCAR G', '1', 0, '', NULL, NULL),
	('9e05d053-f73b-4800-a3c7-f61f38c1d388', '. POR DESIGNAR', '3', 0, '', NULL, NULL),
	('a0ee5851-1c31-45a7-9376-648d02a416d1', 'SALINAS PERICON WALTER OSCAR G', '1', 0, '', NULL, NULL),
	('a6f9695e-3d08-4e26-955b-1a75cf2d84d9', 'RELOS PACO SANTIAGO', '1', 0, '', NULL, NULL),
	('a9bc1344-1f8f-48a9-b37a-e9e4ac141e87', '. POR DESIGNAR', '1', 0, '', NULL, NULL),
	('ab5d4702-a8ff-4884-ab4d-02db4e560e12', 'JUCHANI BAZUALDO DEMETRIO', '1', 0, '', NULL, NULL),
	('b0f28d14-1be0-41ee-bc4c-6fcd50823c62', 'TORRICO TROCHE MILKA MONICA', 'M', 0, '', NULL, NULL),
	('b50e8692-6aa1-4f74-90d4-83d79a22641b', 'VARGAS COLQUE AIDEE', '2', 0, '', NULL, NULL),
	('bafdb61e-b676-40b1-a09d-eb3e9c1a1d19', '. POR DESIGNAR', '1', 0, '', NULL, NULL),
	('bfef68a6-c6e5-4798-ab26-c639bd29bb29', '. POR DESIGNAR', '1', 0, '', NULL, NULL),
	('c34627f2-6dec-4853-a50c-614af0e17e66', 'CUENCA VARGAS FERNANDO', '2', 0, '', NULL, NULL),
	('c7460556-b09c-4b10-8460-05e6183e4e42', 'CHOQUE UNO FRANCISCO', '1', 0, '', NULL, NULL),
	('c9a6f2fd-9b63-4506-a222-c96e2c784a4e', 'CHOQUE UNO FRANCISCO', '1', 0, '', NULL, NULL),
	('cb260f44-e7a6-45c1-b725-ed440cadabdf', 'RELOS PACO SANTIAGO', '1', 0, '', NULL, NULL),
	('cdb8f4d0-0dfd-4070-bc8b-517596d0b0df', 'TORRICO TROCHE MILKA MONICA', 'M', 0, '', NULL, NULL),
	('d8436376-5d84-4442-8476-03f68cc32aed', 'JUCHANI BAZUALDO DEMETRIO', '1', 0, '', NULL, NULL),
	('d8692d69-18f9-4470-bee1-471c78fb84bb', 'CARRASCO CALVO ALVARO HERNANDO', '5', 0, '', NULL, NULL),
	('dab61389-fef0-4f83-b48b-230c8f957665', 'GONZALES CASTELLON CARLOS ESTE', '11', 0, '', NULL, NULL),
	('db987d6f-7f59-452d-9416-b79be6c50be0', 'FERNANDEZ TERRAZAS ERIKA', '1', 0, '', NULL, NULL),
	('dd1552aa-786b-42de-8110-91b7114519c4', 'FERNANDEZ TERRAZAS ERIKA', '1', 0, '', NULL, NULL),
	('e776f0a6-bb66-45f8-a88b-27223711b149', 'SALINAS PERICON WALTER OSCAR G', '1', 0, '', NULL, NULL),
	('ea6466ef-d138-41bb-98cf-5c3660b76f1f', 'AUXILIAR POR DESIGNAR .', '4', 0, '', NULL, NULL),
	('f2a98457-d54b-4adb-b71a-bc2615d4d5af', 'CARRASCO CALVO ALVARO HERNANDO', '5', 0, '', NULL, NULL),
	('f664ce1f-e86b-4e26-bc24-cd321386cf25', 'SORUCO MAITA JOSE ANTONIO', '1', 0, '', NULL, NULL),
	('fd183c53-14d5-4e0b-8938-35bc56403260', 'CHOQUE UNO FRANCISCO', '1', 0, '', NULL, NULL),
	('fe9e2f4d-8ba1-4ae2-a31b-7dcc758a010a', 'JUCHANI BAZUALDO DEMETRIO', '1', 0, '', NULL, NULL);

-- Volcando estructura para tabla reservas_tis.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;

-- Volcando estructura para tabla reservas_tis.horario
CREATE TABLE IF NOT EXISTS `horario` (
  `ID_HORARIO` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `INICIO` time NOT NULL,
  `FIN` time NOT NULL,
  `DIA` enum('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_HORARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.horario: ~47 rows (aproximadamente)
DELETE FROM `horario`;
INSERT INTO `horario` (`ID_HORARIO`, `INICIO`, `FIN`, `DIA`, `created_at`, `updated_at`) VALUES
	('004e1a3f-bffa-432f-bd25-d908f1d6a644', '11:15:00', '12:45:00', 'MIERCOLES', NULL, NULL),
	('03b0afd4-e6ef-4379-b4d5-1fa10927707e', '15:45:00', '17:15:00', 'MIERCOLES', NULL, NULL),
	('043c34e4-477f-4b01-a99f-fbb9f2e6ca14', '09:45:00', '11:15:00', 'SABADO', NULL, NULL),
	('0aae2f87-f810-4c8a-9c61-56f71b046dc4', '08:15:00', '09:45:00', 'JUEVES', NULL, NULL),
	('0b68ffd5-99e9-4344-b99b-95378596059d', '18:45:00', '20:15:00', 'LUNES', NULL, NULL),
	('0b7d8d61-6f00-466c-b519-ee1f2eeabfd6', '08:15:00', '09:45:00', 'MIERCOLES', NULL, NULL),
	('0cf2c16c-ae51-4c8e-b868-f34410826f0b', '12:45:00', '14:15:00', 'LUNES', '2024-04-16 15:56:33', '2024-04-16 15:56:33'),
	('13bbbf56-13b7-474c-8b14-2849faf6ddab', '08:15:00', '09:45:00', 'SABADO', NULL, NULL),
	('24b6950a-917c-40a9-8b32-a2d23e757fad', '15:45:00', '17:15:00', 'LUNES', NULL, NULL),
	('2e5b02c2-f68d-4331-a085-89cc41d6e793', '18:45:00', '20:15:00', 'VIERNES', NULL, NULL),
	('3061c225-d17b-498b-a3dd-31518e6552d1', '14:15:00', '15:45:00', 'JUEVES', NULL, NULL),
	('30771df2-5c05-40f3-8ff7-0e194d90d915', '14:15:00', '15:45:00', 'LUNES', '2024-04-16 16:47:09', '2024-04-16 16:47:09'),
	('374b64ef-d1c1-4144-aae5-719fbffff254', '12:45:00', '14:15:00', 'LUNES', '2024-04-16 15:55:21', '2024-04-16 15:55:21'),
	('38b3ef70-7ce0-42e2-94af-3e1375c8a081', '17:15:00', '18:45:00', 'MARTES', NULL, NULL),
	('3b247498-3c6c-49ee-be37-14b1e236da0f', '18:45:00', '20:15:00', 'LUNES', NULL, NULL),
	('44235137-514c-49da-994d-1f86a837a472', '17:15:00', '18:45:00', 'LUNES', NULL, NULL),
	('4d1d8511-ce79-44a2-9da3-f05f8a0a768e', '14:15:00', '15:45:00', 'MIERCOLES', NULL, NULL),
	('6036ab5a-3c82-43b3-b3be-4b6e29a4ecce', '09:45:00', '11:15:00', 'MARTES', NULL, NULL),
	('645a1e1e-e4fb-49e4-bc08-48f4cd96cdf4', '08:15:00', '09:45:00', 'LUNES', NULL, NULL),
	('66fa9666-914d-4419-aa70-c0bd7d69518a', '11:15:00', '12:45:00', 'MARTES', NULL, NULL),
	('684352eb-bf39-46fc-91ca-c2e0b03bc377', '11:15:00', '12:45:00', 'LUNES', NULL, NULL),
	('694e6c52-c99b-4b0b-ba67-9c073d283c81', '15:45:00', '17:15:00', 'MARTES', NULL, NULL),
	('6a327ef2-6143-4134-887e-66bbe82cd24a', '09:45:00', '11:15:00', 'VIERNES', NULL, NULL),
	('72b1d8b0-f1fd-4588-ab39-d7fa979de668', '15:45:00', '17:15:00', 'MIERCOLES', NULL, NULL),
	('842eb2ce-080e-4194-98e2-80a6c31e43a5', '18:45:00', '20:15:00', 'LUNES', NULL, NULL),
	('8632c8dd-298a-48fb-b955-5160a3694080', '09:45:00', '11:15:00', 'LUNES', NULL, NULL),
	('8a21ed4f-25b9-4b82-b5e1-baef707b6570', '09:45:00', '11:15:00', 'VIERNES', NULL, NULL),
	('8a6c2273-d406-450d-8c36-3d6c142027a0', '06:45:00', '08:15:00', 'JUEVES', NULL, NULL),
	('8b7a3821-79b0-43c3-a74d-36771f4797d5', '15:45:00', '17:15:00', 'JUEVES', NULL, NULL),
	('a1939f73-3755-42d4-8c5d-fcb260f0d003', '06:45:00', '08:15:00', 'JUEVES', NULL, NULL),
	('a19acb72-b4bf-43c0-be50-35e1edfc7ed1', '18:45:00', '20:15:00', 'JUEVES', NULL, NULL),
	('a9bd9995-3794-4ba9-b7f9-7140099da9d1', '08:15:00', '09:45:00', 'VIERNES', NULL, NULL),
	('ad813392-430f-49d4-a8c2-2412a02aadcb', '09:45:00', '11:15:00', 'MARTES', NULL, NULL),
	('b807bb63-08b3-47e0-aad0-64cb21784d7a', '08:15:00', '09:45:00', 'SABADO', NULL, NULL),
	('b837a451-f557-4fa6-8bd1-50544891ec2e', '08:15:00', '10:30:00', 'VIERNES', NULL, NULL),
	('b83e7df0-ab94-42c5-b4d8-02b3716da042', '09:45:00', '11:15:00', 'LUNES', NULL, NULL),
	('b91bb79c-d88b-4473-907b-0f61d55725fb', '14:15:00', '15:45:00', 'MIERCOLES', NULL, NULL),
	('b9c3da52-2c60-4902-9dae-275f9d007c41', '08:15:00', '09:45:00', 'JUEVES', NULL, NULL),
	('bba89453-393c-4a9e-acea-c5a80e8a675d', '09:45:00', '11:15:00', 'VIERNES', NULL, NULL),
	('c32508d8-66f4-4b84-ab99-f10c27a66031', '06:45:00', '08:15:00', 'VIERNES', NULL, NULL),
	('c58fb51b-0d4b-49c6-a20e-fdc63e460790', '18:45:00', '20:15:00', 'MIERCOLES', NULL, NULL),
	('c829752f-3944-4884-8c1c-033687b4d247', '09:45:00', '11:15:00', 'LUNES', NULL, NULL),
	('cc6ba429-7098-4902-af61-3cd22cfe6397', '12:45:00', '14:15:00', 'MARTES', NULL, NULL),
	('d550444f-0909-4b64-ae35-3a15bf66a44e', '12:00:00', '14:15:00', 'MIERCOLES', NULL, NULL),
	('d6cf8bb2-29d7-43ca-a519-73b8e9ac411b', '15:45:00', '17:15:00', 'MIERCOLES', NULL, NULL),
	('e5ba9e69-a43f-454a-9267-6a877fec907b', '18:45:00', '20:15:00', 'MARTES', NULL, NULL),
	('eaf8bd6c-7625-45a6-97be-a7090c44b2dc', '10:30:00', '12:00:00', 'MIERCOLES', NULL, NULL),
	('eb2de201-7174-49fe-a5c7-8901a2b229f3', '12:00:00', '14:15:00', 'LUNES', NULL, NULL),
	('efec1860-c03b-4f02-9644-a95146419f93', '17:15:00', '18:45:00', 'LUNES', NULL, NULL),
	('fb39528b-879b-4e74-8ea0-cfd07033de13', '15:45:00', '17:15:00', 'LUNES', NULL, NULL);

-- Volcando estructura para tabla reservas_tis.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `ID_MATERIA` bigint unsigned NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TIPO` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `materia_id_materia_unique` (`ID_MATERIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.materia: ~15 rows (aproximadamente)
DELETE FROM `materia`;
INSERT INTO `materia` (`ID_MATERIA`, `NOMBRE`, `TIPO`, `created_at`, `updated_at`) VALUES
	(2002004, 'BIOLOGIA GENERAL', 'P', NULL, NULL),
	(2004046, 'QUIMICA GENERAL', 'C', NULL, NULL),
	(2006018, 'FISICA BASICA I', 'P', NULL, NULL),
	(2006027, 'FISICA II', 'C', NULL, NULL),
	(2008053, 'ALGEBRA I', 'C', NULL, NULL),
	(2008054, 'CALCULO I', 'P', NULL, NULL),
	(2008055, 'ALGEBRA LINEAL', 'C', NULL, NULL),
	(2008056, 'CALCULO II', 'C', NULL, NULL),
	(2008070, 'GEOMETRIA', 'C', NULL, NULL),
	(2008075, 'ESTRUCTURAS DISCRETAS', 'C', NULL, NULL),
	(2008077, 'PROBABILIDAD Y ESTADISTICA I', 'C', NULL, NULL),
	(2008080, 'ANALISIS I', 'C', NULL, NULL),
	(2008081, 'PROBABILIDAD Y ESTADISTICA II', 'C', NULL, NULL),
	(2008214, 'MATEMATICA COMPUTACIONAL II', 'C', NULL, NULL),
	(2010008, 'COMPUTACION I', 'C', NULL, NULL);

-- Volcando estructura para tabla reservas_tis.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.migrations: ~10 rows (aproximadamente)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(31, '2024_04_02_115834_create_solicituds_table', 1),
	(57, '2014_10_12_000000_create_users_table', 2),
	(58, '2014_10_12_100000_create_password_resets_table', 2),
	(59, '2019_08_19_000000_create_failed_jobs_table', 2),
	(60, '2019_12_14_000001_create_personal_access_tokens_table', 2),
	(61, '2024_03_28_191703_create_solicitud_table', 2),
	(62, '2024_04_02_115627_create_materias_table', 2),
	(63, '2024_04_02_115653_create_ambientes_table', 2),
	(64, '2024_04_02_115730_create_horarios_table', 2),
	(65, '2024_04_02_115755_create_docentes_table', 2),
	(66, '2024_04_02_115932_create_notificacions_table', 3),
	(67, '2024_04_14_030344_create_relacion__d_a_h_m_s_table', 4),
	(68, '2024_04_17_060916_create_razons_table', 5);

-- Volcando estructura para tabla reservas_tis.notificacion
CREATE TABLE IF NOT EXISTS `notificacion` (
  `ID_NOTIFICACION` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CUERPO` json NOT NULL,
  `ID_DOCENTE` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_NOTIFICACION`),
  KEY `notificacion_id_docente_foreign` (`ID_DOCENTE`),
  CONSTRAINT `notificacion_id_docente_foreign` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docente` (`ID_DOCENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.notificacion: ~0 rows (aproximadamente)
DELETE FROM `notificacion`;

-- Volcando estructura para tabla reservas_tis.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;

-- Volcando estructura para tabla reservas_tis.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.personal_access_tokens: ~0 rows (aproximadamente)
DELETE FROM `personal_access_tokens`;

-- Volcando estructura para tabla reservas_tis.razon
CREATE TABLE IF NOT EXISTS `razon` (
  `ID_RAZON` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RAZONES` json NOT NULL,
  `ID_DOCENTE` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` bigint unsigned NOT NULL,
  `FECHAHORA_CANCEL` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_RAZON`),
  KEY `razon_id_docente_foreign` (`ID_DOCENTE`),
  KEY `razon_id_foreign` (`id`),
  CONSTRAINT `razon_id_docente_foreign` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docente` (`ID_DOCENTE`),
  CONSTRAINT `razon_id_foreign` FOREIGN KEY (`id`) REFERENCES `solicitudes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.razon: ~0 rows (aproximadamente)
DELETE FROM `razon`;

-- Volcando estructura para tabla reservas_tis.razones
CREATE TABLE IF NOT EXISTS `razones` (
  `id_razones` int NOT NULL,
  `razon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.razones: ~2 rows (aproximadamente)
DELETE FROM `razones`;
INSERT INTO `razones` (`id_razones`, `razon`) VALUES
	(1, 'Esta no es una razon'),
	(3, 'Esta es una razon prueba');

-- Volcando estructura para tabla reservas_tis.relacion_dahm
CREATE TABLE IF NOT EXISTS `relacion_dahm` (
  `ID_RELACION` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_DOCENTE` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_AMBIENTE` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_HORARIO` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_MATERIA` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_RELACION`),
  KEY `relacion_dahm_id_docente_foreign` (`ID_DOCENTE`),
  KEY `relacion_dahm_id_ambiente_foreign` (`ID_AMBIENTE`),
  KEY `relacion_dahm_id_horario_foreign` (`ID_HORARIO`),
  KEY `relacion_dahm_id_materia_foreign` (`ID_MATERIA`),
  CONSTRAINT `relacion_dahm_ibfk_1` FOREIGN KEY (`ID_AMBIENTE`) REFERENCES `ambiente` (`ID_AMBIENTE`),
  CONSTRAINT `relacion_dahm_ibfk_2` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docente` (`ID_DOCENTE`),
  CONSTRAINT `relacion_dahm_ibfk_3` FOREIGN KEY (`ID_HORARIO`) REFERENCES `horario` (`ID_HORARIO`),
  CONSTRAINT `relacion_dahm_ibfk_4` FOREIGN KEY (`ID_MATERIA`) REFERENCES `materia` (`ID_MATERIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.relacion_dahm: ~47 rows (aproximadamente)
DELETE FROM `relacion_dahm`;
INSERT INTO `relacion_dahm` (`ID_RELACION`, `ID_DOCENTE`, `ID_AMBIENTE`, `ID_HORARIO`, `ID_MATERIA`, `created_at`, `updated_at`) VALUES
	('07eb5199-d423-4182-a898-18f7ee65534a', 'bfef68a6-c6e5-4798-ab26-c639bd29bb29', 'a70b77a8-dd33-4b57-86bc-b77bf5eddc41', 'fb39528b-879b-4e74-8ea0-cfd07033de13', 2006018, NULL, NULL),
	('12bb5178-553f-4490-9d36-db40403fff4b', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '95c4f2bf-b3bb-435f-bb1a-cece1d21ecf9', '6036ab5a-3c82-43b3-b3be-4b6e29a4ecce', 2006018, NULL, NULL),
	('18f5f1f1-ae2c-4745-b896-fc4ba1dceefa', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '136eedd3-f082-42c0-aacd-0063d5f3562f', '3b247498-3c6c-49ee-be37-14b1e236da0f', 2008080, NULL, NULL),
	('1a686a34-400a-4d90-854a-b712a3f562fc', '039c16c5-4de9-48d6-8238-f24e657c5eb6', 'c94b2136-c5eb-4225-9f9f-f1287a91289d', 'a1939f73-3755-42d4-8c5d-fcb260f0d003', 2010008, NULL, NULL),
	('2305af5c-79ad-41de-a75a-5d646ec8c4c7', 'c7460556-b09c-4b10-8460-05e6183e4e42', '2ba22ebd-98b8-453d-83b0-2932719e2cb9', 'a9bd9995-3794-4ba9-b7f9-7140099da9d1', 2006027, NULL, NULL),
	('2a75c585-9eac-41c5-bcba-3cb8897079ee', 'bafdb61e-b676-40b1-a09d-eb3e9c1a1d19', '58ee914d-2c7e-4b15-99f7-a79b6dcfa836', '3061c225-d17b-498b-a3dd-31518e6552d1', 2008077, NULL, NULL),
	('3676fa9e-bfc6-4b58-88bd-737ef2d38bb9', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '77b4c945-39af-4ad1-9109-1947f2bd1847', '0b68ffd5-99e9-4344-b99b-95378596059d', 2010008, NULL, NULL),
	('3909ccfa-eabc-41d4-a014-c319f38e24fd', '007ff40d-5105-47d1-9744-82a199a8436f', '4f0c9cf2-e60c-4c17-8339-89a9a3f7361b', 'd550444f-0909-4b64-ae35-3a15bf66a44e', 2002004, NULL, NULL),
	('3d1961ef-4197-4f1c-8258-af04ab8d2a52', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '1a732a32-4d03-44ef-b68f-415295d316d2', 'c58fb51b-0d4b-49c6-a20e-fdc63e460790', 2010008, NULL, NULL),
	('445422b1-0071-4684-9613-3c6304c77165', 'c34627f2-6dec-4853-a50c-614af0e17e66', 'd76626c3-8858-4ca2-8c07-ee87dd022997', 'b807bb63-08b3-47e0-aad0-64cb21784d7a', 2010008, NULL, NULL),
	('549dddc8-9b43-40ce-a735-0eb46cb559c4', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '136eedd3-f082-42c0-aacd-0063d5f3562f', '2e5b02c2-f68d-4331-a085-89cc41d6e793', 2008080, NULL, NULL),
	('55b6b04d-ba32-4188-92ca-60ef1b6eb1e3', '275e16e1-5fdf-41bb-9399-653941e76f71', '2b56ffbe-fbcb-4c9d-adc0-c13749585e98', 'e5ba9e69-a43f-454a-9267-6a877fec907b', 2008054, NULL, NULL),
	('583154f9-0341-4064-afe1-651598c7b15b', '007ff40d-5105-47d1-9744-82a199a8436f', '0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'b837a451-f557-4fa6-8bd1-50544891ec2e', 2002004, NULL, NULL),
	('58b86cf2-16a3-491b-850d-5fab553bb9d9', 'bfef68a6-c6e5-4798-ab26-c639bd29bb29', '58ee914d-2c7e-4b15-99f7-a79b6dcfa836', 'bba89453-393c-4a9e-acea-c5a80e8a675d', 2008077, NULL, NULL),
	('5c88b215-80ab-4b3e-8d90-f8fbcc89133b', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', '668a058c-ad61-48d2-a189-7215ebcab256', '44235137-514c-49da-994d-1f86a837a472', 2008053, NULL, NULL),
	('5ee5311b-dccc-4bfd-8b74-7d0c33c652b1', '007ff40d-5105-47d1-9744-82a199a8436f', '4f0c9cf2-e60c-4c17-8339-89a9a3f7361b', 'eb2de201-7174-49fe-a5c7-8901a2b229f3', 2002004, NULL, NULL),
	('63997452-9b56-4418-bd31-242102ec3a40', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', '5d7d0044-0aab-44c5-9e51-a4e7ee7b4667', '694e6c52-c99b-4b0b-ba67-9c073d283c81', 2008053, NULL, NULL),
	('6fc2fa48-23bd-4d8c-9d70-67dcd60ddc71', '968acc82-30de-4bbf-8b40-9be8d5251468', '1a732a32-4d03-44ef-b68f-415295d316d2', 'efec1860-c03b-4f02-9644-a95146419f93', 2008055, NULL, NULL),
	('75eefc6e-a8a2-4be4-84a7-12558040fd7e', 'ab5d4702-a8ff-4884-ab4d-02db4e560e12', '136eedd3-f082-42c0-aacd-0063d5f3562f', '0aae2f87-f810-4c8a-9c61-56f71b046dc4', 2008075, NULL, NULL),
	('7f74cb5c-36ca-4072-8652-cee78a8f636f', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '2b56ffbe-fbcb-4c9d-adc0-c13749585e98', 'cc6ba429-7098-4902-af61-3cd22cfe6397', 2010008, NULL, NULL),
	('80bcf7c0-f5ba-425e-8ffa-9024d011afd1', '9e05d053-f73b-4800-a3c7-f61f38c1d388', '5fe66ff0-bb2a-4940-8bbb-57363a2478ba', '13bbbf56-13b7-474c-8b14-2849faf6ddab', 2004046, NULL, NULL),
	('80ee6112-516a-4ece-873c-d4f9a76ed1de', '275e16e1-5fdf-41bb-9399-653941e76f71', 'a099246b-9a37-4a88-b8a5-3cd917ca51ee', '842eb2ce-080e-4194-98e2-80a6c31e43a5', 2008054, NULL, NULL),
	('90b881a6-f506-4a14-9c74-c79bec74e0d5', '22daa7a1-81d4-49ce-ae01-44d10201b837', '28bda7e0-431a-4d59-bb24-6a91d31c32a8', '8632c8dd-298a-48fb-b955-5160a3694080', 2008054, NULL, NULL),
	('96a8574c-8ec5-45ab-8b96-ee3f60c2c5ce', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '136eedd3-f082-42c0-aacd-0063d5f3562f', '043c34e4-477f-4b01-a99f-fbb9f2e6ca14', 2008080, NULL, NULL),
	('9859168d-66ef-4310-a367-c326a22bdf27', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '4d609316-26c8-4eea-8712-4b10557b4812', '72b1d8b0-f1fd-4588-ab39-d7fa979de668', 2008070, NULL, NULL),
	('a101094d-e526-46b0-bcff-fa13012c3eab', '968acc82-30de-4bbf-8b40-9be8d5251468', 'a426ee14-886d-4b73-874a-86181341c512', 'a19acb72-b4bf-43c0-be50-35e1edfc7ed1', 2008055, NULL, NULL),
	('a11b7406-71e9-4503-b12e-3703e71c2500', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '4d609316-26c8-4eea-8712-4b10557b4812', 'b9c3da52-2c60-4902-9dae-275f9d007c41', 2008070, NULL, NULL),
	('ad639607-c463-436d-9d26-d2cd1da0f2b8', 'ab5d4702-a8ff-4884-ab4d-02db4e560e12', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'd6cf8bb2-29d7-43ca-a519-73b8e9ac411b', 2008075, NULL, NULL),
	('ae85fc58-f018-4122-925f-12c5565ea453', '4f97364e-8534-48fd-981f-822aa93d94a4', '1a732a32-4d03-44ef-b68f-415295d316d2', 'b91bb79c-d88b-4473-907b-0f61d55725fb', 2008056, NULL, NULL),
	('b33ca758-9beb-4c0e-87c3-d2d84845cfd0', '1570c086-4356-433b-9ba1-9777c192a6db', '0f5b1b2e-012d-4725-ae34-1f0692d9d991', '8a6c2273-d406-450d-8c36-3d6c142027a0', 2004046, NULL, NULL),
	('b9df5330-1911-4442-9a5c-4fda58eae767', 'c7460556-b09c-4b10-8460-05e6183e4e42', '5d7d0044-0aab-44c5-9e51-a4e7ee7b4667', 'ad813392-430f-49d4-a8c2-2412a02aadcb', 2006027, NULL, NULL),
	('bd842207-e2c3-4a8a-bc01-1884c952dab2', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '004e1a3f-bffa-432f-bd25-d908f1d6a644', 2008214, NULL, NULL),
	('c20814ce-0651-4ee0-a23e-771113672812', 'a9bc1344-1f8f-48a9-b37a-e9e4ac141e87', '58ee914d-2c7e-4b15-99f7-a79b6dcfa836', '645a1e1e-e4fb-49e4-bc08-48f4cd96cdf4', 2008077, NULL, NULL),
	('c2c3ca32-8c21-41aa-ba94-e18bc5c57f59', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', 'ba8d666e-601d-46bf-bbe4-88fa9b9e2623', '4d1d8511-ce79-44a2-9da3-f05f8a0a768e', 2008053, NULL, NULL),
	('c95b1129-e5d1-476e-acad-f01216255542', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '66fa9666-914d-4419-aa70-c0bd7d69518a', 2008214, NULL, NULL),
	('cc60c9b4-efc7-4822-b179-aa7ff75d74ae', 'c7460556-b09c-4b10-8460-05e6183e4e42', '77b4c945-39af-4ad1-9109-1947f2bd1847', '0b7d8d61-6f00-466c-b519-ee1f2eeabfd6', 2006027, NULL, NULL),
	('d2bdb524-491b-425c-9a50-1344ee7f5d2f', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '136eedd3-f082-42c0-aacd-0063d5f3562f', '684352eb-bf39-46fc-91ca-c2e0b03bc377', 2008070, NULL, NULL),
	('d71d6b30-5572-4514-93af-f3dceb67d168', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', 'c694c7e4-9f03-4857-b282-7922962b4038', '6a327ef2-6143-4134-887e-66bbe82cd24a', 2006018, NULL, NULL),
	('d772f89a-ea90-4275-8bb6-bf3fb6e78a18', '4f97364e-8534-48fd-981f-822aa93d94a4', '0f5b1b2e-012d-4725-ae34-1f0692d9d991', '8a21ed4f-25b9-4b82-b5e1-baef707b6570', 2008056, NULL, NULL),
	('d84106d3-3686-4df5-997d-5313b09b6078', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '136eedd3-f082-42c0-aacd-0063d5f3562f', '8b7a3821-79b0-43c3-a74d-36771f4797d5', 2008081, NULL, NULL),
	('dcf89a59-9bdb-4bb5-a0bb-9e0a963dc85e', '007ff40d-5105-47d1-9744-82a199a8436f', '0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'eaf8bd6c-7625-45a6-97be-a7090c44b2dc', 2002004, NULL, NULL),
	('de4e1581-2e50-4705-88af-f62525de337b', '2e196af2-f995-4628-849c-81e83596bb3a', '28bda7e0-431a-4d59-bb24-6a91d31c32a8', 'c32508d8-66f4-4b84-ab99-f10c27a66031', 2004046, NULL, NULL),
	('e3a49d60-f3ef-46c7-bee7-7b3eac8028b9', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', 'a186dee8-926a-4e19-b564-41df44e83233', 'c829752f-3944-4884-8c1c-033687b4d247', 2008081, NULL, NULL),
	('e64ab34a-6853-43d8-be08-427e4ee401b5', '968acc82-30de-4bbf-8b40-9be8d5251468', '77b4c945-39af-4ad1-9109-1947f2bd1847', '38b3ef70-7ce0-42e2-94af-3e1375c8a081', 2008055, NULL, NULL),
	('e7daaa9e-d357-4888-aabe-c4e3bb9ae1ea', 'ab5d4702-a8ff-4884-ab4d-02db4e560e12', '4d609316-26c8-4eea-8712-4b10557b4812', '24b6950a-917c-40a9-8b32-a2d23e757fad', 2008075, NULL, NULL),
	('e97f678b-0792-4664-b058-d1c58f6aad84', 'ea6466ef-d138-41bb-98cf-5c3660b76f1f', '1cc57a33-84ea-492c-87e5-f6a79b302e03', '03b0afd4-e6ef-4379-b4d5-1fa10927707e', 2010008, NULL, NULL),
	('eccbf3e1-5667-4ea3-8dcc-e8bfb67a4852', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', 'd5dfd6a7-ea25-4299-a52c-481bf133c7eb', 'b83e7df0-ab94-42c5-b4d8-02b3716da042', 2006018, NULL, NULL);

-- Volcando estructura para tabla reservas_tis.reserva
CREATE TABLE IF NOT EXISTS `reserva` (
  `ID_RESERVA` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_SOLICITUD` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FECHAHORA` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.reserva: ~0 rows (aproximadamente)
DELETE FROM `reserva`;

-- Volcando estructura para tabla reservas_tis.solicitudes
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grupo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_estudiantes` int NOT NULL,
  `motivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `horario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ID_DOCENTE` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hInicio` time DEFAULT NULL,
  `hFin` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.solicitudes: ~28 rows (aproximadamente)
DELETE FROM `solicitudes`;
INSERT INTO `solicitudes` (`id`, `nombre`, `nombre1`, `nombre2`, `nombre3`, `nombre4`, `nombre5`, `materia`, `grupo`, `cantidad_estudiantes`, `motivo`, `modo`, `razon`, `aula`, `fecha`, `horario`, `estado`, `created_at`, `updated_at`, `ID_DOCENTE`, `hInicio`, `hFin`) VALUES
	(1, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2', 12, 'Examen Mesa', 'Urgente', NULL, '691A', '2024-05-01', '15:45 PM - 16:15 PM', 'Cancelado', '2024-03-30 13:00:31', '2024-05-01 14:11:27', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '11:15:00', '12:45:51'),
	(2, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '1', 2, 'Examen Parcial', 'Urgente', 'Porque si', '691A', '2024-05-16', '15:45 PM - 16:15 PM', 'cancelado', '2024-03-30 13:02:04', '2024-05-07 06:00:24', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(3, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '2', 2, 'Grado', 'Normal', NULL, '691A', '2024-05-10', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-30 13:04:58', '2024-03-30 13:04:58', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(4, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '2', 2, '2', 'Normal', NULL, '691A', '2024-05-16', '15:45 PM - 16:15 PM', 'Cancelado', '2024-03-30 13:05:51', '2024-03-31 14:15:30', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(5, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'PROBABILIDAD Y ESTADISTICA I', '2', 2, '3', 'Normal', NULL, '691A', '2024-05-17', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-30 13:06:14', '2024-04-30 13:06:14', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(6, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'GEOMETRIA', '2,3,4', 2, '3', 'urgente', NULL, '691A', '2024-05-18', '15:45 PM - 16:15 PM', 'Reservado', '2024-03-30 13:10:12', '2024-05-02 13:10:12', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(7, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'GEOMETRIA', '2', 2, '1', 'Normal', NULL, '691A', '2024-05-20', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-30 13:18:54', '2024-03-30 13:18:54', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(8, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'GEOMETRIA', '2', 2, '4', 'Urgente', NULL, '691A', '2024-05-21', '15:45 PM - 16:15 PM', 'Cancelado', '2024-03-30 13:20:06', '2024-03-31 14:17:19', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(9, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2', 2, '3', 'Urgente', NULL, '691A', '2024-05-22', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-30 13:22:11', '2024-06-01 13:22:11', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(10, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2,4,5', 12, '2', 'Urgente', 'Porque es urgente', '691A', '2024-02-24', '15:45 PM - 16:15 PM', 'Cancelado', '2024-03-31 03:10:04', '2024-05-31 14:15:52', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51'),
	(11, 'Modo', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2,3', 12, '3', 'Normal', NULL, '691B', '2024-02-16', '16:30 PM - 17:00 PM', 'Solicitando', '2024-03-31 06:47:12', '2024-03-31 06:47:12', NULL, NULL, NULL),
	(12, 'Modo', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2,3', 12, '3', 'Urgente', NULL, '691B', '2024-02-16', '16:30 PM - 17:00 PM', 'Reservado', '2024-03-31 06:47:43', '2024-03-31 06:47:43', NULL, NULL, NULL),
	(13, 'asdasd', NULL, NULL, NULL, NULL, NULL, '1', '2', 2, '3', 'Normal', NULL, '691A', '2024-02-16', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-31 06:48:46', '2024-03-31 06:48:46', NULL, NULL, NULL),
	(14, 'asdasd', NULL, NULL, NULL, NULL, NULL, '1', '2', 3, '3', 'Urgente', NULL, '691B', '2024-02-16', '16:30 PM - 17:00 PM', 'Solicitando', '2024-03-31 06:52:02', '2024-03-31 06:52:02', NULL, NULL, NULL),
	(15, 'qweqwe', NULL, NULL, NULL, NULL, NULL, '1', '2', 4, '4', 'Normal', NULL, '691A', '2024-02-16', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-31 06:53:18', '2024-03-31 06:53:18', NULL, NULL, NULL),
	(16, 'qweqwe', NULL, NULL, NULL, NULL, NULL, '1', '2', 4, '4', 'Normal', NULL, '691A', '2024-02-16', '15:45 PM - 16:15 PM', 'Reservado', '2024-03-31 06:53:25', '2024-03-31 06:53:25', NULL, NULL, NULL),
	(17, 'Modo resquest', NULL, NULL, NULL, NULL, NULL, '2', '2', 4, '4', 'Urgente', NULL, '691A', '2024-02-16', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-31 06:56:28', '2024-03-31 06:56:28', NULL, NULL, NULL),
	(18, 'asda123123', NULL, NULL, NULL, NULL, NULL, '2', '2', 2, '3', 'Normal', NULL, '691A', '2024-02-16', '15:45 PM - 16:15 PM', 'Cancelalo', '2024-03-31 06:58:28', '2024-03-31 06:58:28', NULL, NULL, NULL),
	(19, 'Test modo', NULL, NULL, NULL, NULL, NULL, '3', '2', 2, '1', 'Normal', NULL, '691A', '2024-02-16', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-31 07:01:12', '2024-03-31 07:01:12', NULL, NULL, NULL),
	(20, 'asdasd', NULL, NULL, NULL, NULL, NULL, '1', '2', 2, '2', 'Normal', NULL, '691A', '2024-02-16', '15:45 PM - 16:15 PM', 'Solicitando', '2024-03-31 07:04:22', '2024-03-31 07:04:22', NULL, NULL, NULL),
	(21, 'hola22222222222222', NULL, NULL, NULL, NULL, NULL, '1', '2', 2, '2', 'Normal', NULL, '691B', '2024-02-16', '16:30 PM - 17:00 PM', 'Reservado', '2024-03-31 07:09:55', '2024-03-31 07:09:55', NULL, NULL, NULL),
	(22, 'test6555555555', NULL, NULL, NULL, NULL, NULL, '2', '2', 2, '3', 'Normal', NULL, '691B', '2024-02-16', '16:30 PM - 17:00 PM', 'Reservado', '2024-03-31 07:18:14', '2024-03-31 07:18:14', NULL, NULL, NULL),
	(23, 'Giss', NULL, NULL, NULL, NULL, NULL, '3', '2,3,5,6', 23, '1', 'Normal', NULL, '691B', '2024-02-19', '16:30 PM - 17:00 PM', NULL, '2024-03-31 08:24:13', '2024-03-31 08:24:13', NULL, NULL, NULL),
	(24, 'Hola Domingo', NULL, NULL, NULL, NULL, NULL, 'Introducción a la programación', '33', 3333, 'Examen de mesa', 'Normal', NULL, '61B', '2024-05-17', '16:30 PM - 17:00 PM', 'Solicitando', '2024-05-06 05:12:45', '2024-05-06 05:12:45', NULL, NULL, NULL),
	(25, 'Hola Domingo', NULL, NULL, NULL, NULL, NULL, 'Introducción a la programación', '33', 3333, 'Examen parcial', 'Normal', NULL, '61B', '2024-05-17', '16:30 PM - 17:00 PM', 'Solicitando', '2024-05-06 05:14:34', '2024-05-06 05:14:34', NULL, NULL, NULL),
	(26, 'test', NULL, NULL, NULL, NULL, NULL, 'Introducción a la programación', '33', 3, 'Examen 2da instancia', 'Normal', NULL, '691B', '2024-05-17', '16:30 PM - 17:00 PM', 'Solicitando', '2024-05-06 05:24:19', '2024-05-06 05:24:19', NULL, NULL, NULL),
	(27, 'asdasd', NULL, NULL, NULL, NULL, NULL, 'Física', '2234', 234, 'Examen 2da instancia', 'Normal', NULL, '61B', '2024-05-17', '16:30 PM - 17:00 PM', 'Solicitando', '2024-05-06 05:37:38', '2024-05-06 05:37:38', NULL, NULL, NULL),
	(28, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'GEOMETRIA', '33', 12, 'Examen final', 'Normal', NULL, '691B', '2024-05-17', '16:30 PM - 17:00 PM', 'Solicitando', '2024-05-06 06:10:10', '2024-05-06 06:10:10', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', NULL, NULL);

-- Volcando estructura para tabla reservas_tis.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.users: ~0 rows (aproximadamente)
DELETE FROM `users`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
