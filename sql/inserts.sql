INSERT INTO clientes (nombre) VALUES
('Juan'),
('Carlos'),
('Maria'),
('Daniel'),
('Andres');

INSERT INTO cuentas (numero_cuenta, saldo, cliente_id) VALUES
('100001', 1000, 1),
('100002', 1000, 2),
('100003', 1000, 3),
('100004', 1000, 4),
('100005', 1000, 5);

INSERT INTO usuarios (cuenta_id, clave_hash) VALUES
(1, '$2b$10$c1hDy2YemNWU1hiys28K..K0FyE3NA3AWWpI3/S0biOcbXZpCYY7m'),
(2, '$2b$10$/yeM2xiLVt5dVhyHZI9QbOkiyYn7dy6V7g6JjfDCES8LrRd1QYmbW'),
(3, '$2b$10$crp0uQtqubvsF0RbXTE/Ueiz01j0TgOBn4gfsVnyQ3HQ0VqwTgxMq'),
(4, '$2b$10$xyop.q9didUUHKp/KPSbtO/tBib0DB0OmsxPJP8jNROv.Li0KxHlK'),
(5, '$2b$10$2IUIURpVhKoa.vEy1QWRlOMcuoNHKOog/h9EpSeJpOBQhHyehTPSm');

