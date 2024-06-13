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

-- Volcando datos para la tabla reservas_tis.ambiente: ~81 rows (aproximadamente)
DELETE FROM `ambiente`;
INSERT INTO `ambiente` (`ID_AMBIENTE`, `TIPO`, `NOMBRE`, `REFERENCIAS`, `CAPACIDAD`, `DATA`, `ESTADO`, `created_at`, `updated_at`) VALUES
	('05ea44be-a8bf-43c0-874f-2c7b1e6449c3', 'Auditorio', 'Auditorio de aulas', '"[\\"Edificio de aulas\\",\\"Area verde\\"]"', 300, 'SI', 'HABILITADO', '2024-05-15 18:34:10', '2024-05-15 18:34:10'),
	('0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'Aula comun', '690A', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:00', '2024-05-15 16:38:00'),
	('0f5b1b2e-012d-4725-ae34-1f0692d9d991', 'Aula comun', '622', '["Centro de estudiantes Electromecanica", "Fotocopiadora Informatica"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('13022e50-5443-4e51-951a-310e5fdba3b7', 'Auditorio', 'Auditorio de aulas', '"[\\"Edificio de aulas\\",\\"Area verde\\"]"', 300, 'NO', 'HABILITADO', '2024-05-15 18:32:04', '2024-05-15 18:32:04'),
	('136eedd3-f082-42c0-aacd-0063d5f3562f', 'Aula comun', '690MAT', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'Aula comun', '691A', '"[\\"Edificio de aulas\\"]"', 150, 'SI', 'HABILITADO', '2024-05-28 16:32:59', '2024-05-28 16:32:59'),
	('16486a42-ae93-4523-95df-453fd25ceb85', 'Aula comun', '981L9', '"[\\"Edificio de laboratorios\\",\\"Aula 981L2\\"]"', 25, 'NO', 'HABILITADO', '2024-05-15 18:39:32', '2024-05-15 18:39:32'),
	('1a732a32-4d03-44ef-b68f-415295d316d2', 'Aula comun', '691C', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('1ad8f97c-e8d8-4796-96ef-919f60942b25', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:00', '2024-05-15 16:38:00'),
	('1bed0bb7-818c-421c-906e-41e0c9202049', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:02', '2024-05-15 16:38:02'),
	('1cc57a33-84ea-492c-87e5-f6a79b302e03', 'Aula comun', '693B', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('1d09e33d-18ff-4b8c-a0e6-e5af0804dfa0', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:01', '2024-05-15 16:38:01'),
	('1eea46c6-2f09-49f2-bead-f3efab2b0e65', 'Aula comun', '690MAT', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('20514c6f-28bd-4c19-892e-d988acdd0279', 'Auditorio', '604?', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:34', '2024-05-15 16:38:34'),
	('28bda7e0-431a-4d59-bb24-6a91d31c32a8', 'Aula comun', '652', '["Edificio central", "Cajas facultativas"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('2b56ffbe-fbcb-4c9d-adc0-c13749585e98', 'Aula comun', '625C', '["Biblioteca FCyT", "CAE"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('2ba22ebd-98b8-453d-83b0-2932719e2cb9', 'Aula comun', '692E', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('3e46a83f-bea2-49c9-a96f-5ced8bba1eb8', 'Auditorio', '604?', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:36', '2024-05-15 16:38:36'),
	('3ea19eb9-2ae4-4579-8771-23371fc7f35c', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:03', '2024-05-15 16:38:03'),
	('3ec0ce4b-537b-4924-8ea9-8458581e9e92', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:37:56', '2024-05-15 16:37:56'),
	('4014abca-f410-40a4-b5a1-836c370456f0', 'Aula comun', '660', '"[\\"Trencito\\",\\"Area verde\\"]"', 100, 'NO', 'HABILITADO', '2024-05-25 01:33:30', '2024-05-25 01:33:30'),
	('46d882a1-f5f8-441a-aea1-c1c2bc4806d4', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:05', '2024-05-15 16:38:05'),
	('48b81aa7-58a8-498c-a279-53a66d5c55ae', 'Aula comun', '690D', '"[\\"Edificio nuevo\\",\\"Planta baja\\"]"', 150, 'NO', 'HABILITADO', '2024-05-04 08:47:20', '2024-05-04 08:47:20'),
	('49d7e8f2-f034-4b1b-a522-baebd41b2931', 'Aula comun', '690MAT', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('4d609316-26c8-4eea-8712-4b10557b4812', 'Aula comun', '690E', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('4da4b5c4-c61e-454e-84ab-23f2533bb085', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:03', '2024-05-15 16:38:03'),
	('4f0c9cf2-e60c-4c17-8339-89a9a3f7361b', 'Aula comun', '608A', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('4fc37e0b-fbd6-42ec-98dd-0de200d7a4b1', 'Aula comun', '690MAT', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('54d00f85-6e02-4fdc-8eb0-c0c5c176c47e', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:02', '2024-05-15 16:38:02'),
	('58ee914d-2c7e-4b15-99f7-a79b6dcfa836', 'Aula comun', '681A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('5d7d0044-0aab-44c5-9e51-a4e7ee7b4667', 'Aula comun', '617', '["Centro de estudiantes Fisica", "Laboratorios de Fisica"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('5fe66ff0-bb2a-4940-8bbb-57363a2478ba', 'Aula comun', '692G', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('668a058c-ad61-48d2-a189-7215ebcab256', 'Aula comun', '642', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('6e5e3c20-8d52-4c7a-95a6-d5f4e38c1afd', 'Aula comun', '690E', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('72e1e337-30d5-4b49-8a0b-0cc0d3993c90', 'Aula comun', '691C', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('77b4c945-39af-4ad1-9109-1947f2bd1847', 'Aula comun', '692A', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('7b3a1bae-2462-44fa-8a2a-2658364f1de2', 'Aula comun', 'CAE', '["Biblioteca FCyT", "Segundo piso Biblioteca FCyT", "Parqueo docentes"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('7fbdd864-47f1-4eae-b9dd-87846aadd5f4', 'Aula comun', '692A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('81594cdc-f296-4260-a5cc-ed1d79e9e134', 'Auditorio', '604?', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:36', '2024-05-15 16:38:36'),
	('844432b5-93a2-4763-b628-124429292444', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:04', '2024-05-15 16:38:04'),
	('846d1b36-bc53-4137-9b18-f664b9988d4e', 'Aula comun', '652', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('892f0cb5-7fdc-43da-b1ef-7ea8ea33718b', 'Aula comun', '681A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('8a8d8b1e-cf7d-4f6a-8ed5-b48fda149ffb', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:17', '2024-05-15 16:37:17'),
	('8b00a504-eaff-4531-8767-35dca91eb644', 'Aula comun', '661', '"[\\"Edificio de aulas\\"]"', 150, 'SI', 'HABILITADO', '2024-05-15 00:46:46', '2024-05-15 00:46:46'),
	('8b2c60a7-b88b-4825-b4a5-1e43924f85c7', 'Auditorio', 'Auditorio de Sistemas Informatica', '"[\\"Laboratorios de computo\\",\\"Laboratorio de redes\\",\\"Administracion del departamento de Informatica Sistemas\\",\\"Estacionamiento\\"]"', 20, 'SI', 'HABILITADO', '2024-05-25 01:20:01', '2024-05-25 01:20:01'),
	('8b8e4680-c970-4aea-8c0c-b71e3d45f237', 'Aula comun', '691C', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('8e8073de-d7bb-4110-8fdb-e0e15b4abbab', 'Aula comun', '693C', '"[\\"Edificio de aulas\\",\\"Area verder\\"]"', 150, 'SI', 'HABILITADO', '2024-05-24 22:59:37', '2024-05-24 22:59:37'),
	('8f6d8204-5054-4b8b-a68c-a3d4c79e412c', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:22', '2024-05-15 16:37:22'),
	('91c6fcbc-a9f3-4694-af91-31975bf2761e', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:05', '2024-05-15 16:38:05'),
	('9223467c-7564-44e6-8e42-5054da002985', 'Aula comun', '622', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('94b390f5-18ee-434c-9c27-dc00d75e7f09', 'Auditorio', '604?', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:37', '2024-05-15 16:38:37'),
	('95c4f2bf-b3bb-435f-bb1a-cece1d21ecf9', 'Aula comun', '692B', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('95fae875-e318-4b97-aabf-9d549c357159', 'Aula comun', '681A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('97107aec-0e6e-4002-8aff-b3afbd6ddc97', 'Aula comun', '690C', '"[\\"Edificio de aulas\\",\\"Edificio de laboratorios\\",\\"Area verde\\",\\"Area de docentes\\"]"', 150, 'NO', 'HABILITADO', '2024-05-15 00:56:35', '2024-05-15 00:56:35'),
	('98db8384-dcad-4583-ba35-5151a587b775', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:11', '2024-05-15 16:37:11'),
	('99167a52-8ebe-4b25-99f9-c14db0c8232a', 'Aula comun', '690MAT', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('a099246b-9a37-4a88-b8a5-3cd917ca51ee', 'Aula comun', '691F', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('a186dee8-926a-4e19-b564-41df44e83233', 'Aula comun', '623', '["Centro de estudiantes Electromecanica", "Fotocopiadora Matematicas", "Areas verdes frente la puerta"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('a426ee14-886d-4b73-874a-86181341c512', 'Aula comun', '651', '["Edificio central", "Cajas facultativas"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('a70b77a8-dd33-4b57-86bc-b77bf5eddc41', 'Aula comun', '621', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('aa0b4d29-2dcf-4df2-91c4-4092075a63ec', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:01', '2024-05-15 16:38:01'),
	('ae3c573d-ae0c-49af-a34c-2c4179957975', 'Aula comun', '690A', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('b1ab67fe-a380-4384-8d51-bef8a2883bc2', 'Aula comun', 'CAE', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('b5a60904-33f5-4b9d-a707-537e9440e2b8', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:04', '2024-05-15 16:38:04'),
	('b8098afb-c2fa-48ce-a854-6341d0808901', 'Aula comun', '690MAT', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('b91b9688-bdc9-4cdb-8ee7-30b27dbd55b6', 'Aula comun', '690MAT', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('ba42b079-c7d6-4448-b21f-efaa161cd409', 'Aula comun', '608A', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('ba8d666e-601d-46bf-bbe4-88fa9b9e2623', 'Aula comun', '607', 'null', 0, 'NO', 'HABILITADO', NULL, NULL),
	('bb07e6df-df3e-412c-aa25-73097ca40987', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:14', '2024-05-15 16:37:14'),
	('bbc34b8f-bafb-43c1-b779-c49b58816872', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:23', '2024-05-15 16:37:23'),
	('bfed0f81-2a27-4a91-a5ca-2c0d60b72bfb', 'Auditorio', '604?', '"[\\"Edificio nuevo\\"]"', 100, 'SI', 'HABILITADO', '2024-05-15 16:38:35', '2024-05-15 16:38:35'),
	('c4b98beb-9fa9-43c0-997b-0263a67bf630', 'Aula comun', '625C', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('c5ce26c6-7e12-4838-9688-4beb603b188d', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:18', '2024-05-15 16:37:18'),
	('c694c7e4-9f03-4857-b282-7922962b4038', 'Aula comun', '693A', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('c94b2136-c5eb-4225-9f9f-f1287a91289d', 'Aula comun', '692H', '["Edificio nuevo", "Area verde frente la puerta", "Edificio de laboratorios"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('c9c828ac-6062-4523-8cc1-0a2f7d6c4419', 'Aula comun', '692A', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('d04a0912-27c8-4dcd-aa1c-827701e7cb97', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:18', '2024-05-15 16:37:18'),
	('d5dfd6a7-ea25-4299-a52c-481bf133c7eb', 'Aula comun', '624', '["Centro de estudiantes Electronica", "Fotocopiadora Tecno"]', 0, 'NO', 'HABILITADO', NULL, NULL),
	('d76626c3-8858-4ca2-8c07-ee87dd022997', 'Aula comun', 'INFLAB', '["Laboratorios de informatica y sistemas", "Edificio MEMI", "Parqueo docentes"]', 0, 'SI', 'HABILITADO', NULL, NULL),
	('dd5dc074-315f-4e12-bb63-99813856cd01', 'Auditorio', 'Auditorio FCYT', '"[\\"Biblioteca FCyT\\",\\"Area verde frente la puerta\\"]"', 250, 'SI', 'HABILITADO', '2024-04-16 17:00:28', '2024-04-16 17:00:28'),
	('dea3e87e-5b17-4cc2-9ed3-c6208e972e29', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:47', '2024-05-15 16:37:47'),
	('df7da622-3321-460f-a813-b2382cfd14e6', 'Auditorio', 'Auditorio  de Ingerieria Civil', '"[\\"\\"]"', 60, 'NO', 'HABILITADO', '2024-05-15 05:18:58', '2024-05-15 05:18:58'),
	('e45c03dd-abb3-4252-a029-b92fda3df07c', 'Aula comun', '617', 'null', 0, 'SI', 'HABILITADO', NULL, NULL),
	('e6e71607-a1e1-4316-8d02-a5005c8ddf09', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:19', '2024-05-15 16:37:19'),
	('e7f2399f-a34d-44f3-ba39-199368a85d31', 'Aula comun', '665', '"[\\"Edificio de aulas\\",\\"Centro de civil\\"]"', 100, 'NO', 'HABILITADO', '2024-05-15 05:37:18', '2024-05-15 05:37:18'),
	('ed9c1e78-ab2d-4192-833a-930896290c06', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:17', '2024-05-15 16:37:17'),
	('f2433f5a-3285-4ffb-b9b2-c890141fa144', 'Aula comun', '691B', '"[\\"Edificio de aulas\\",\\"Area verde\\"]"', 150, 'NO', 'HABILITADO', '2024-05-04 08:42:46', '2024-05-04 08:42:46'),
	('f82530b9-9e02-4a7f-81be-0642303812db', 'Auditorio', 'Auditorio de MEMI', '"[\\"Laboratorios de computo\\",\\"Oficinas MEMI\\"]"', 25, 'SI', 'HABILITADO', '2024-05-25 01:30:47', '2024-05-25 01:30:47'),
	('f85bf540-718b-40f0-9b5c-e761b59daad4', 'Aula comun', '691B', '"[\\"Edificio de aulas\\",\\"Area verde\\"]"', 150, 'NO', 'HABILITADO', '2024-05-04 08:43:30', '2024-05-04 08:43:30'),
	('facbba7e-6bc8-4f07-966d-e8e4668faf35', 'Auditorio', '604', '"[\\"Edificio nuevo\\"]"', 200, 'SI', 'HABILITADO', '2024-05-15 16:37:05', '2024-05-15 16:37:05'),
	('fb7df519-919a-47fe-8151-712dc5777aaf', 'Aula comun', '690E', 'null', 0, 'NO', 'HABILITADO', NULL, NULL);

-- Volcando estructura para tabla reservas_tis.docente
CREATE TABLE IF NOT EXISTS `docente` (
  `ID_DOCENTE` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NOMBRE` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CELULAR` int NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_DOCENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.docente: ~16 rows (aproximadamente)
DELETE FROM `docente`;
INSERT INTO `docente` (`ID_DOCENTE`, `NOMBRE`, `CELULAR`, `EMAIL`, `created_at`, `updated_at`) VALUES
	('007ff40d-5105-47d1-9744-82a199a8436f', 'FERNANDEZ TERRAZAS ERIKA', 0, 'example@company.com', NULL, NULL),
	('039c16c5-4de9-48d6-8238-f24e657c5eb6', 'VARGAS COLQUE AIDEE', 0, 'example@company.com', NULL, NULL),
	('1570c086-4356-433b-9ba1-9777c192a6db', '. POR DESIGNAR', 0, 'example@company.com', NULL, NULL),
	('22daa7a1-81d4-49ce-ae01-44d10201b837', 'QUISPE CHOQUE VLADIMIR', 0, 'example@company.com', NULL, NULL),
	('275e16e1-5fdf-41bb-9399-653941e76f71', 'ZURITA ORELLANA RIMER MAURICIO', 0, 'example@company.com', NULL, NULL),
	('2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', 'SORUCO MAITA JOSE ANTONIO', 0, 'example@company.com', NULL, NULL),
	('354db6b6-be0f-4aca-a9ea-3c31e412c49d', 'TORRICO TROCHE MILKA MONICA', 0, 'example@company.com', NULL, NULL),
	('46f460de-2da8-4ce8-8ffe-5a646073e95a', 'RODRIGUEZ BILBAO ERIKA PATRICI', 0, 'example@company.com', NULL, NULL),
	('4a72b14b-9529-4aa9-83fa-ebb55a210e82', 'RELOS PACO SANTIAGO', 0, 'example@company.com', NULL, NULL),
	('4f97364e-8534-48fd-981f-822aa93d94a4', 'GONZALES CASTELLON CARLOS ESTE', 0, 'example@company.com', NULL, NULL),
	('7cf7f927-02c7-4442-a8dc-d045b4c612d7', 'CARRASCO CALVO ALVARO HERNANDO', 0, 'example@company.com', NULL, NULL),
	('968acc82-30de-4bbf-8b40-9be8d5251468', 'SALINAS PERICON WALTER OSCAR G', 0, 'example@company.com', NULL, NULL),
	('ab5d4702-a8ff-4884-ab4d-02db4e560e12', 'JUCHANI BAZUALDO DEMETRIO', 0, 'example@company.com', NULL, NULL),
	('c34627f2-6dec-4853-a50c-614af0e17e66', 'CUENCA VARGAS FERNANDO', 0, 'example@company.com', NULL, NULL),
	('c7460556-b09c-4b10-8460-05e6183e4e42', 'CHOQUE UNO FRANCISCO', 0, 'example@company.com', NULL, NULL),
	('ea6466ef-d138-41bb-98cf-5c3660b76f1f', 'AUXILIAR POR DESIGNAR .', 0, 'example@company.com', NULL, NULL);

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

-- Volcando datos para la tabla reservas_tis.horario: ~74 rows (aproximadamente)
DELETE FROM `horario`;
INSERT INTO `horario` (`ID_HORARIO`, `INICIO`, `FIN`, `DIA`, `created_at`, `updated_at`) VALUES
	('004e1a3f-bffa-432f-bd25-d908f1d6a644', '11:15:00', '12:45:00', 'MIERCOLES', NULL, '2024-06-05 17:27:10'),
	('03b0afd4-e6ef-4379-b4d5-1fa10927707e', '15:45:00', '17:15:00', 'MIERCOLES', NULL, NULL),
	('043c34e4-477f-4b01-a99f-fbb9f2e6ca14', '09:45:00', '11:15:00', 'SABADO', NULL, NULL),
	('09d5656e-9be0-4982-bdc9-03cd4252a557', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:26', '2024-06-05 17:27:10'),
	('0a95ed32-d6e9-42b5-a535-75653acf42e8', '09:45:00', '11:15:00', 'SABADO', '2024-05-25 01:55:40', '2024-06-04 15:37:32'),
	('0aae2f87-f810-4c8a-9c61-56f71b046dc4', '08:15:00', '09:45:00', 'JUEVES', NULL, '2024-06-04 17:06:49'),
	('0b68ffd5-99e9-4344-b99b-95378596059d', '18:45:00', '20:15:00', 'LUNES', NULL, '2024-06-04 15:37:32'),
	('0b7d8d61-6f00-466c-b519-ee1f2eeabfd6', '08:15:00', '09:45:00', 'MIERCOLES', NULL, NULL),
	('0cf2c16c-ae51-4c8e-b868-f34410826f0b', '12:45:00', '14:15:00', 'LUNES', '2024-04-16 15:56:33', '2024-04-16 15:56:33'),
	('0e337acb-58fe-4f7a-8ad3-46a5b7236bbe', '06:45:00', '08:15:00', 'LUNES', '2024-05-15 08:54:33', '2024-06-05 17:27:10'),
	('125957c7-e790-48ed-bb5e-b7f2a1f3ce44', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:27', '2024-06-05 17:27:10'),
	('13bbbf56-13b7-474c-8b14-2849faf6ddab', '08:15:00', '09:45:00', 'SABADO', NULL, NULL),
	('228bda51-fdce-44bd-b7ff-d9908dde224a', '20:00:00', '21:45:00', 'VIERNES', '2024-05-25 01:55:40', '2024-06-04 15:37:32'),
	('24b6950a-917c-40a9-8b32-a2d23e757fad', '15:45:00', '17:15:00', 'LUNES', NULL, '2024-06-04 17:06:49'),
	('2e5b02c2-f68d-4331-a085-89cc41d6e793', '18:45:00', '20:15:00', 'VIERNES', NULL, NULL),
	('3061c225-d17b-498b-a3dd-31518e6552d1', '14:15:00', '15:45:00', 'JUEVES', NULL, NULL),
	('30771df2-5c05-40f3-8ff7-0e194d90d915', '14:15:00', '15:45:00', 'LUNES', '2024-04-16 16:47:09', '2024-04-16 16:47:09'),
	('32d69a46-24f7-457e-8c6e-12b58c137d29', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:17', '2024-06-05 17:27:10'),
	('374b64ef-d1c1-4144-aae5-719fbffff254', '12:45:00', '14:15:00', 'LUNES', '2024-04-16 15:55:21', '2024-04-16 15:55:21'),
	('380643ac-afde-4254-8e0f-9d458b49b9ba', '11:15:00', '13:15:00', 'LUNES', '2024-05-25 01:58:24', '2024-05-25 01:58:24'),
	('3833bb3b-62d9-4dda-a485-5be29863a369', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:25', '2024-06-05 17:27:10'),
	('38b3ef70-7ce0-42e2-94af-3e1375c8a081', '17:15:00', '18:45:00', 'MARTES', NULL, NULL),
	('3a28468a-4408-4226-831b-5082efd1cf95', '10:45:00', '12:15:00', 'MIERCOLES', '2024-05-25 01:58:24', '2024-05-25 01:58:24'),
	('3a5a6049-b9e3-4f5b-868f-8227d7e122cb', '06:45:00', '08:15:00', 'MARTES', '2024-05-25 02:02:09', '2024-05-25 02:02:09'),
	('3b247498-3c6c-49ee-be37-14b1e236da0f', '18:45:00', '20:15:00', 'LUNES', NULL, NULL),
	('44235137-514c-49da-994d-1f86a837a472', '17:15:00', '18:45:00', 'LUNES', NULL, NULL),
	('45e5c60c-66da-4235-944b-90e8035f903d', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:13', '2024-06-05 17:27:10'),
	('4d1d8511-ce79-44a2-9da3-f05f8a0a768e', '14:15:00', '15:45:00', 'MIERCOLES', NULL, NULL),
	('4f94f667-8044-4687-bc95-e147302a4023', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:22', '2024-06-05 17:27:10'),
	('54a3c394-7a9d-463c-9188-c22a8653a3a3', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:29', '2024-06-05 17:27:10'),
	('6036ab5a-3c82-43b3-b3be-4b6e29a4ecce', '09:45:00', '11:15:00', 'MARTES', NULL, NULL),
	('631e7df5-3eff-4ba2-a122-e20ecdbe49b5', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:26', '2024-06-05 17:27:10'),
	('6365cf12-a823-4068-97e2-5fe397be1144', '08:15:00', '09:45:00', 'VIERNES', '2024-05-15 17:10:28', '2024-06-05 17:27:10'),
	('645a1e1e-e4fb-49e4-bc08-48f4cd96cdf4', '08:15:00', '09:45:00', 'LUNES', NULL, NULL),
	('64d6ebb7-dfec-48be-9a25-6179fb2d4a08', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:11:27', '2024-06-05 17:27:10'),
	('66fa9666-914d-4419-aa70-c0bd7d69518a', '11:15:00', '12:45:00', 'MARTES', NULL, '2024-06-05 17:27:10'),
	('684352eb-bf39-46fc-91ca-c2e0b03bc377', '11:15:00', '12:45:00', 'LUNES', NULL, NULL),
	('694e6c52-c99b-4b0b-ba67-9c073d283c81', '15:45:00', '17:15:00', 'MARTES', NULL, NULL),
	('6a327ef2-6143-4134-887e-66bbe82cd24a', '09:45:00', '11:15:00', 'VIERNES', NULL, NULL),
	('72b1d8b0-f1fd-4588-ab39-d7fa979de668', '15:45:00', '17:15:00', 'MIERCOLES', NULL, NULL),
	('7952448f-b07c-41b8-9ed5-70e3555597c8', '08:15:00', '09:45:00', 'VIERNES', '2024-05-25 01:47:14', '2024-06-05 17:27:10'),
	('842eb2ce-080e-4194-98e2-80a6c31e43a5', '18:45:00', '20:15:00', 'LUNES', NULL, '2024-06-05 17:15:01'),
	('8632c8dd-298a-48fb-b955-5160a3694080', '09:45:00', '11:15:00', 'LUNES', NULL, '2024-06-09 18:38:46'),
	('8a21ed4f-25b9-4b82-b5e1-baef707b6570', '09:45:00', '11:15:00', 'VIERNES', NULL, NULL),
	('8a6c2273-d406-450d-8c36-3d6c142027a0', '06:45:00', '08:15:00', 'JUEVES', NULL, NULL),
	('8b7a3821-79b0-43c3-a74d-36771f4797d5', '15:45:00', '17:15:00', 'JUEVES', NULL, NULL),
	('a1939f73-3755-42d4-8c5d-fcb260f0d003', '06:45:00', '08:15:00', 'JUEVES', NULL, '2024-06-04 15:37:32'),
	('a19acb72-b4bf-43c0-be50-35e1edfc7ed1', '18:45:00', '20:15:00', 'JUEVES', NULL, NULL),
	('a9bd9995-3794-4ba9-b7f9-7140099da9d1', '08:15:00', '09:45:00', 'VIERNES', NULL, NULL),
	('ab6744e2-8f49-4571-aaf4-a63b9d9d3759', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:28', '2024-06-05 17:27:10'),
	('ad813392-430f-49d4-a8c2-2412a02aadcb', '09:45:00', '11:15:00', 'MARTES', NULL, NULL),
	('b807bb63-08b3-47e0-aad0-64cb21784d7a', '08:15:00', '09:45:00', 'SABADO', NULL, NULL),
	('b837a451-f557-4fa6-8bd1-50544891ec2e', '08:15:00', '10:30:00', 'VIERNES', NULL, '2024-06-04 16:46:28'),
	('b83e7df0-ab94-42c5-b4d8-02b3716da042', '09:45:00', '11:15:00', 'LUNES', NULL, NULL),
	('b91bb79c-d88b-4473-907b-0f61d55725fb', '14:15:00', '15:45:00', 'MIERCOLES', NULL, NULL),
	('b9c3da52-2c60-4902-9dae-275f9d007c41', '08:15:00', '09:45:00', 'JUEVES', NULL, NULL),
	('bb2ca027-88aa-4e60-8caa-2ece1cbbe5a5', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:25', '2024-06-05 17:27:10'),
	('bba89453-393c-4a9e-acea-c5a80e8a675d', '09:45:00', '11:15:00', 'VIERNES', NULL, NULL),
	('c32508d8-66f4-4b84-ab99-f10c27a66031', '06:45:00', '08:15:00', 'VIERNES', NULL, NULL),
	('c58fb51b-0d4b-49c6-a20e-fdc63e460790', '18:45:00', '20:15:00', 'LUNES', NULL, '2024-06-04 15:37:32'),
	('c829752f-3944-4884-8c1c-033687b4d247', '09:45:00', '11:15:00', 'LUNES', NULL, NULL),
	('caa3230c-6f63-4954-886f-656475b9e599', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:11:15', '2024-06-05 17:27:10'),
	('cb165567-93f3-41fd-8c00-f560fd7d86ab', '11:15:00', '12:45:00', 'MIERCOLES', '2024-05-25 01:52:45', '2024-05-25 01:52:45'),
	('cc6ba429-7098-4902-af61-3cd22cfe6397', '12:45:00', '14:15:00', 'MARTES', NULL, '2024-06-04 15:37:32'),
	('cffbfb53-32e4-40d4-b11d-93854262c972', '08:15:00', '09:15:00', 'JUEVES', '2024-05-25 01:52:45', '2024-05-25 01:52:45'),
	('d550444f-0909-4b64-ae35-3a15bf66a44e', '12:00:00', '14:15:00', 'MIERCOLES', NULL, '2024-06-04 16:46:28'),
	('d6cf8bb2-29d7-43ca-a519-73b8e9ac411b', '15:45:00', '17:15:00', 'MIERCOLES', NULL, '2024-06-04 17:06:49'),
	('d900ecb9-9a49-48b6-9a10-dee9256f4599', '06:45:00', '08:15:00', 'LUNES', '2024-05-25 01:47:14', '2024-06-05 17:27:10'),
	('d98b7dae-c77e-4051-9382-43772fcad8c9', '06:45:00', '08:15:00', 'LUNES', '2024-05-15 08:57:46', '2024-06-05 17:27:10'),
	('e5ba9e69-a43f-454a-9267-6a877fec907b', '18:45:00', '20:15:00', 'MARTES', NULL, '2024-06-05 17:15:01'),
	('eaf8bd6c-7625-45a6-97be-a7090c44b2dc', '10:30:00', '12:00:00', 'MIERCOLES', NULL, '2024-06-04 16:46:28'),
	('eb2de201-7174-49fe-a5c7-8901a2b229f3', '12:00:00', '14:15:00', 'LUNES', NULL, '2024-06-04 16:46:28'),
	('efec1860-c03b-4f02-9644-a95146419f93', '17:15:00', '18:45:00', 'LUNES', NULL, NULL),
	('f38e3c4b-282b-4449-a696-8a157f86d099', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-25 02:02:09', '2024-05-25 02:02:09'),
	('f8871d14-f54d-4d94-b2c2-7ea40ee20f58', '08:15:00', '09:45:00', 'MIERCOLES', '2024-05-15 17:10:11', '2024-06-05 17:27:10'),
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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
	(68, '2024_04_17_060916_create_razons_table', 5),
	(69, '2024_04_15_003729_create_solicituds_table', 6),
	(70, '2024_04_15_003753_create_reservas_table', 7),
	(71, '2024_06_03_120841_create_relacion__d_m_s_table', 8);

-- Volcando estructura para tabla reservas_tis.notificacion
CREATE TABLE IF NOT EXISTS `notificacion` (
  `ID_NOTIFICACION` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CUERPO` json NOT NULL,
  `ID_DOCENTE` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_NOTIFICACION`),
  KEY `notificacion_id_docente_foreign` (`ID_DOCENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.notificacion: ~85 rows (aproximadamente)
DELETE FROM `notificacion`;
INSERT INTO `notificacion` (`ID_NOTIFICACION`, `CUERPO`, `ID_DOCENTE`, `created_at`, `updated_at`) VALUES
	('022cc67f-30fa-4089-bc50-dd7b169e5c0a', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:16:01', '2024-05-31 21:16:01'),
	('0fb8128f-3ae1-4ce4-b09f-a3f8e175f2a8', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:08:32', '2024-05-31 21:08:32'),
	('10018b61-0f31-4870-af14-e429490c4080', '{"FECHA": "17/05/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "622"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:26:02', '2024-06-11 17:26:02'),
	('126f7980-7d96-4989-b5f5-862f336b0b5b', '{"FECHA": "2024-06-05 09:45:00", "MATERIA": "FISICA I", "AMBIENTE": "690MAT"}', '22daa7a1-81d4-49ce-ae01-44d10201b837', '2024-06-05 16:27:01', '2024-06-05 16:27:01'),
	('141531ee-0f40-4238-aa0a-bbb1b8f73b37', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 22:51:18', '2024-05-31 22:51:18'),
	('16d0f0ff-4135-4ac7-b4a2-f0ecc5c82c47', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 00:14:41', '2024-06-01 00:14:41'),
	('1d123d85-cc8a-4d37-9c2a-1c86a8bce8fc', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 00:16:34', '2024-06-01 00:16:34'),
	('248bbb2e-0a4a-4859-868d-6d07a9e04fc7', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:02:56', '2024-05-31 23:02:56'),
	('24d266ec-5cfc-463c-9ec3-fc9c76a51980', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:03:57', '2024-06-01 01:03:57'),
	('25fbe66b-afbf-4cdc-ab22-22012f0168f7', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:51:00', '2024-05-31 23:51:00'),
	('29ed98b6-301e-4a35-930a-f1327e977ead', '{"FECHA": "27/05/2024", "MATERIA": "COMPUTACION I", "AMBIENTE": "690A"}', 'c34627f2-6dec-4853-a50c-614af0e17e66', '2024-06-11 17:41:13', '2024-06-11 17:41:13'),
	('2c9365df-08f8-4d60-9ef0-005838951abd', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:11:12', '2024-05-31 21:11:12'),
	('2e89cfd3-6f28-41eb-b811-8575ea9aa7c0', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 20:56:46', '2024-05-31 20:56:46'),
	('3134a1ee-691a-42ce-9181-d553abd930fd', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:12:08', '2024-05-31 23:12:08'),
	('3386e51c-5bc5-4c5d-b508-eb61b1b88923', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:03:34', '2024-05-31 21:03:34'),
	('3d79e4d1-62cf-4a58-b627-abee76153d29', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 20:59:55', '2024-05-31 20:59:55'),
	('4084235c-2c11-4abe-bd48-9d5dd0cbfa49', '{"FECHA": "29/05/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "691A"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:51:40', '2024-06-11 17:51:40'),
	('426c44f9-61b3-4493-b053-c4a7158b4411', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 20:54:11', '2024-05-31 20:54:11'),
	('4427b306-73ec-4e19-be22-235444fa2c44', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:52:21', '2024-05-31 23:52:21'),
	('4480d172-524f-4cd2-9718-7667d2633786', '{"FECHA": "2024-06-05 11:15:00", "MATERIA": "BIOLOGIA GENERAL", "AMBIENTE": "622"}', '007ff40d-5105-47d1-9744-82a199a8436f', '2024-06-05 17:06:55', '2024-06-05 17:06:55'),
	('4e0a4613-550e-49a7-8ff4-78d1d530f5ba', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:01:57', '2024-05-31 21:01:57'),
	('4e883394-3c49-4269-aece-a4889e009590', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:02:22', '2024-06-01 01:02:22'),
	('51aff0ba-cc6f-40ff-bf3b-995b2cde15f9', '"Cuerpo inicial"', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '2024-05-31 23:12:08', '2024-05-31 23:12:08'),
	('52dd913f-0d07-4259-9298-f2ae193b1f52', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 00:28:45', '2024-06-01 00:28:45'),
	('534c9764-4bd6-4c60-bb4e-474144c01950', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:35:22', '2024-05-31 23:35:22'),
	('556bc213-6fde-4db7-ba3c-18426ae00e46', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:13:42', '2024-05-31 21:13:42'),
	('5891562d-751b-430c-8abc-bc7c96d7926f', '{"FECHA": "19/06/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "691A"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:44:00', '2024-06-11 17:44:00'),
	('59986ef5-18cc-44a7-9af6-8b133513937c', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:31:12', '2024-05-31 23:31:12'),
	('5fca31cb-bc4d-46f8-a010-88d3dac2d6e3', '{"FECHA": "2024-06-05 11:15:00", "MATERIA": "BIOLOGIA GENERAL", "AMBIENTE": "622"}', '007ff40d-5105-47d1-9744-82a199a8436f', '2024-06-05 17:05:45', '2024-06-05 17:05:45'),
	('63c71a25-87c4-4226-8b23-d233d1710899', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 20:52:47', '2024-05-31 20:52:47'),
	('66d36e4a-0e6b-4ebd-8780-409c8373c851', '{"FECHA": "2024-06-05 09:45:00", "MATERIA": "FISICA I", "AMBIENTE": "690MAT"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-05 16:26:58', '2024-06-05 16:26:58'),
	('6778a159-90cb-4553-81c1-ebae0b399138', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:48:44', '2024-05-31 23:48:44'),
	('67aa5356-22a8-4e0c-a5e8-7d6ee8133524', '{"FECHA": "17/05/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "622"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:34:23', '2024-06-11 17:34:23'),
	('690b1aea-dfb9-4b45-a0a0-f334580c1ff7', '"Cuerpo inicial"', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '2024-05-31 23:07:07', '2024-05-31 23:07:07'),
	('69146361-acf2-461f-a46b-283d13f79d21', '{"FECHA": "17/05/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "622"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:00:00', '2024-06-11 17:00:00'),
	('69d29d09-07fa-4b90-87e7-2d5790842af4', '{"FECHA": "2024-06-20 11:15", "MATERIA": "FISICA BASICA I", "AMBIENTE": "691B"}', '275e16e1-5fdf-41bb-9399-653941e76f71', '2024-06-11 05:03:27', '2024-06-11 05:03:27'),
	('6a971d52-786a-45ce-b909-42ac33da3c84', '{"FECHA": "17/05/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "622"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:00:47', '2024-06-11 17:00:47'),
	('6b734f76-b49d-4f9e-8321-235dd63d98f8', '"Cuerpo inicial"', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '2024-05-31 23:48:44', '2024-05-31 23:48:44'),
	('6cf4764a-f978-4697-8037-2dd81dc25c43', '{"FECHA": "13/06/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "690MAT"}', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '2024-06-11 17:28:56', '2024-06-11 17:28:56'),
	('6f1963a1-0632-4525-a252-996f667abc90', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:17:29', '2024-05-31 21:17:29'),
	('770590cf-0c25-40ab-93ea-fa32e5379b52', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:42:33', '2024-05-31 23:42:33'),
	('791b0b08-cc78-49a2-bf03-e1930f73cd1c', '{"FECHA": "2024-06-19 11:15", "MATERIA": "FISICA BASICA I", "AMBIENTE": "Auditorio de Sistemas Informatica"}', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '2024-06-11 16:12:52', '2024-06-11 16:12:52'),
	('7f5345b3-e370-43e5-82cb-16d03df449ec', '{"FECHA": "2024-06-20 16:30", "MATERIA": "FISICA BASICA I", "AMBIENTE": "691B"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-06 03:31:53', '2024-06-06 03:31:53'),
	('7f644b1f-b2e9-463e-93e7-9290e80268df', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:10:07', '2024-06-01 01:10:07'),
	('7f67cc01-44a9-4755-9acc-d0ee1167aa4f', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:07:07', '2024-05-31 23:07:07'),
	('820c3d5c-c009-4398-b85e-d710674e6731', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:11:32', '2024-06-01 01:11:32'),
	('83ddcb91-c9f2-47ee-81e3-0e101c41b919', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 00:32:02', '2024-06-01 00:32:02'),
	('87cdf2ca-c4e3-41c9-b284-47b983e161df', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:34:14', '2024-05-31 23:34:14'),
	('96c142dd-a3f2-4644-adae-66c162f1b651', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:09:18', '2024-05-31 23:09:18'),
	('9971a2d0-8bfa-4ec0-9c20-aeb00ff4fd81', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 00:30:46', '2024-06-01 00:30:46'),
	('9a246023-424c-43c4-b0c7-ea5c087843c1', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:10:33', '2024-06-01 01:10:33'),
	('9ba3c58f-1ca4-4319-a9f7-0fc9b298c279', '{"FECHA": "27/05/2024", "MATERIA": "COMPUTACION I", "AMBIENTE": "690A"}', 'c34627f2-6dec-4853-a50c-614af0e17e66', '2024-06-11 17:47:36', '2024-06-11 17:47:36'),
	('9d95cd41-470a-4554-ba6d-6fc16e4cfb42', '{"FECHA": "27/05/2024", "MATERIA": "COMPUTACION I", "AMBIENTE": "690A"}', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '2024-06-11 17:41:11', '2024-06-11 17:41:11'),
	('a9f7c8c3-b0b9-40a9-bdb0-d23923d50aed', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 00:17:58', '2024-06-01 00:17:58'),
	('aaac223f-700a-4977-bb3a-423f17e423c1', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:43:50', '2024-05-31 23:43:50'),
	('b041e427-2b8f-4ba3-ab84-71ca7eacdfb7', '{"FECHA": "13/06/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "690MAT"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:28:54', '2024-06-11 17:28:54'),
	('b2467b8e-2ed1-42f7-9a18-c9e4de887d68', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:53:28', '2024-06-01 01:53:28'),
	('b39a0f6a-a51e-42c9-86b6-f547eafabf3c', '{"FECHA": "2024-06-05 09:45:00", "MATERIA": "FISICA I", "AMBIENTE": "690MAT"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-05 05:50:38', '2024-06-05 05:50:38'),
	('b3c45f7b-f222-4d0a-b1ae-8104488d0d16', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:40:10', '2024-05-31 23:40:10'),
	('b49bf3d2-3859-49af-b237-e98c96669d5f', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:19:10', '2024-05-31 21:19:10'),
	('b5276329-60e2-4e2c-ac45-97727ab4bbdd', '"Cuerpo inicial"', 'c7460556-b09c-4b10-8460-05e6183e4e42', '2024-05-31 23:12:08', '2024-05-31 23:12:08'),
	('b55ac01c-b4b6-4b6e-8e11-1c9adad81797', '"Cuerpo inicial"', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '2024-05-31 23:02:56', '2024-05-31 23:02:56'),
	('b6fd883f-a61f-4cf6-b492-e6b675b9b355', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:02:28', '2024-06-01 01:02:28'),
	('b86d529f-bb09-4daf-bda3-c73dc1fda01a', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 20:52:55', '2024-05-31 20:52:55'),
	('bb2416c4-27aa-4e7f-9189-e37fb1db11a3', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 20:59:33', '2024-05-31 20:59:33'),
	('bb657a53-6e8e-4d8f-a3ee-a1e8e7e2a0fa', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 21:03:46', '2024-05-31 21:03:46'),
	('bcbc3189-5a21-44a6-802d-13e9175db8ea', '{"FECHA": "27/05/2024", "MATERIA": "COMPUTACION I", "AMBIENTE": "690A"}', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '2024-06-11 17:47:34', '2024-06-11 17:47:34'),
	('c3031417-76f9-4867-9a8b-7deeafdba70e', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 22:56:22', '2024-05-31 22:56:22'),
	('c8767893-0299-46cf-a03a-4b5bb2d31957', '"Cuerpo inicial"', '007ff40d-5105-47d1-9744-82a199a8436f', '2024-05-31 23:48:44', '2024-05-31 23:48:44'),
	('ce0bb551-a0ad-4e95-abc6-1792bf83f6eb', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:54:37', '2024-05-31 23:54:37'),
	('d30c0611-26b4-4eaa-a9af-e93414043b31', '{"FECHA": "2024-06-26 16:30", "MATERIA": "FISICA BASICA I", "AMBIENTE": "690MAT"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-06 02:47:53', '2024-06-06 02:47:53'),
	('d3c09731-5d5f-4070-95e4-585cffada6bb', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 00:57:53', '2024-06-01 00:57:53'),
	('d3f21611-a2a3-41e8-9875-d08b5c10b07b', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:30:22', '2024-05-31 23:30:22'),
	('d84a9c70-2a2e-440a-99f2-4cc78cd98ec5', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 22:52:11', '2024-05-31 22:52:11'),
	('de00a738-a4fd-4904-8969-a62171e674a3', '{"FECHA": "17/05/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "622"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:40:18', '2024-06-11 17:40:18'),
	('de128663-e531-4cbd-b6d1-d4e140165f93', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:16:08', '2024-06-01 01:16:08'),
	('e0b9fc83-c816-4f7b-83c5-81151312211b', '{"FECHA": "2024-06-26 20:15", "MATERIA": "FISICA BASICA I", "AMBIENTE": "691A"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-06 03:50:39', '2024-06-06 03:50:39'),
	('e1c84195-4c8f-40a8-8e70-83d08bab6307', '{"FECHA": "17/05/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "622"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:34:43', '2024-06-11 17:34:43'),
	('e88d6575-8d3c-4235-95d4-0476a499df28', '{"FECHA": "18/06/2024", "MATERIA": "FISICA BASICA I", "AMBIENTE": "690MAT"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-11 17:30:30', '2024-06-11 17:30:30'),
	('ea072558-0d36-4d19-a5b9-d4f6be846e77', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:28:41', '2024-05-31 23:28:41'),
	('eab3cb52-7589-4844-9d8e-7c2b51e04811', '{"FECHA": "2024-06-20 11:15", "MATERIA": "FISICA BASICA I", "AMBIENTE": "691B"}', '22daa7a1-81d4-49ce-ae01-44d10201b837', '2024-06-11 05:03:25', '2024-06-11 05:03:25'),
	('ee152b31-e8e6-4977-be4f-3326047b5f85', '{"FECHA": "2024-06-05 09:45:00", "MATERIA": "BIOLOGIA GENERAL", "AMBIENTE": "690MAT"}', '007ff40d-5105-47d1-9744-82a199a8436f', '2024-06-05 17:04:34', '2024-06-05 17:04:34'),
	('f2b5b97a-9f08-4840-8046-0500a945acb8', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-05-31 23:32:19', '2024-05-31 23:32:19'),
	('f8a81007-e26a-42cb-9f01-01ffff75287e', '{"FECHA": "2024-06-28 16:30", "MATERIA": "FISICA BASICA I", "AMBIENTE": "690MAT"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-06 03:44:14', '2024-06-06 03:44:14'),
	('fbd8d12f-e7e0-44f4-930f-3cd6ae17ab51', '{"FECHA": "2024-06-18 16:30", "MATERIA": "FISICA BASICA I", "AMBIENTE": "690MAT"}', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-06 03:46:16', '2024-06-06 03:46:16'),
	('fee5c109-aeeb-4795-a794-ce4056480bd1', '"Cuerpo inicial"', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '2024-06-01 01:55:20', '2024-06-01 01:55:20');

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
  `FECHAHORA_CANCEL` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_RAZON`),
  KEY `razon_id_docente_foreign` (`ID_DOCENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.razon: ~0 rows (aproximadamente)
DELETE FROM `razon`;

-- Volcando estructura para tabla reservas_tis.razones
CREATE TABLE IF NOT EXISTS `razones` (
  `id_razones` int unsigned NOT NULL AUTO_INCREMENT,
  `razon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_razones`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.razones: ~4 rows (aproximadamente)
DELETE FROM `razones`;
INSERT INTO `razones` (`id_razones`, `razon`) VALUES
	(1, 'Esta no es una razon'),
	(3, 'Esta es una razon prueba'),
	(4, 'Horaio lleno'),
	(5, 'Porque no quiere dar');

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
  CONSTRAINT `relacion_dahm_ibfk_3` FOREIGN KEY (`ID_HORARIO`) REFERENCES `horario` (`ID_HORARIO`),
  CONSTRAINT `relacion_dahm_ibfk_4` FOREIGN KEY (`ID_MATERIA`) REFERENCES `materia` (`ID_MATERIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.relacion_dahm: ~71 rows (aproximadamente)
DELETE FROM `relacion_dahm`;
INSERT INTO `relacion_dahm` (`ID_RELACION`, `ID_DOCENTE`, `ID_AMBIENTE`, `ID_HORARIO`, `ID_MATERIA`, `created_at`, `updated_at`) VALUES
	('0657eec4-abb3-4af2-8151-cb5c950e5737', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0f5b1b2e-012d-4725-ae34-1f0692d9d991', '6365cf12-a823-4068-97e2-5fe397be1144', 2008214, '2024-05-15 17:10:28', '2024-06-05 17:27:10'),
	('07eb5199-d423-4182-a898-18f7ee65534a', 'bfef68a6-c6e5-4798-ab26-c639bd29bb29', 'a70b77a8-dd33-4b57-86bc-b77bf5eddc41', 'fb39528b-879b-4e74-8ea0-cfd07033de13', 2006018, NULL, NULL),
	('126a84a0-627e-48ff-9b34-a8845e40ac7b', 'c34627f2-6dec-4853-a50c-614af0e17e66', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '380643ac-afde-4254-8e0f-9d458b49b9ba', 2010008, '2024-05-25 01:58:24', '2024-05-25 01:58:24'),
	('12bb5178-553f-4490-9d36-db40403fff4b', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '95c4f2bf-b3bb-435f-bb1a-cece1d21ecf9', '6036ab5a-3c82-43b3-b3be-4b6e29a4ecce', 2006018, NULL, NULL),
	('16e724b6-d7de-4d85-8fa6-2dfe43b51177', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'cb165567-93f3-41fd-8c00-f560fd7d86ab', 2008081, '2024-05-25 01:52:45', '2024-05-25 01:52:45'),
	('186c7038-ae77-4261-a385-c309e82b1fb3', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', 'ab6744e2-8f49-4571-aaf4-a63b9d9d3759', 2008214, '2024-05-15 17:10:28', '2024-06-05 17:27:10'),
	('18f5f1f1-ae2c-4745-b896-fc4ba1dceefa', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '136eedd3-f082-42c0-aacd-0063d5f3562f', '3b247498-3c6c-49ee-be37-14b1e236da0f', 2008080, NULL, NULL),
	('1a686a34-400a-4d90-854a-b712a3f562fc', '039c16c5-4de9-48d6-8238-f24e657c5eb6', 'c94b2136-c5eb-4225-9f9f-f1287a91289d', 'a1939f73-3755-42d4-8c5d-fcb260f0d003', 2010008, NULL, '2024-06-04 15:37:32'),
	('1f0601f5-334c-4d4e-89a7-0ba0e3f3bf33', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', '09d5656e-9be0-4982-bdc9-03cd4252a557', 2008214, '2024-05-15 17:10:26', '2024-06-05 17:27:10'),
	('2305af5c-79ad-41de-a75a-5d646ec8c4c7', 'c7460556-b09c-4b10-8460-05e6183e4e42', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', 'bb2ca027-88aa-4e60-8caa-2ece1cbbe5a5', 2006027, NULL, '2024-06-05 17:27:10'),
	('27707e86-b691-4c80-9096-dd52e20a84a0', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'cffbfb53-32e4-40d4-b11d-93854262c972', 2008081, '2024-05-25 01:52:45', '2024-05-25 01:52:45'),
	('2a75c585-9eac-41c5-bcba-3cb8897079ee', 'bafdb61e-b676-40b1-a09d-eb3e9c1a1d19', '58ee914d-2c7e-4b15-99f7-a79b6dcfa836', '3061c225-d17b-498b-a3dd-31518e6552d1', 2008077, NULL, NULL),
	('315b9fb3-8bd1-4c92-b7eb-639dd6818817', '46f460de-2da8-4ce8-8ffe-5a646073e95a', 'a186dee8-926a-4e19-b564-41df44e83233', '4f94f667-8044-4687-bc95-e147302a4023', 2008214, '2024-05-15 17:10:22', '2024-06-05 17:27:10'),
	('33a7be28-6d75-4ea7-998e-9fcf7c054c3e', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', '631e7df5-3eff-4ba2-a122-e20ecdbe49b5', 2008214, '2024-05-15 17:10:26', '2024-06-05 17:27:10'),
	('3676fa9e-bfc6-4b58-88bd-737ef2d38bb9', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '77b4c945-39af-4ad1-9109-1947f2bd1847', '0b68ffd5-99e9-4344-b99b-95378596059d', 2010008, NULL, '2024-06-04 15:37:32'),
	('36a74c6e-3975-428d-b58d-28d3363df6c5', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'd900ecb9-9a49-48b6-9a10-dee9256f4599', 2008214, '2024-05-25 01:47:14', '2024-06-05 17:27:10'),
	('3909ccfa-eabc-41d4-a014-c319f38e24fd', '007ff40d-5105-47d1-9744-82a199a8436f', '4f0c9cf2-e60c-4c17-8339-89a9a3f7361b', 'd550444f-0909-4b64-ae35-3a15bf66a44e', 2002004, NULL, '2024-06-04 16:46:28'),
	('3d1961ef-4197-4f1c-8258-af04ab8d2a52', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'c58fb51b-0d4b-49c6-a20e-fdc63e460790', 2010008, NULL, '2024-06-04 15:37:32'),
	('43462223-a03e-4828-afd5-0290dd4a2d5f', '46f460de-2da8-4ce8-8ffe-5a646073e95a', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', '0e337acb-58fe-4f7a-8ad3-46a5b7236bbe', 2008214, '2024-05-15 08:54:33', '2024-06-05 17:27:10'),
	('445422b1-0071-4684-9613-3c6304c77165', 'c34627f2-6dec-4853-a50c-614af0e17e66', 'd76626c3-8858-4ca2-8c07-ee87dd022997', 'b807bb63-08b3-47e0-aad0-64cb21784d7a', 2010008, NULL, NULL),
	('549dddc8-9b43-40ce-a735-0eb46cb559c4', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '136eedd3-f082-42c0-aacd-0063d5f3562f', '2e5b02c2-f68d-4331-a085-89cc41d6e793', 2008080, NULL, NULL),
	('55b6b04d-ba32-4188-92ca-60ef1b6eb1e3', '275e16e1-5fdf-41bb-9399-653941e76f71', '2b56ffbe-fbcb-4c9d-adc0-c13749585e98', 'e5ba9e69-a43f-454a-9267-6a877fec907b', 2008054, NULL, '2024-06-05 17:15:01'),
	('583154f9-0341-4064-afe1-651598c7b15b', '007ff40d-5105-47d1-9744-82a199a8436f', '0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'b837a451-f557-4fa6-8bd1-50544891ec2e', 2002004, NULL, '2024-06-04 16:46:28'),
	('58b86cf2-16a3-491b-850d-5fab553bb9d9', 'bfef68a6-c6e5-4798-ab26-c639bd29bb29', '58ee914d-2c7e-4b15-99f7-a79b6dcfa836', 'bba89453-393c-4a9e-acea-c5a80e8a675d', 2008077, NULL, NULL),
	('59c69e1a-ccad-4bed-bb55-38075e069b65', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', '1a732a32-4d03-44ef-b68f-415295d316d2', 'f38e3c4b-282b-4449-a696-8a157f86d099', 2008053, '2024-05-25 02:02:09', '2024-05-25 02:02:09'),
	('5c88b215-80ab-4b3e-8d90-f8fbcc89133b', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', '668a058c-ad61-48d2-a189-7215ebcab256', '44235137-514c-49da-994d-1f86a837a472', 2008053, NULL, NULL),
	('5ee5311b-dccc-4bfd-8b74-7d0c33c652b1', '007ff40d-5105-47d1-9744-82a199a8436f', '4f0c9cf2-e60c-4c17-8339-89a9a3f7361b', 'eb2de201-7174-49fe-a5c7-8901a2b229f3', 2002004, NULL, '2024-06-04 16:46:28'),
	('63997452-9b56-4418-bd31-242102ec3a40', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', '5d7d0044-0aab-44c5-9e51-a4e7ee7b4667', '694e6c52-c99b-4b0b-ba67-9c073d283c81', 2008053, NULL, NULL),
	('65cfcdaa-4524-4f22-8824-1677e3cd938a', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', 'caa3230c-6f63-4954-886f-656475b9e599', 2008214, '2024-05-15 17:11:15', '2024-06-05 17:27:10'),
	('69a5820f-7685-41d3-867f-161f88a6f9ea', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '228bda51-fdce-44bd-b7ff-d9908dde224a', 2010008, '2024-05-25 01:55:40', '2024-06-04 15:37:32'),
	('6e2c826e-2477-4bfe-bb10-9d8b2c1769bf', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', '3833bb3b-62d9-4dda-a485-5be29863a369', 2008214, '2024-05-15 17:10:25', '2024-06-05 17:27:10'),
	('6fc2fa48-23bd-4d8c-9d70-67dcd60ddc71', '968acc82-30de-4bbf-8b40-9be8d5251468', '1a732a32-4d03-44ef-b68f-415295d316d2', 'efec1860-c03b-4f02-9644-a95146419f93', 2008055, NULL, NULL),
	('75eefc6e-a8a2-4be4-84a7-12558040fd7e', 'ab5d4702-a8ff-4884-ab4d-02db4e560e12', '136eedd3-f082-42c0-aacd-0063d5f3562f', '0aae2f87-f810-4c8a-9c61-56f71b046dc4', 2008075, NULL, '2024-06-04 17:06:49'),
	('78c326f8-4a22-4e67-a209-a4997f9bb5a0', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', 'bb2ca027-88aa-4e60-8caa-2ece1cbbe5a5', 2008214, '2024-05-15 17:10:25', '2024-06-05 17:27:10'),
	('7f74cb5c-36ca-4072-8652-cee78a8f636f', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '2b56ffbe-fbcb-4c9d-adc0-c13749585e98', 'cc6ba429-7098-4902-af61-3cd22cfe6397', 2010008, NULL, '2024-06-04 15:37:32'),
	('80bcf7c0-f5ba-425e-8ffa-9024d011afd1', '9e05d053-f73b-4800-a3c7-f61f38c1d388', '5fe66ff0-bb2a-4940-8bbb-57363a2478ba', '13bbbf56-13b7-474c-8b14-2849faf6ddab', 2004046, NULL, NULL),
	('80ee6112-516a-4ece-873c-d4f9a76ed1de', '275e16e1-5fdf-41bb-9399-653941e76f71', 'a099246b-9a37-4a88-b8a5-3cd917ca51ee', '842eb2ce-080e-4194-98e2-80a6c31e43a5', 2008054, NULL, '2024-06-05 17:15:01'),
	('8bce4c67-70f9-46c9-bbf4-501f047f16b7', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '7952448f-b07c-41b8-9ed5-70e3555597c8', 2008214, '2024-05-25 01:47:14', '2024-06-05 17:27:10'),
	('90b881a6-f506-4a14-9c74-c79bec74e0d5', '22daa7a1-81d4-49ce-ae01-44d10201b837', '28bda7e0-431a-4d59-bb24-6a91d31c32a8', '8632c8dd-298a-48fb-b955-5160a3694080', 2008054, NULL, '2024-06-09 18:38:46'),
	('96a8574c-8ec5-45ab-8b96-ee3f60c2c5ce', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '136eedd3-f082-42c0-aacd-0063d5f3562f', '043c34e4-477f-4b01-a99f-fbb9f2e6ca14', 2008080, NULL, NULL),
	('9859168d-66ef-4310-a367-c326a22bdf27', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '4d609316-26c8-4eea-8712-4b10557b4812', '72b1d8b0-f1fd-4588-ab39-d7fa979de668', 2008070, NULL, NULL),
	('9aff20e7-2fc9-4de9-9407-b4c0fcb10721', '039c16c5-4de9-48d6-8238-f24e657c5eb6', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '0a95ed32-d6e9-42b5-a535-75653acf42e8', 2010008, '2024-05-25 01:55:40', '2024-06-04 15:37:32'),
	('9b53af6e-74fe-4886-bff5-65d46c76785d', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', '54a3c394-7a9d-463c-9188-c22a8653a3a3', 2008214, '2024-05-15 17:10:29', '2024-06-05 17:27:10'),
	('a101094d-e526-46b0-bcff-fa13012c3eab', '968acc82-30de-4bbf-8b40-9be8d5251468', 'a426ee14-886d-4b73-874a-86181341c512', 'a19acb72-b4bf-43c0-be50-35e1edfc7ed1', 2008055, NULL, NULL),
	('a11b7406-71e9-4503-b12e-3703e71c2500', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '4d609316-26c8-4eea-8712-4b10557b4812', 'b9c3da52-2c60-4902-9dae-275f9d007c41', 2008070, NULL, NULL),
	('a35754d8-3534-4810-bba8-955b5afbea2d', 'c34627f2-6dec-4853-a50c-614af0e17e66', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '3a28468a-4408-4226-831b-5082efd1cf95', 2010008, '2024-05-25 01:58:24', '2024-05-25 01:58:24'),
	('a4b3e92e-9f9f-46d6-97ba-a8f7cc5fb4e0', '46f460de-2da8-4ce8-8ffe-5a646073e95a', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'd98b7dae-c77e-4051-9382-43772fcad8c9', 2008214, '2024-05-15 08:57:46', '2024-06-05 17:27:10'),
	('a7240e21-4921-4cf1-9082-9ae4fbdb6036', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', '45e5c60c-66da-4235-944b-90e8035f903d', 2008214, '2024-05-15 17:10:13', '2024-06-05 17:27:10'),
	('ad639607-c463-436d-9d26-d2cd1da0f2b8', 'ab5d4702-a8ff-4884-ab4d-02db4e560e12', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'd6cf8bb2-29d7-43ca-a519-73b8e9ac411b', 2008075, NULL, '2024-06-04 17:06:49'),
	('ae85fc58-f018-4122-925f-12c5565ea453', '4f97364e-8534-48fd-981f-822aa93d94a4', '1a732a32-4d03-44ef-b68f-415295d316d2', 'b91bb79c-d88b-4473-907b-0f61d55725fb', 2008056, NULL, NULL),
	('b33ca758-9beb-4c0e-87c3-d2d84845cfd0', '1570c086-4356-433b-9ba1-9777c192a6db', '0f5b1b2e-012d-4725-ae34-1f0692d9d991', '8a6c2273-d406-450d-8c36-3d6c142027a0', 2004046, NULL, NULL),
	('b9df5330-1911-4442-9a5c-4fda58eae767', 'c7460556-b09c-4b10-8460-05e6183e4e42', '5d7d0044-0aab-44c5-9e51-a4e7ee7b4667', 'ad813392-430f-49d4-a8c2-2412a02aadcb', 2006027, NULL, NULL),
	('bd842207-e2c3-4a8a-bc01-1884c952dab2', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '004e1a3f-bffa-432f-bd25-d908f1d6a644', 2008214, NULL, '2024-06-05 17:27:10'),
	('c20814ce-0651-4ee0-a23e-771113672812', 'a9bc1344-1f8f-48a9-b37a-e9e4ac141e87', '58ee914d-2c7e-4b15-99f7-a79b6dcfa836', '645a1e1e-e4fb-49e4-bc08-48f4cd96cdf4', 2008077, NULL, NULL),
	('c2c3ca32-8c21-41aa-ba94-e18bc5c57f59', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', 'ba8d666e-601d-46bf-bbe4-88fa9b9e2623', '4d1d8511-ce79-44a2-9da3-f05f8a0a768e', 2008053, NULL, NULL),
	('c95b1129-e5d1-476e-acad-f01216255542', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '7b3a1bae-2462-44fa-8a2a-2658364f1de2', '66fa9666-914d-4419-aa70-c0bd7d69518a', 2008214, NULL, '2024-06-05 17:27:10'),
	('cc60c9b4-efc7-4822-b179-aa7ff75d74ae', 'c7460556-b09c-4b10-8460-05e6183e4e42', '77b4c945-39af-4ad1-9109-1947f2bd1847', '0b7d8d61-6f00-466c-b519-ee1f2eeabfd6', 2006027, NULL, NULL),
	('cc974404-5ac9-48bd-a68d-cb3a67c2ff4b', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', '64d6ebb7-dfec-48be-9a25-6179fb2d4a08', 2008214, '2024-05-15 17:11:27', '2024-06-05 17:27:10'),
	('cf1d1517-cfc1-4210-9b99-09a9b6dbf503', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', '2b56ffbe-fbcb-4c9d-adc0-c13749585e98', '3a5a6049-b9e3-4f5b-868f-8227d7e122cb', 2008053, '2024-05-25 02:02:09', '2024-05-25 02:02:09'),
	('d11d5464-c69b-4f59-8d2c-3f1148392a51', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', 'f8871d14-f54d-4d94-b2c2-7ea40ee20f58', 2008214, '2024-05-15 17:10:12', '2024-06-05 17:27:10'),
	('d2bdb524-491b-425c-9a50-1344ee7f5d2f', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '136eedd3-f082-42c0-aacd-0063d5f3562f', '684352eb-bf39-46fc-91ca-c2e0b03bc377', 2008070, NULL, NULL),
	('d56ad906-7d4e-4390-9260-bfc4f0dabb5a', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', '125957c7-e790-48ed-bb5e-b7f2a1f3ce44', 2008214, '2024-05-15 17:10:27', '2024-06-05 17:27:10'),
	('d71d6b30-5572-4514-93af-f3dceb67d168', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', 'c694c7e4-9f03-4857-b282-7922962b4038', '6a327ef2-6143-4134-887e-66bbe82cd24a', 2006018, NULL, NULL),
	('d772f89a-ea90-4275-8bb6-bf3fb6e78a18', '4f97364e-8534-48fd-981f-822aa93d94a4', '0f5b1b2e-012d-4725-ae34-1f0692d9d991', '8a21ed4f-25b9-4b82-b5e1-baef707b6570', 2008056, NULL, NULL),
	('d84106d3-3686-4df5-997d-5313b09b6078', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '136eedd3-f082-42c0-aacd-0063d5f3562f', '8b7a3821-79b0-43c3-a74d-36771f4797d5', 2008081, NULL, NULL),
	('d9f88d2e-acb5-4cff-abee-aa59f6a5ddb2', '46f460de-2da8-4ce8-8ffe-5a646073e95a', '0eb51b13-2b9d-4d68-a62d-c7869d3a2db5', '32d69a46-24f7-457e-8c6e-12b58c137d29', 2008214, '2024-05-15 17:10:17', '2024-06-05 17:27:10'),
	('dcf89a59-9bdb-4bb5-a0bb-9e0a963dc85e', '007ff40d-5105-47d1-9744-82a199a8436f', '0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'eaf8bd6c-7625-45a6-97be-a7090c44b2dc', 2002004, NULL, '2024-06-04 16:46:28'),
	('de4e1581-2e50-4705-88af-f62525de337b', '2e196af2-f995-4628-849c-81e83596bb3a', '28bda7e0-431a-4d59-bb24-6a91d31c32a8', 'c32508d8-66f4-4b84-ab99-f10c27a66031', 2004046, NULL, NULL),
	('e3a49d60-f3ef-46c7-bee7-7b3eac8028b9', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', 'a186dee8-926a-4e19-b564-41df44e83233', 'c829752f-3944-4884-8c1c-033687b4d247', 2008081, NULL, NULL),
	('e64ab34a-6853-43d8-be08-427e4ee401b5', '968acc82-30de-4bbf-8b40-9be8d5251468', '77b4c945-39af-4ad1-9109-1947f2bd1847', '38b3ef70-7ce0-42e2-94af-3e1375c8a081', 2008055, NULL, NULL),
	('e7daaa9e-d357-4888-aabe-c4e3bb9ae1ea', 'ab5d4702-a8ff-4884-ab4d-02db4e560e12', '4d609316-26c8-4eea-8712-4b10557b4812', '24b6950a-917c-40a9-8b32-a2d23e757fad', 2008075, NULL, '2024-06-04 17:06:49'),
	('e97f678b-0792-4664-b058-d1c58f6aad84', 'ea6466ef-d138-41bb-98cf-5c3660b76f1f', '1cc57a33-84ea-492c-87e5-f6a79b302e03', '03b0afd4-e6ef-4379-b4d5-1fa10927707e', 2010008, NULL, NULL),
	('eccbf3e1-5667-4ea3-8dcc-e8bfb67a4852', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', 'd5dfd6a7-ea25-4299-a52c-481bf133c7eb', 'b83e7df0-ab94-42c5-b4d8-02b3716da042', 2006018, NULL, NULL);

-- Volcando estructura para tabla reservas_tis.relacion_dm
CREATE TABLE IF NOT EXISTS `relacion_dm` (
  `ID_RELACION` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_DOCENTE` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_MATERIA` bigint unsigned NOT NULL,
  `GRUPO` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_RELACION`),
  KEY `relacion_dm_id_docente_foreign` (`ID_DOCENTE`),
  KEY `relacion_dm_id_materia_foreign` (`ID_MATERIA`),
  CONSTRAINT `relacion_dm_id_docente_foreign` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docente` (`ID_DOCENTE`),
  CONSTRAINT `relacion_dm_id_materia_foreign` FOREIGN KEY (`ID_MATERIA`) REFERENCES `materia` (`ID_MATERIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.relacion_dm: ~18 rows (aproximadamente)
DELETE FROM `relacion_dm`;
INSERT INTO `relacion_dm` (`ID_RELACION`, `ID_DOCENTE`, `ID_MATERIA`, `GRUPO`, `created_at`, `updated_at`) VALUES
	('139a62a0-d92b-4cce-9f86-f36bbfd2c4d6', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', 2008070, '1', NULL, NULL),
	('207b57ed-bea5-4599-9532-f363357319ea', '4f97364e-8534-48fd-981f-822aa93d94a4', 2008056, '11', NULL, NULL),
	('24b9450c-5b18-47b3-99d0-3230458ed9a1', '46f460de-2da8-4ce8-8ffe-5a646073e95a', 2008214, '1', NULL, NULL),
	('2d7ff8e0-8494-46a7-98fa-b5f13bb54188', '275e16e1-5fdf-41bb-9399-653941e76f71', 2008054, '13', NULL, NULL),
	('3a3441f3-1bc4-4ec8-80c0-9cd7e1e29104', '968acc82-30de-4bbf-8b40-9be8d5251468', 2008055, '1', NULL, NULL),
	('5425e83a-0a34-4c93-8dee-763c88df7f24', '22daa7a1-81d4-49ce-ae01-44d10201b837', 2008054, '13', NULL, NULL),
	('6fd7aefb-e178-4b22-bd5e-7462a9740485', 'ea6466ef-d138-41bb-98cf-5c3660b76f1f', 2010008, '4', NULL, NULL),
	('7fa001a0-f52b-4d2e-a9ea-59fd26fd35dc', 'c7460556-b09c-4b10-8460-05e6183e4e42', 2006027, '1', NULL, NULL),
	('811e1195-992a-4008-ad81-1a29ce856a00', '039c16c5-4de9-48d6-8238-f24e657c5eb6', 2010008, '2', NULL, NULL),
	('81e65eb8-3f3e-4db7-b774-a73229ca934e', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', 2008080, '1', NULL, NULL),
	('b12028e8-b8bb-4030-b708-af4ed27219f2', 'c34627f2-6dec-4853-a50c-614af0e17e66', 2010008, '2', NULL, NULL),
	('c2b0db45-41df-4102-858f-6c69435683e1', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', 2006018, 'M', NULL, NULL),
	('da4bcb0e-b334-485d-a318-f433e7719913', '039c16c5-4de9-48d6-8238-f24e657c5eb6', 2010008, '4', NULL, NULL),
	('da9387f5-f86e-49d5-bbd8-7590843c28a4', 'ab5d4702-a8ff-4884-ab4d-02db4e560e12', 2008075, '1', NULL, NULL),
	('eeb354f5-30b6-4779-b911-0e0d84c1c496', '7cf7f927-02c7-4442-a8dc-d045b4c612d7', 2008053, '5', NULL, NULL),
	('f0cfa652-e9d2-4e05-ad29-7d0f0fbb12d8', '007ff40d-5105-47d1-9744-82a199a8436f', 2002004, '1', NULL, NULL),
	('faaf6488-a8b4-4284-9095-eadda8848cce', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', 2008081, '1', NULL, NULL);

-- Volcando estructura para tabla reservas_tis.reserva
CREATE TABLE IF NOT EXISTS `reserva` (
  `ID_RESERVA` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_SOLICITUD` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RAZONES` json NOT NULL,
  `FECHAHORA_RESER` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_RESERVA`),
  KEY `reserva_id_solicitud_foreign` (`ID_SOLICITUD`),
  CONSTRAINT `reserva_id_solicitud_foreign` FOREIGN KEY (`ID_SOLICITUD`) REFERENCES `solicitud` (`ID_SOLICITUD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.reserva: ~43 rows (aproximadamente)
DELETE FROM `reserva`;
INSERT INTO `reserva` (`ID_RESERVA`, `ID_SOLICITUD`, `RAZONES`, `FECHAHORA_RESER`, `created_at`, `updated_at`) VALUES
	('00d8fd42-96ca-425f-9886-3db56e606bd4', 'd3796064-bc83-4ea3-866a-f68ab47e3e5a', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-05 16:23:54', '2024-06-05 16:23:54'),
	('0da96df1-e546-4e20-b201-9e7d9bb3b2a2', 'dbdae2bb-b725-45a8-9f9b-1f5c1086927e', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-10 01:24:42', '2024-06-10 01:24:42'),
	('0e122f63-c951-422f-be45-6ae054a117a6', '31d378de-6667-4405-a15c-9c7d47f08156', '["Horaio lleno"]', '2024-06-11 00:00:00', '2024-06-11 04:26:48', '2024-06-11 04:26:48'),
	('11aaf89b-d3ec-43c6-ab76-49ea55337a03', '99e4a1f9-f476-49ce-b62d-614f6cf43f99', '["Razon valida por mi"]', '2024-06-11 00:00:00', '2024-06-11 12:34:34', '2024-06-11 12:34:34'),
	('1226f76a-ef9e-441b-b9e5-978c93ae5289', 'd43ec0ad-5a01-4f3e-8daa-0e4f02954f79', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-05 16:20:08', '2024-06-05 16:20:08'),
	('13b19905-732a-4d93-8047-aea69b62c1a9', 'd3796064-bc83-4ea3-866a-f68ab47e3e5a', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-05 16:23:52', '2024-06-05 16:23:52'),
	('1792593a-3d6b-424f-9c8b-6a7d9b59d738', 'a4be1a50-cdd1-4cd1-a1cf-5288fbdcd99a', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-09 19:16:12', '2024-06-09 19:16:12'),
	('1befdb67-e90b-4f92-b57d-6d387362b96f', '67a44c15-ac3a-4c22-bfaa-f95536738b65', '["1", "3"]', '2024-06-11 00:00:00', '2024-06-11 13:46:34', '2024-06-11 13:46:34'),
	('1f74367a-ba58-4e08-a1b3-dd0c06576986', '20b8ad07-0784-4b97-9656-d31737dfba37', '["3", "4"]', '2024-06-11 00:00:00', '2024-06-11 17:43:55', '2024-06-11 17:43:55'),
	('258e32c0-15eb-4e77-8638-5a6fd8d30429', '47918aa9-5ab3-418d-82d5-5f417b43c8ab', '"Ninguno"', '2024-06-11 00:00:00', '2024-06-11 17:28:12', '2024-06-11 17:28:12'),
	('4976cb93-36ac-42d5-b3e6-291560952441', '550e8400-e29b-41d4-a716-446655440000', '[]', '2024-05-28 00:00:00', '2024-05-28 22:20:32', '2024-06-11 16:43:13'),
	('4f910440-aa70-4081-9e34-05c2836b8b21', '9edee4f0-794c-45db-bb49-72283075beca', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-05 16:58:18', '2024-06-05 16:58:18'),
	('508ede81-b7b9-4e9d-885b-1f50ec4c182f', 'dbdae2bb-b725-45a8-9f9b-1f5c1086927e', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-10 01:23:47', '2024-06-10 01:23:47'),
	('57c16e74-3b00-4d4e-a48c-3fe9d19629fc', '550e8400-e29b-41d4-a716-446655440000', '[]', '2024-05-28 00:00:00', '2024-05-28 20:40:07', '2024-06-11 16:43:13'),
	('591d7817-701f-490e-a8d7-25bf24b4d3a8', '2534898e-59f8-4281-8ded-51a62a71716e', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-05 16:57:11', '2024-06-05 16:57:11'),
	('5cb29d7f-b650-46f5-a8eb-6b62d6e6fa1a', '22690513-2dc5-4767-a1d8-130dbffdfbfa', '"Ninguno"', '2024-06-11 00:00:00', '2024-06-11 17:28:45', '2024-06-11 17:28:45'),
	('5f3aecec-f2e5-473a-bc8e-7207816d1f2c', '240b5650-f131-43f8-998f-49740fd193bd', '"Ninguno"', '2024-06-06 00:00:00', '2024-06-06 04:04:03', '2024-06-06 04:04:03'),
	('61e5a0b6-6846-48f2-bbf2-a17ca8884114', '9e1e3798-7481-4b22-9954-e4249068e77d', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-10 01:09:36', '2024-06-10 01:09:36'),
	('649b20ae-9502-4b10-b67b-4440e960dfaa', 'd8583ed0-0951-4e7d-a63e-4a1188a3d652', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-10 01:11:35', '2024-06-10 01:11:35'),
	('6bf740c5-6814-47e0-9ac2-3e5593be0a72', '32753435-10d2-4455-b093-17eecee35449', '"Ninguno"', '2024-05-29 00:00:00', '2024-05-29 19:12:34', '2024-05-29 19:12:34'),
	('70ba065f-0453-41c9-a116-489c363ee955', 'd3796064-bc83-4ea3-866a-f68ab47e3e5a', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-05 16:23:55', '2024-06-05 16:23:55'),
	('71709286-998a-4912-93a9-a569dd695af7', 'dbdae2bb-b725-45a8-9f9b-1f5c1086927e', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-10 01:25:55', '2024-06-10 01:25:55'),
	('7434e560-f659-4d5c-8c81-e4b40873c1f3', '5c8dff33-e6d0-4a75-87ee-84cdf265a1c8', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-09 18:14:10', '2024-06-09 18:14:10'),
	('84ab1a65-5c6b-49a8-8dbc-2a7743f7e5db', '9351acc4-7cef-4c02-aa09-51cdf6906fef', '["1", "3"]', '2024-06-11 00:00:00', '2024-06-11 16:05:22', '2024-06-11 16:05:22'),
	('8667279e-9bb3-4eb9-97c7-79dae6f7e397', '62f59fe2-28b0-4eee-b6f8-1c5381b2f533', '["1", "3"]', '2024-06-11 00:00:00', '2024-06-11 15:31:05', '2024-06-11 15:31:05'),
	('95dcf595-d21d-49ee-aab6-ad80594188cf', 'f86dd2b7-bb96-4bda-8288-21e86d3c66b4', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-10 01:16:13', '2024-06-10 01:16:13'),
	('99e62ae0-2d55-464b-8bb6-809fe79e2518', '550e8400-e29b-41d4-a716-446655440000', '[]', '2024-05-28 00:00:00', '2024-05-28 22:29:55', '2024-06-11 16:43:13'),
	('9a6499f4-bc1f-4d40-a32c-ecea711aeb91', '4e586262-a093-4e15-8dac-435a8afd3f5e', '["Horaio lleno"]', '2024-06-11 00:00:00', '2024-06-11 04:35:24', '2024-06-11 04:35:24'),
	('a2b3f365-a927-47ce-a869-c561fbd31210', '6365d385-b59e-44fe-a0a3-66e1b154e33d', '[]', '2024-06-09 00:00:00', '2024-06-09 19:41:02', '2024-06-09 19:41:02'),
	('a925f0fc-347f-4976-9448-8732a98246da', '9351acc4-7cef-4c02-aa09-51cdf6906fef', '["1", "3"]', '2024-06-11 00:00:00', '2024-06-11 16:08:29', '2024-06-11 16:08:29'),
	('abd6554a-adb8-44fb-8999-85accd8e1246', '1f4ef4d4-758a-4651-82c9-eb450e55c7d4', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-05 17:09:35', '2024-06-05 17:09:35'),
	('b643a3eb-80af-44ca-95f6-42ef0aa2cad3', '9d39fe05-9485-4414-a5bf-e32ba6d05392', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-09 18:42:18', '2024-06-09 18:42:18'),
	('bb5dfab7-dc20-429d-a0ef-ace65162d8dd', 'f47ac10b-58cc-4372-a567-0e02b2c3d479', '["3"]', '2024-05-29 00:00:00', '2024-05-29 19:24:46', '2024-06-11 17:47:29'),
	('c1ad0dd0-5b8e-42c6-a22e-5941bee5af3a', 'ef228f43-a121-469a-b1ab-079d5d329e4a', '"Ninguno"', '2024-06-11 00:00:00', '2024-06-11 17:30:25', '2024-06-11 17:30:25'),
	('c256c808-563f-4710-acdc-28ed35abb727', '106ecf63-1f16-4f72-9460-42375a679ffa', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-09 19:17:11', '2024-06-09 19:17:11'),
	('c37a4ad6-85ac-4845-ab91-ebaec4be04bd', '67a44c15-ac3a-4c22-bfaa-f95536738b65', '["1"]', '2024-06-11 00:00:00', '2024-06-11 15:32:51', '2024-06-11 15:32:51'),
	('d78e973e-5c3b-4a5e-b391-b0cda0cb9c39', '67a44c15-ac3a-4c22-bfaa-f95536738b65', '["1", "3"]', '2024-06-11 00:00:00', '2024-06-11 13:48:24', '2024-06-11 13:48:24'),
	('dc61dad0-8ebc-435e-8dcb-a8e4fa4f28b6', '99e4a1f9-f476-49ce-b62d-614f6cf43f99', '["Razon valida por mi"]', '2024-06-11 00:00:00', '2024-06-11 12:45:52', '2024-06-11 12:45:52'),
	('dc7f6852-7af4-445f-aecf-d0d1d2e4c822', 'f86e4d5c-729b-4358-a094-3facecaf862c', '[1, 3]', '2024-06-09 00:00:00', '2024-06-09 19:40:25', '2024-06-09 19:40:25'),
	('dcc9403a-293c-42e7-9601-3ec2f88fabdc', 'a8dbece7-ea32-446a-abae-cdb02b005181', '["1", "3"]', '2024-06-11 00:00:00', '2024-06-11 16:01:11', '2024-06-11 16:01:11'),
	('ddd14f1a-2998-45ab-bbdc-e24a5569b0f7', '550e8400-e29b-41d4-a716-446655440000', '[]', '2024-05-28 00:00:00', '2024-05-28 22:18:42', '2024-06-11 16:43:13'),
	('e9acee66-918a-407e-8b6d-441d882ef5c2', 'e0ae3da0-1ddf-4384-a400-58c52aed2243', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-05 16:52:52', '2024-06-05 16:52:52'),
	('ea35252d-dfe4-475d-bb0c-2b4b83c0535f', '729f028c-73cd-4dce-9ab9-75ac8af828ab', '"Ninguno"', '2024-06-11 00:00:00', '2024-06-11 16:10:33', '2024-06-11 16:10:33'),
	('ee1da7ef-15dc-43e0-9ca9-6b434a07a581', '5c8dff33-e6d0-4a75-87ee-84cdf265a1c8', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-09 18:14:09', '2024-06-09 18:14:09'),
	('eeb49fc5-df6d-414c-81af-33a561013e71', '8e3e9204-60d3-461b-bb11-923b717048eb', '"Ninguno"', '2024-06-09 00:00:00', '2024-06-09 18:16:52', '2024-06-09 18:16:52'),
	('f3bc220c-0d31-49ef-ad4f-3191cbaec20d', '219dfede-d38a-4e74-b628-4070d61e4339', '["3", "4"]', '2024-06-09 00:00:00', '2024-06-09 19:04:47', '2024-06-11 17:51:36'),
	('f7e55ec6-4d48-4c3e-b838-92902451f23d', '4963fbe8-7e68-4505-ac23-14ca38716309', '[]', '2024-06-09 00:00:00', '2024-06-09 19:43:01', '2024-06-09 19:43:01'),
	('ffceb241-51a9-475e-b227-8d3376bce597', '55919abf-0dad-4bc1-98fd-0e1f72e6fc17', '"Ninguno"', '2024-06-05 00:00:00', '2024-06-06 03:56:12', '2024-06-06 03:56:12');

-- Volcando estructura para tabla reservas_tis.solicitud
CREATE TABLE IF NOT EXISTS `solicitud` (
  `ID_SOLICITUD` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_DOCENTE_s` json NOT NULL,
  `CANTIDAD_EST` int NOT NULL,
  `FECHA_RE` datetime NOT NULL,
  `HORAINI` time NOT NULL,
  `HORAFIN` time NOT NULL,
  `FECHAHORA_SOLI` datetime NOT NULL,
  `MOTIVO` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRIORIDAD` json NOT NULL,
  `ID_MATERIA` bigint unsigned NOT NULL,
  `GRUPOS` json NOT NULL,
  `ID_AMBIENTE` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ESTADO` enum('CANCELADO','ACEPTADO','PENDIENTE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_SOLICITUD`),
  KEY `solicitud_id_materia_foreign` (`ID_MATERIA`),
  KEY `solicitud_id_ambiente_foreign` (`ID_AMBIENTE`),
  CONSTRAINT `solicitud_id_ambiente_foreign` FOREIGN KEY (`ID_AMBIENTE`) REFERENCES `ambiente` (`ID_AMBIENTE`),
  CONSTRAINT `solicitud_id_materia_foreign` FOREIGN KEY (`ID_MATERIA`) REFERENCES `materia` (`ID_MATERIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.solicitud: ~55 rows (aproximadamente)
DELETE FROM `solicitud`;
INSERT INTO `solicitud` (`ID_SOLICITUD`, `ID_DOCENTE_s`, `CANTIDAD_EST`, `FECHA_RE`, `HORAINI`, `HORAFIN`, `FECHAHORA_SOLI`, `MOTIVO`, `PRIORIDAD`, `ID_MATERIA`, `GRUPOS`, `ID_AMBIENTE`, `ESTADO`, `created_at`, `updated_at`) VALUES
	('02b17668-68dd-4d2e-9d12-85d8ffff6172', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 12, '2024-06-28 16:30:00', '16:30:00', '17:00:00', '2024-06-05 23:44:09', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '[null]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-06-06 03:44:10', '2024-06-06 03:44:10'),
	('0e42f8c9-1e3f-4c4e-8b6b-16a3b2c6e6bc', '{"id1": "bfef68a6-c6e5-4798-ab26-c639bd29bb29", "id2": "354db6b6-be0f-4aca-a9ea-3c31e412c49d"}', 250, '2024-05-17 11:15:00', '11:15:00', '12:45:00', '2024-05-14 17:43:12', 'Examen final', '{"NORMAL": "Ninguno"}', 2006018, '{"grupo1": 1, "grupo2": "M"}', '0f5b1b2e-012d-4725-ae34-1f0692d9d991', 'CANCELADO', NULL, '2024-06-11 17:50:11'),
	('106ecf63-1f16-4f72-9460-42375a679ffa', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:02:49', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-05-31 20:02:49', '2024-06-09 19:17:11'),
	('1f4ef4d4-758a-4651-82c9-eb450e55c7d4', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:04:05', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-05-31 20:04:05', '2024-06-05 17:09:35'),
	('20b8ad07-0784-4b97-9656-d31737dfba37', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 56, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 20:16:33', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'CANCELADO', '2024-06-01 00:16:33', '2024-06-11 17:43:55'),
	('219dfede-d38a-4e74-b628-4070d61e4339', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-05-29 16:30:00', '16:30:00', '17:00:00', '2024-05-28 22:22:04', 'Examen parcial', '"{\\"URGENTE\\":\\"Razon de la docente\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'CANCELADO', '2024-05-29 02:22:04', '2024-06-11 17:51:36'),
	('22690513-2dc5-4767-a1d8-130dbffdfbfa', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d", "2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d"]', 13, '2024-06-13 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:07:06', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M", "1"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'ACEPTADO', '2024-05-31 23:07:06', '2024-06-11 17:28:45'),
	('240b5650-f131-43f8-998f-49740fd193bd', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 28, '2024-06-06 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:28:40', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'ACEPTADO', '2024-05-31 23:28:40', '2024-06-06 04:04:03'),
	('2534898e-59f8-4281-8ded-51a62a71716e', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 4, '2024-06-04 16:30:00', '16:30:00', '17:00:00', '2024-05-31 21:53:25', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-06-01 01:53:25', '2024-06-05 16:57:11'),
	('299e4c6f-0da7-44da-beba-ba596979f637', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 9, '2024-06-20 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:15:20', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'PENDIENTE', '2024-05-31 20:15:20', '2024-05-31 20:15:20'),
	('2f373fae-4156-432a-bb4a-b619ab1e9aab', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 9, '2024-06-27 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:09:17', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'PENDIENTE', '2024-05-31 23:09:17', '2024-05-31 23:09:17'),
	('2f4a2c71-e2ea-42cd-9db0-971fa897df8c', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 13, '2024-06-26 20:15:00', '20:15:00', '21:45:00', '2024-06-05 23:50:33', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '[null]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'PENDIENTE', '2024-06-06 03:50:33', '2024-06-06 03:50:33'),
	('31d378de-6667-4405-a15c-9c7d47f08156', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:07:23', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'CANCELADO', '2024-05-31 20:07:23', '2024-06-11 04:26:48'),
	('32753435-10d2-4455-b093-17eecee35449', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-05-29 16:30:00', '16:30:00', '17:00:00', '2024-05-28 22:33:22', 'Examen parcial', '"{\\"URGENTE\\":\\"Razon de la docente\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'ACEPTADO', '2024-05-29 02:33:22', '2024-05-29 19:12:34'),
	('431eeac7-3a00-4827-b77a-55c01b3e2e94', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 22, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 18:52:10', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'PENDIENTE', '2024-05-31 22:52:10', '2024-05-31 22:52:10'),
	('451a9251-f5c6-4eb9-a441-02809fb8f4af', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 22, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:54:10', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'PENDIENTE', '2024-05-31 20:54:11', '2024-05-31 20:54:11'),
	('47918aa9-5ab3-418d-82d5-5f417b43c8ab', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:07:43', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-05-31 20:07:43', '2024-06-11 17:28:12'),
	('4963fbe8-7e68-4505-ac23-14ca38716309', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 36, '2024-06-13 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:09:07', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'CANCELADO', '2024-05-31 20:09:07', '2024-06-09 19:43:01'),
	('4e0a5b91-9053-4fad-b9ef-7e6d488024e4', '["22daa7a1-81d4-49ce-ae01-44d10201b837", "275e16e1-5fdf-41bb-9399-653941e76f71"]', 140, '2024-06-20 11:15:00', '11:15:00', '12:45:00', '2024-06-11 01:03:00', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '[null, null]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'PENDIENTE', '2024-06-11 05:03:00', '2024-06-11 05:03:00'),
	('4e586262-a093-4e15-8dac-435a8afd3f5e', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:06:32', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'CANCELADO', '2024-05-31 20:06:32', '2024-06-11 04:35:24'),
	('550e8400-e29b-41d4-a716-446655440000', '{"id1": "2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d"}', 200, '2024-05-15 14:30:00', '14:30:00', '15:30:00', '2024-05-14 16:19:07', 'Examen parcial', '{"URGENTE": "Examen parcial postergado desde hace 4 semanas"}', 2008081, '{"grupo1": 1}', 'c694c7e4-9f03-4857-b282-7922962b4038', 'ACEPTADO', NULL, '2024-05-28 22:29:55'),
	('55919abf-0dad-4bc1-98fd-0e1f72e6fc17', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 4, '2024-06-04 16:30:00', '16:30:00', '17:00:00', '2024-05-31 20:32:01', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-06-01 00:32:01', '2024-06-06 03:56:12'),
	('55b06bfd-4c95-4de5-b708-56c0bb31890a', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 12, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:35:05', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 20:35:05', '2024-05-31 20:35:05'),
	('5c8dff33-e6d0-4a75-87ee-84cdf265a1c8', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 14, '2024-06-06 16:30:00', '16:30:00', '17:00:00', '2024-05-31 20:14:41', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'ACEPTADO', '2024-06-01 00:14:41', '2024-06-09 18:14:10'),
	('6252af59-52c0-44cc-8af0-8d4fdec7421c', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 15:52:10', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'PENDIENTE', '2024-05-31 19:52:10', '2024-05-31 19:52:10'),
	('62f59fe2-28b0-4eee-b6f8-1c5381b2f533', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 6, '2024-06-12 16:30:00', '16:30:00', '17:00:00', '2024-05-31 20:17:57', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'CANCELADO', '2024-06-01 00:17:57', '2024-06-11 15:31:05'),
	('6365d385-b59e-44fe-a0a3-66e1b154e33d', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-11 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:52:20', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'CANCELADO', '2024-05-31 23:52:20', '2024-06-09 19:41:02'),
	('67a44c15-ac3a-4c22-bfaa-f95536738b65', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:04:29', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'CANCELADO', '2024-05-31 20:04:29', '2024-06-11 15:32:51'),
	('729f028c-73cd-4dce-9ab9-75ac8af828ab', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 6, '2024-06-12 16:30:00', '16:30:00', '17:00:00', '2024-05-31 20:28:44', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'ACEPTADO', '2024-06-01 00:28:44', '2024-06-11 16:10:33'),
	('80dca888-dc3e-468e-9fb4-b2953421ea2e', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d", "46f460de-2da8-4ce8-8ffe-5a646073e95a"]', 45, '2024-06-20 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:02:55', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M", "1"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 23:02:55', '2024-05-31 23:02:55'),
	('817bad04-746f-457f-b3c0-5d856a7078b5', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 24, '2024-06-27 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:10:15', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'PENDIENTE', '2024-05-31 20:10:15', '2024-05-31 20:10:15'),
	('8a3ead27-febf-411c-ac09-8d5f9b8500c0', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 34, '2024-06-27 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:24:06', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'PENDIENTE', '2024-05-31 20:24:06', '2024-05-31 20:24:06'),
	('8adb44d0-8a85-4e74-9443-8bf3d47a83c3', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 290, '2024-06-21 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:20:03', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'PENDIENTE', '2024-05-31 20:20:03', '2024-05-31 20:20:03'),
	('8d4f1154-2d2b-4aba-a605-f77b54bc92d5', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 12, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:52:54', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 20:52:54', '2024-05-31 20:52:54'),
	('8dcb3f24-0860-4cb1-b045-0f8a36f86d4d', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 12, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:40:09', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 23:40:09', '2024-05-31 23:40:09'),
	('8e3e9204-60d3-461b-bb11-923b717048eb', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d", "007ff40d-5105-47d1-9744-82a199a8436f", "039c16c5-4de9-48d6-8238-f24e657c5eb6"]', 1, '2024-06-06 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:48:43', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M", "1", "4"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'ACEPTADO', '2024-05-31 23:48:43', '2024-06-09 18:16:52'),
	('9351acc4-7cef-4c02-aa09-51cdf6906fef', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 45, '2024-06-14 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:18:04', 'Examen 2da instancia', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'CANCELADO', '2024-05-31 20:18:04', '2024-06-11 16:08:29'),
	('93d18237-2ac3-4306-b96b-b75d0122ad84', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 4, '2024-07-04 16:30:00', '16:30:00', '17:00:00', '2024-05-31 18:56:21', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 22:56:21', '2024-05-31 22:56:21'),
	('952a417c-0b32-4776-9b69-9d748eefc79c', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 18, '2024-06-21 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:42:33', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'PENDIENTE', '2024-05-31 23:42:33', '2024-05-31 23:42:33'),
	('980f1f13-9f1a-4181-8593-25e278c27310', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 12, '2024-06-26 16:30:00', '16:30:00', '17:00:00', '2024-06-05 22:47:47', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '[null]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-06-06 02:47:47', '2024-06-06 02:47:47'),
	('99e4a1f9-f476-49ce-b62d-614f6cf43f99', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:31:11', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'CANCELADO', '2024-05-31 23:31:11', '2024-06-11 12:45:52'),
	('9d39fe05-9485-4414-a5bf-e32ba6d05392', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 15:59:51', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-05-31 19:59:51', '2024-06-09 18:42:18'),
	('9daea5a2-6a08-4c33-af77-d9bf85f78000', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 22, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 17:19:10', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'PENDIENTE', '2024-05-31 21:19:10', '2024-05-31 21:19:10'),
	('9e1e3798-7481-4b22-9954-e4249068e77d', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-05-29 16:30:00', '16:30:00', '17:00:00', '2024-05-28 22:28:32', 'Examen parcial', '"{\\"URGENTE\\":\\"Razon de la docente\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'ACEPTADO', '2024-05-29 02:28:32', '2024-06-10 01:09:36'),
	('9edee4f0-794c-45db-bb49-72283075beca', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 4, '2024-06-04 16:30:00', '16:30:00', '17:00:00', '2024-05-31 21:03:56', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-06-01 01:03:56', '2024-06-05 16:58:18'),
	('9f8c7c12-5a4d-4d72-8d9b-14a3b2c6e5ab', '{"id1": "22daa7a1-81d4-49ce-ae01-44d10201b837"}', 30, '2024-05-20 20:15:00', '20:15:00', '21:45:00', '2024-05-14 11:09:07', 'Examen auxiliar', '{"URGENTE": "Estoy mintiendo"}', 2008054, '{"grupo1": 13}', '77b4c945-39af-4ad1-9109-1947f2bd1847', 'CANCELADO', NULL, NULL),
	('a4be1a50-cdd1-4cd1-a1cf-5288fbdcd99a', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 15, '2024-06-20 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:21:17', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-05-31 20:21:17', '2024-06-09 19:16:12'),
	('a8dbece7-ea32-446a-abae-cdb02b005181', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:08:34', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'CANCELADO', '2024-05-31 20:08:34', '2024-06-11 16:01:11'),
	('adfc0d65-ec50-42c8-9b2e-abc82c23b556', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 98, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:50:59', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 23:50:59', '2024-05-31 23:50:59'),
	('bff1ede3-5f34-48b7-8de9-f9c603a1ce8d', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 4, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:43:49', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'PENDIENTE', '2024-05-31 23:43:49', '2024-05-31 23:43:49'),
	('c11b1e77-d49b-4b24-a481-858f1739b517', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 29, '2024-06-28 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:54:37', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 23:54:37', '2024-05-31 23:54:37'),
	('c848bd22-9c9d-401d-9710-89dc34ac5903', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d", "2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d", "c7460556-b09c-4b10-8460-05e6183e4e42"]', 12, '2024-06-26 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:12:08', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M", "1", "1"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 23:12:08', '2024-05-31 23:12:08'),
	('d3796064-bc83-4ea3-866a-f68ab47e3e5a', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 29, '2024-06-03 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:32:18', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-05-31 23:32:18', '2024-06-05 16:23:55'),
	('d43ec0ad-5a01-4f3e-8daa-0e4f02954f79', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-05-29 16:30:00', '16:30:00', '17:00:00', '2024-05-28 22:32:43', 'Examen parcial', '"{\\"URGENTE\\":\\"Razon de la docente\\"}"', 2006018, '["M"]', '157fb7c2-97f6-4300-b9b2-d6dbb97b1b04', 'ACEPTADO', '2024-05-29 02:32:43', '2024-06-05 16:20:08'),
	('d4c9ef0e-f012-495e-adea-055a7ac7209a', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 12, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:35:21', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'PENDIENTE', '2024-05-31 23:35:21', '2024-05-31 23:35:21'),
	('d6473fcf-7553-40f4-9d50-e61e2be85acf', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 56, '2024-06-27 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:22:22', 'Examen 2da instancia', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'PENDIENTE', '2024-05-31 20:22:22', '2024-05-31 20:22:22'),
	('d8583ed0-0951-4e7d-a63e-4a1188a3d652', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 24, '2024-06-06 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:34:13', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-05-31 23:34:13', '2024-06-10 01:11:35'),
	('dbdae2bb-b725-45a8-9f9b-1f5c1086927e', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 32, '2024-06-07 16:30:00', '16:30:00', '17:00:00', '2024-05-31 19:30:22', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f82530b9-9e02-4a7f-81be-0642303812db', 'ACEPTADO', '2024-05-31 23:30:22', '2024-06-10 01:25:55'),
	('e0ae3da0-1ddf-4384-a400-58c52aed2243', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 13, '2024-06-05 16:30:00', '16:30:00', '17:00:00', '2024-05-29 00:29:35', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'ACEPTADO', '2024-05-29 04:29:35', '2024-06-05 16:52:52'),
	('e2ee8d64-f56d-4faa-bd7e-7bfcec88ecde', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 13, '2024-06-20 16:30:00', '16:30:00', '17:00:00', '2024-06-05 23:31:05', 'Examen final', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '[null]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'PENDIENTE', '2024-06-06 03:31:05', '2024-06-06 03:31:05'),
	('ea30ce83-98e0-49de-aa4f-40f47e254343', '["46f460de-2da8-4ce8-8ffe-5a646073e95a"]', 13, '2024-06-19 11:15:00', '11:15:00', '12:45:00', '2024-06-11 12:12:32', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '[null]', '8b2c60a7-b88b-4825-b4a5-1e43924f85c7', 'PENDIENTE', '2024-06-11 16:12:32', '2024-06-11 16:12:32'),
	('ef228f43-a121-469a-b1ab-079d5d329e4a', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 123, '2024-06-18 16:30:00', '16:30:00', '17:00:00', '2024-06-05 23:46:12', 'Examen parcial', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '[null]', '136eedd3-f082-42c0-aacd-0063d5f3562f', 'ACEPTADO', '2024-06-06 03:46:12', '2024-06-11 17:30:25'),
	('f47ac10b-58cc-4372-a567-0e02b2c3d479', '{"id1": "039c16c5-4de9-48d6-8238-f24e657c5eb6", "id2": "c34627f2-6dec-4853-a50c-614af0e17e66"}', 150, '2024-05-27 14:30:00', '14:30:00', '15:30:00', '2024-05-14 16:19:07', 'Examen de mesa', '{"NORMAL": "Ninguno"}', 2010008, '{"grupo1": 2, "grupo2": 4}', '0638f3f0-2c69-4e31-a5a3-f5d84ce82f17', 'ACEPTADO', NULL, '2024-05-29 19:24:46'),
	('f86dd2b7-bb96-4bda-8288-21e86d3c66b4', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 23, '2024-06-19 16:30:00', '16:30:00', '17:00:00', '2024-05-31 20:30:45', 'Examen de mesa', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'ACEPTADO', '2024-06-01 00:30:45', '2024-06-10 01:16:13'),
	('f86e4d5c-729b-4358-a094-3facecaf862c', '["354db6b6-be0f-4aca-a9ea-3c31e412c49d"]', 29, '2024-06-28 16:30:00', '16:30:00', '17:00:00', '2024-05-31 16:13:42', 'Examen 2da instancia', '"{\\"NORMAL\\":\\"Normal\\"}"', 2006018, '["M"]', 'f2433f5a-3285-4ffb-b9b2-c890141fa144', 'CANCELADO', '2024-05-31 20:13:42', '2024-06-09 19:40:25');

-- Volcando estructura para tabla reservas_tis.solicitudes
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grupo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_estudiantes` int NOT NULL,
  `motivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `modo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aula` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `horario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_DOCENTE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hInicio` time DEFAULT NULL,
  `hFin` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.solicitudes: ~23 rows (aproximadamente)
DELETE FROM `solicitudes`;
INSERT INTO `solicitudes` (`id`, `nombre`, `nombre1`, `nombre2`, `nombre3`, `nombre4`, `nombre5`, `materia`, `grupo`, `cantidad_estudiantes`, `motivo`, `modo`, `razon`, `aula`, `fecha`, `horario`, `estado`, `ID_DOCENTE`, `hInicio`, `hFin`, `created_at`, `updated_at`) VALUES
	(1, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2', 12, 'Examen Mesa', 'Urgente', NULL, '691A', '2024-05-01', '15:45 PM - 16:15 PM', 'Cancelado', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '11:15:00', '12:45:51', '2024-03-30 13:00:31', '2024-05-01 14:11:27'),
	(2, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '1', 2, 'Examen Parcial', 'Urgente', 'Porque si', '691B', '2024-05-16', '15:45 PM - 16:15 PM', 'Reservado', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51', '2024-03-30 13:02:04', '2024-05-02 10:23:32'),
	(3, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '2', 2, 'Examen Parcial', 'Normal', NULL, '691C', '2024-05-10', '15:45 PM - 16:15 PM', 'Solicitando', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:51', '2024-03-30 13:04:58', '2024-03-30 13:04:58'),
	(4, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '2', 2, 'Examen Parcial', 'Normal', NULL, '691D', '2024-05-16', '15:45 PM - 16:15 PM', 'Cancelado', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:50', '2024-03-30 13:05:51', '2024-03-31 14:15:30'),
	(5, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'PROBABILIDAD Y ESTADISTICA I', '2', 2, 'Examen Parcial', 'Normal', NULL, '692A', '2024-05-17', '15:45 PM - 16:15 PM', 'Solicitando', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '11:15:00', '12:45:00', '2024-03-30 13:06:14', '2024-04-30 13:06:14'),
	(6, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'GEOMETRIA', '2,3,4', 2, 'Examen Parcial', 'urgente', NULL, '692B', '2024-05-18', '15:45 PM - 16:15 PM', 'Reservado', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:50', '2024-03-30 13:10:12', '2024-05-02 13:10:12'),
	(7, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'GEOMETRIA', '2', 2, 'Examen Parcial', 'Normal', NULL, '692C', '2024-05-20', '15:45 PM - 16:15 PM', 'Solicitando', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '11:15:00', '12:45:00', '2024-03-30 13:18:54', '2024-03-30 13:18:54'),
	(8, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'GEOMETRIA', '2', 2, 'Examen Parcial', 'Urgente', NULL, '692D', '2024-05-21', '15:45 PM - 16:15 PM', 'Cancelado', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:50', '2024-03-30 13:20:06', '2024-03-31 14:17:19'),
	(9, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2', 2, 'Examen Parcial', 'Urgente', NULL, '692E', '2024-05-22', '15:45 PM - 16:15 PM', 'Solicitando', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '11:15:00', '12:45:00', '2024-03-30 13:22:11', '2024-06-01 13:22:11'),
	(10, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2,4,5', 12, 'Examen Mesa', 'Urgente', 'Porque es urgente', '693A', '2024-05-28', '15:45 PM - 16:15 PM', 'Cancelado', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', '15:45:00', '18:45:50', '2024-03-31 03:10:04', '2024-05-31 14:15:52'),
	(11, 'SORUCO MAITA JOSE ANTONIO', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2,3', 12, 'Examen Mesa', 'Normal', NULL, '693B', '2024-05-15', '16:30 PM - 17:00 PM', 'Solicitando', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '11:15:00', '12:45:00', '2024-03-31 06:47:12', '2024-03-31 06:47:12'),
	(12, 'SORUCO MAITA JOSE ANTONIO', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2,3', 12, 'Examen Mesa', 'Urgente', NULL, '693C', '2024-05-18', '16:30 PM - 17:00 PM', 'Reservado', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '15:45:00', '18:45:50', '2024-03-31 06:47:43', '2024-03-31 06:47:43'),
	(13, 'SORUCO MAITA JOSE ANTONIO', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '2', 2, 'Examen Parcial', 'Normal', NULL, '693D', '2024-05-14', '15:45 PM - 16:15 PM', 'Solicitando', '2b4d3c2f-09f2-4c2b-95d2-8d355afa5e4d', '11:15:00', '12:45:00', '2024-03-31 06:48:46', '2024-03-31 06:48:46'),
	(14, 'ZURITA ORELLANA RIMER MAURICIO', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '2', 3, 'Examen Mesa', 'Urgente', NULL, '691D', '2024-05-18', '16:30 PM - 17:00 PM', 'Solicitando', '34d07248-6027-4a4c-986e-2f882cadbb34', '14:15:00', '15:45:50', '2024-03-31 06:52:02', '2024-03-31 06:52:02'),
	(15, 'ZURITA ORELLANA RIMER MAURICIO', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2', 4, 'Examen Mesa', 'Normal', NULL, '691C', '2024-05-30', '15:45 PM - 16:15 PM', 'Solicitando', '34d07248-6027-4a4c-986e-2f882cadbb34', '14:15:00', '15:45:50', '2024-03-31 06:53:18', '2024-03-31 06:53:18'),
	(16, 'RELOS PACO SANTIAGO', NULL, NULL, NULL, NULL, NULL, 'GEOMETRIA', '2', 4, 'Examen Parcial', 'Normal', NULL, '691A', '2024-05-29', '15:45 PM - 16:15 PM', 'Reservado', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '14:15:00', '15:45:50', '2024-03-31 06:53:25', '2024-03-31 06:53:25'),
	(17, 'RELOS PACO SANTIAGO', NULL, NULL, NULL, NULL, NULL, 'PROBABILIDAD Y ESTADISTICA I', '2', 4, 'Examen Mesa', 'Urgente', NULL, '693B', '2024-05-19', '15:45 PM - 16:15 PM', 'Solicitando', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '11:15:00', '12:45:00', '2024-03-31 06:56:28', '2024-03-31 06:56:28'),
	(18, 'RELOS PACO SANTIAGO', NULL, NULL, NULL, NULL, NULL, 'ALGEBRA LINEAL', '2', 2, 'Examen Mesa', 'Normal', NULL, '691G', '2024-05-18', '15:45 PM - 16:15 PM', 'Cancelalo', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '14:15:00', '15:45:50', '2024-03-31 06:58:28', '2024-03-31 06:58:28'),
	(19, 'RELOS PACO SANTIAGO', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '2', 2, 'Examen Parcial', 'Normal', NULL, '691C', '2024-05-18', '15:45 PM - 16:15 PM', 'Solicitando', '4a72b14b-9529-4aa9-83fa-ebb55a210e82', '11:15:00', '12:45:00', '2024-03-31 07:01:12', '2024-03-31 07:01:12'),
	(24, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '1', 34, 'Examen 2da instancia', 'Normal', NULL, '61B', '2024-05-20', '16:30 PM - 17:00 PM', 'cancelado', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', NULL, NULL, '2024-05-15 16:49:39', '2024-05-15 17:05:01'),
	(25, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '1', 34, 'Examen 2da instancia', 'Normal', NULL, '61B', '2024-05-20', '16:30 PM - 17:00 PM', 'Solicitando', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', NULL, NULL, '2024-05-15 16:51:07', '2024-05-15 16:51:07'),
	(26, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '1', 34, 'Examen 2da instancia', 'Normal', NULL, '61B', '2024-05-20', '16:30 PM - 17:00 PM', 'Solicitando', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', NULL, NULL, '2024-05-15 16:51:48', '2024-05-15 16:51:48'),
	(27, 'TORRICO TROCHE MILKA MONICA', 'ruiz ivan', NULL, NULL, NULL, NULL, 'FISICA BASICA I', '1,3,5', 67, 'Examen 2da instancia', 'Normal', NULL, '61B', '2024-05-20', '16:30 PM - 17:00 PM', 'Solicitando', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', NULL, NULL, '2024-05-15 16:53:20', '2024-05-15 16:53:20'),
	(28, 'TORRICO TROCHE MILKA MONICA', NULL, NULL, NULL, NULL, NULL, 'FISICA BASICA I', '1', 34, 'Examen 2da instancia', 'Normal', NULL, '61B', '2024-05-20', '16:30 PM - 17:00 PM', 'cancelado', '354db6b6-be0f-4aca-a9ea-3c31e412c49d', NULL, NULL, '2024-05-15 16:54:14', '2024-05-15 17:04:36');

-- Volcando estructura para tabla reservas_tis.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ID_DOCENTE` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_docente_foreign` (`ID_DOCENTE`),
  CONSTRAINT `users_id_docente_foreign` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docente` (`ID_DOCENTE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla reservas_tis.users: ~1 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `cargo`, `remember_token`, `created_at`, `updated_at`, `ID_DOCENTE`) VALUES
	(1, 'admin', 'admin@jatun.code.com', NULL, 'Cond@tr3m4r$', 'admin', NULL, NULL, NULL, NULL),
	(2, 'Raul', 'jatun@code.com', NULL, '$2y$10$wlQa5KkLAMl28yoDbfdYq.LNumV7EVE41rE7Xgwv7yR38a6./Lhz6', 'admin', NULL, '2024-06-03 23:57:26', '2024-06-03 23:57:26', NULL),
	(3, 'Alguine', 'nombre@jatun.code.com', NULL, '$2y$10$TJtHQS33YhIdbOefDHXd8O.ldElm1R/J3y3NFuCuhXkBS4bKrfRBG', 'admin', NULL, '2024-06-05 16:44:49', '2024-06-05 16:44:49', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
