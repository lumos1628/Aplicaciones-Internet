-- =============================================
-- INSERTAR 50 NUEVOS CONSUMIDORES + INGRESOS + GASTOS
-- Pegar todo en DBeaver y ejecutar
-- =============================================

USE finanzas_lab13;

-- ======================
-- 50 CONSUMIDORES NUEVOS (id 1001 al 1050)
-- ======================
DELIMITER //

CREATE PROCEDURE populate_50_consumidores()
BEGIN
    DECLARE i INT DEFAULT 1001;
    WHILE i <= 1050 DO
        INSERT INTO consumidores (nombre, email, created_at, updated_at)
        VALUES (
            CONCAT('Consumidor ', i),
            CONCAT('consumidor', i, '@example.com'),
            NOW(),
            NOW()
        );
        SET i = i + 1;
    END WHILE;
END //

DELIMITER ;

CALL populate_50_consumidores();
DROP PROCEDURE IF EXISTS populate_50_consumidores;

-- ======================
-- 50 INGRESOS PARA LOS NUEVOS
-- ======================
DELIMITER //

CREATE PROCEDURE populate_50_ingresos()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE max_id INT;
    SELECT MAX(id) INTO max_id FROM consumidores;
    
    WHILE i <= 50 DO
        INSERT INTO ingresos (consumidorId, monto, fecha, descripcion, created_at, updated_at)
        VALUES (
            FLOOR(1001 + RAND() * (max_id - 1000)),
            ROUND(100 + RAND() * 5000, 2),
            DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 730) DAY),
            CONCAT('Ingreso aleatorio #', i + 1000),
            NOW(),
            NOW()
        );
        SET i = i + 1;
    END WHILE;
END //

DELIMITER ;

CALL populate_50_ingresos();
DROP PROCEDURE IF EXISTS populate_50_ingresos;

-- ======================
-- 50 GASTOS PARA LOS NUEVOS
-- ======================
DELIMITER //

CREATE PROCEDURE populate_50_gastos()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE max_id INT;
    SELECT MAX(id) INTO max_id FROM consumidores;
    
    WHILE i <= 50 DO
        INSERT INTO gastos (consumidorId, monto, fecha, categoria, descripcion, created_at, updated_at)
        VALUES (
            FLOOR(1001 + RAND() * (max_id - 1000)),
            ROUND(20 + RAND() * 1500, 2),
            DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 730) DAY),
            ELT(FLOOR(1 + RAND()*8), 
                'Alimentación', 'Transporte', 'Vivienda', 
                'Entretenimiento', 'Salud', 'Educación', 
                'Servicios', 'Otros'),
            CONCAT('Gasto aleatorio #', i + 1000),
            NOW(),
            NOW()
        );
        SET i = i + 1;
    END WHILE;
END //

DELIMITER ;

CALL populate_50_gastos();
DROP PROCEDURE IF EXISTS populate_50_gastos;

-- ======================
-- VERIFICAR TOTALES
-- ======================
SELECT 'consumidores' AS tabla, COUNT(*) AS total FROM consumidores
UNION ALL
SELECT 'ingresos', COUNT(*) FROM ingresos
UNION ALL
SELECT 'gastos', COUNT(*) FROM gastos;
