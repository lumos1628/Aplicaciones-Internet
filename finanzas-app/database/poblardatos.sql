-- =============================================
-- Script para poblar base de datos 'finanzas_lab13'
-- 1000 registros por tabla
-- Ejecutar DESPUES de: php artisan migrate
-- =============================================

USE finanzas_lab13;

-- ======================
-- 1. CONSUMIDORES
-- ======================
DELIMITER //

CREATE PROCEDURE populate_consumidores()
BEGIN
    DECLARE i INT DEFAULT 1;
    WHILE i <= 1000 DO
        INSERT INTO consumidores (nombre, email)
        VALUES (
            CONCAT('Consumidor ', i),
            CONCAT('consumidor', i, '@example.com')
        );
        SET i = i + 1;
    END WHILE;
END //

DELIMITER ;

CALL populate_consumidores();
DROP PROCEDURE IF EXISTS populate_consumidores;

-- ======================
-- 2. INGRESOS
-- ======================
DELIMITER //

CREATE PROCEDURE populate_ingresos()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE max_id INT;
    SELECT MAX(id) INTO max_id FROM consumidores;
    
    WHILE i <= 1000 DO
        INSERT INTO ingresos (consumidorId, monto, fecha, descripcion)
        VALUES (
            FLOOR(1 + RAND() * max_id),
            ROUND(100 + RAND() * 5000, 2),
            DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 730) DAY),
            CONCAT('Ingreso aleatorio #', i)
        );
        SET i = i + 1;
    END WHILE;
END //

DELIMITER ;

CALL populate_ingresos();
DROP PROCEDURE IF EXISTS populate_ingresos;

-- ======================
-- 3. GASTOS
-- ======================
DELIMITER //

CREATE PROCEDURE populate_gastos()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE max_id INT;
    SELECT MAX(id) INTO max_id FROM consumidores;
    
    WHILE i <= 1000 DO
        INSERT INTO gastos (consumidorId, monto, fecha, categoria, descripcion)
        VALUES (
            FLOOR(1 + RAND() * max_id),
            ROUND(20 + RAND() * 1500, 2),
            DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 730) DAY),
            ELT(FLOOR(1 + RAND()*8), 
                'Alimentación', 'Transporte', 'Vivienda', 
                'Entretenimiento', 'Salud', 'Educación', 
                'Servicios', 'Otros'),
            CONCAT('Gasto aleatorio #', i)
        );
        SET i = i + 1;
    END WHILE;
END //

DELIMITER ;

CALL populate_gastos();
DROP PROCEDURE IF EXISTS populate_gastos;

-- Verificar resultados
SELECT 'consumidores' AS tabla, COUNT(*) AS total FROM consumidores
UNION ALL
SELECT 'ingresos', COUNT(*) FROM ingresos
UNION ALL
SELECT 'gastos', COUNT(*) FROM gastos;
