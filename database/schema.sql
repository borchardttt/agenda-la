-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS `agenda_la`;
USE `agenda_la`;

-- Criação da tabela `users`
CREATE TABLE IF NOT EXISTS `users` (
`id` INT AUTO_INCREMENT NOT NULL UNIQUE,
`name` VARCHAR(255) NOT NULL,
`email` VARCHAR(255) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`type` ENUM('client', 'barber', 'admin') NOT NULL,
`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
);

-- Inserção do usuário administrador
INSERT INTO `users` (`name`, `email`, `password`, `type`)
VALUES ('Administrador Agenda-La', 'adming@agendala.com', SHA2('admin2024', 256), 'admin');

INSERT INTO `users` (`name`, `email`, `password`, `type`)
VALUES ('João', 'joao@agendala.com', SHA2('barbeiroJoao', 256), 'barber');


-- Criação da tabela `barbers_schedules` (agendamentos de barbeiros)
CREATE TABLE IF NOT EXISTS `barbers_schedules` (
`id` INT AUTO_INCREMENT NOT NULL UNIQUE,
`barber_id` INT NOT NULL,
`week_days` INT NOT NULL, -- 1 a 7 representando os dias da semana (1=Segunda-feira, 7=Domingo)
`initial_hour` INT NOT NULL, -- Hora de início (formato 24h)
`final_hour` INT NOT NULL, -- Hora de término (formato 24h)
PRIMARY KEY (`id`)
);

-- Criação da tabela `services` (serviços disponíveis)
CREATE TABLE IF NOT EXISTS `services` (
`id` INT AUTO_INCREMENT NOT NULL UNIQUE,
`name` VARCHAR(255) NOT NULL,
`price` INT NOT NULL, -- Preço do serviço
`time` INT NOT NULL, -- Tempo do serviço em minutos
PRIMARY KEY (`id`)
);

-- Inserção dos serviços
INSERT INTO `services` (`name`, `price`, `time`)
VALUES
('Corte Americano', 30, 40),
('Corte do Jaca', 30, 40),
('MoicaTrem', 35, 45),
('Platinado', 100, 95);

-- Criação da tabela `scheduling` (agendamentos dos clientes)
CREATE TABLE IF NOT EXISTS `scheduling` (
`id` INT AUTO_INCREMENT NOT NULL UNIQUE,
`client_id` INT NOT NULL,
`barber_id` INT NOT NULL,
`service_id` INT NOT NULL,
`date` DATETIME NOT NULL, -- Data e hora do agendamento
`status` ENUM('pending', 'confirmed', 'canceled') NOT NULL, -- Status do agendamento
`disapproval_justification` VARCHAR(255) NOT NULL, -- Justificativa de desaprovação (se houver)
PRIMARY KEY (`id`)
);

-- Adicionando as chaves estrangeiras
ALTER TABLE `barbers_schedules`
ADD CONSTRAINT `barbers_schedules_fk1` FOREIGN KEY (`barber_id`) REFERENCES `users`(`id`);

ALTER TABLE `scheduling`
ADD CONSTRAINT `scheduling_fk1` FOREIGN KEY (`client_id`) REFERENCES `users`(`id`);

ALTER TABLE `scheduling`
ADD CONSTRAINT `scheduling_fk2` FOREIGN KEY (`barber_id`) REFERENCES `users`(`id`);

ALTER TABLE `scheduling`
ADD CONSTRAINT `scheduling_fk3` FOREIGN KEY (`service_id`) REFERENCES `services`(`id`);
