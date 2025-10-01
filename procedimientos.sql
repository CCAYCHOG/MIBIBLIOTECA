------------------------------------------------------------------------------
-- PROCEDIMIENTOS PARA AUTORES
------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE `BIB_ActualizarAutor`(
    IN `p_IdAutor` INT, 
    IN `p_Nombre` VARCHAR(100), 
    IN `p_Apellido` VARCHAR(100), 
    IN `p_Nacionalidad` INT, 
    IN `p_FechaNacimiento` DATE, 
    IN `p_Estado` TINYINT, 
    IN `p_UsuarioModifica` INT, 
    IN `p_IpModifica` VARCHAR(50)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- En caso de error, revertimos la transacción
        ROLLBACK;
        SELECT
            500 AS Codigo,
            'error' AS Tipo,
            'Ocurrió un error al actualizar el autor' AS Mensaje;
    END;

    START TRANSACTION;

    UPDATE BIB_Autor
    SET Nombre          = p_Nombre,
        Apellido        = p_Apellido,
        Nacionalidad    = p_Nacionalidad, -- ahora es INT
        FechaNacimiento = p_FechaNacimiento,
        Estado          = p_Estado,
        UsuarioEdita    = p_UsuarioModifica,
        IpEdita         = p_IpModifica,   -- corregido
        FechaEdita      = NOW()
    WHERE IdAutor = p_IdAutor;

    -- Validar si realmente se actualizó algún registro
    IF ROW_COUNT() = 0 THEN
        ROLLBACK;
        SELECT
            404 AS Codigo,
            'warning' AS Tipo,
            'No se encontró el autor con el Id especificado' AS Mensaje;
    ELSE
        COMMIT;
        SELECT
            200 AS Codigo,
            'success' AS Tipo,
            'Autor actualizado correctamente' AS Mensaje;
    END IF;

END$$
DELIMITER ;

DELIMITER $$
 CREATE PROCEDURE `BIB_BuscarPaises`(IN `p_Nombre` VARCHAR(100))
BEGIN
    SELECT IdPais, Nombre 
FROM BIB_Paises
WHERE Nombre COLLATE utf8mb4_general_ci 
      LIKE CONCAT('%', p_Nombre, '%') COLLATE utf8mb4_general_ci 
    ORDER BY Nombre ASC
    LIMIT 10;
END$$
DELIMITER ;

DELIMITER $$
 CREATE PROCEDURE `BIB_ContarAutoresActivos`()
BEGIN
DECLARE vCantidad INT;

    -- Contar los autores activos
    SELECT COUNT(*) INTO vCantidad
    FROM BIB_Autor
    WHERE Estado = 1;

    -- Respuesta estándar
    SELECT 
        200 AS Codigo,
        'success' AS Tipo,
        CONCAT('Cantidad de autores activos: ', vCantidad) AS Mensaje,
        vCantidad AS Datos;
END$$
DELIMITER ;

DELIMITER $$
 CREATE PROCEDURE `BIB_EliminarAutorPorId`(IN `p_IdAutor` INT, IN `p_UsuarioElimina` INT, IN `p_IpElimina` VARCHAR(50))
BEGIN
    DECLARE v_rows INT DEFAULT 0;

    UPDATE BIB_Autor
    SET Estado = 0,
        UsuarioElimina = p_UsuarioElimina,
        FechaElimina = NOW(),
        IpElimina = p_IpElimina
    WHERE IdAutor = p_IdAutor
      AND Estado <> 0;

    SET v_rows = ROW_COUNT();

    IF v_rows > 0 THEN
        SELECT 200 AS Codigo,
               'success' AS Tipo,
               'Autor eliminado correctamente' AS Mensaje;
    ELSE
        SELECT 404 AS Codigo,
               'error' AS Tipo,
               'Autor no encontrado o ya eliminado' AS Mensaje;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
 CREATE PROCEDURE `BIB_ObtenerAutorPorId`(IN `p_IdAutor` INT)
BEGIN
    SELECT 
    A.Apellido,
    A.Estado,
    A.FechaEdita,
    A.FechaNacimiento,
    A.FechaRegistra,
    A.IpEdita,
    A.IpRegistra,
P.IdPais,
    P.Nombre AS Nacionalidad,
    A.Nombre,
    A.UsuarioEdita,
    A.UsuarioRegistra
FROM BIB_Autor A
INNER JOIN BIB_Paises P ON P.IdPais = A.Nacionalidad
WHERE A.IdAutor = p_IdAutor
  AND A.Estado = 1;
END$$
DELIMITER ;

DELIMITER $$
 CREATE PROCEDURE `BIB_ObtenerAutoresActivos`(IN `pInicio` INT, IN `pCantidad` INT, IN `pFiltro` VARCHAR(100))
BEGIN
    -- Solo autores con estado = 1 (activos)
    SELECT 
    A.IdAutor,
    A.Nombre,
    A.Apellido,
    P.Nombre AS Nacionalidad,
A.FechaNacimiento,
    A.Estado,
    A.UsuarioRegistra,
    A.FechaRegistra,
    A.IpRegistra,
    A.UsuarioEdita,
    A.FechaEdita,
    A.IpEdita
FROM BIB_Autor A
INNER JOIN BIB_Paises P ON P.IdPais = A.Nacionalidad
WHERE A.Estado = 1 AND (A.Nombre LIKE CONCAT('%', pFiltro, '%') 
          OR A.Apellido LIKE CONCAT('%', pFiltro, '%')
      ) 
ORDER BY A.Apellido, A.Nombre
LIMIT pCantidad OFFSET pInicio;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `BIB_RegistrarAutor`(IN `nombre_autor` VARCHAR(100), IN `apellido_autor` VARCHAR(100), IN `nacionalidad_autor` INT, IN `fnacimiento_autor` DATE, IN `estado_autor` CHAR(1), IN `usuario` VARCHAR(50), IN `ipusuario` VARCHAR(50))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- En caso de error, revertimos la transacción
        ROLLBACK;
        SELECT
        	500 AS Codigo,
            'error' AS Tipo,
            'Ocurrió un error al registrar el autor' AS Mensaje,
NULL AS Datos;
    END;
    START TRANSACTION;
    INSERT INTO BIB_Autor (
        Nombre,
        Apellido,
        Nacionalidad,
        FechaNacimiento,
        Estado,
        UsuarioRegistra,
        IPRegistra,
        FechaRegistra
    )
    VALUES (
        nombre_autor,
        apellido_autor,
        nacionalidad_autor,
        fnacimiento_autor,
        estado_autor,
        usuario,
        ipusuario,
        NOW()
    );
SET @nuevoId = LAST_INSERT_ID();
    COMMIT;
    -- Mensaje de éxito
    SELECT 
        200 AS Codigo, 
        'success' AS Tipo, 
        'Autor registrado correctamente' AS Mensaje, @nuevoId AS Datos;
END$$
DELIMITER ;

------------------------------------------------------------------------------
-- PROCEDIMIENTOS PARA EDITORIALES
------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE `BIB_ActualizarEditorial`(
    IN `p_IdEditorial` INT,
    IN `p_Nombre` VARCHAR(150),
    IN `p_Direccion` VARCHAR(250),
    IN `p_Telefono` VARCHAR(50),
    IN `p_Email` VARCHAR(100),
    IN `p_Estado` TINYINT,
    IN `p_UsuarioModifica` INT,
    IN `p_IPModifica` VARCHAR(50)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Si ocurre un error, revertimos la transacción
        ROLLBACK;
        SELECT
            500 AS Codigo,
            'error' AS Tipo,
            'Ocurrió un error al actualizar la editorial' AS Mensaje;
    END;

    START TRANSACTION;

    UPDATE BIB_Editorial
    SET Nombre       = p_Nombre,
        Direccion    = p_Direccion,
        Telefono     = p_Telefono,
        Email        = p_Email,
        Estado       = p_Estado,
        UsuarioEdita = p_UsuarioModifica,
        IpEdita      = p_IPModifica,
        FechaEdita   = NOW()
    WHERE IdEditorial = p_IdEditorial;

    -- Verificamos si realmente se actualizó algún registro
    IF ROW_COUNT() = 0 THEN
        ROLLBACK;
        SELECT
            404 AS Codigo,
            'warning' AS Tipo,
            'No se encontró la editorial con el Id especificado' AS Mensaje;
    ELSE
        COMMIT;
        SELECT
            200 AS Codigo,
            'success' AS Tipo,
            'Editorial actualizada correctamente' AS Mensaje;
    END IF;

END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `BIB_ContarEditorialesActivas`()
BEGIN
    DECLARE vCantidad INT;

    -- Contar las editoriales activas
    SELECT COUNT(*) INTO vCantidad
    FROM BIB_Editorial
    WHERE Estado = 1;

    -- Respuesta estándar
    SELECT 
        200 AS Codigo,
        'success' AS Tipo,
        CONCAT('Cantidad de editoriales activas: ', vCantidad) AS Mensaje,
        vCantidad AS Datos;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `BIB_EliminarEditorialPorId`(
    IN `p_IdEditorial` INT, 
    IN `p_UsuarioElimina` INT, 
    IN `p_IpElimina` VARCHAR(50)
)
BEGIN
    DECLARE v_rows INT DEFAULT 0;

    UPDATE BIB_Editorial
    SET Estado = 0,
        UsuarioElimina = p_UsuarioElimina,
        FechaElimina = NOW(),
        IpElimina = p_IpElimina
    WHERE IdEditorial = p_IdEditorial
      AND Estado <> 0;

    SET v_rows = ROW_COUNT();

    IF v_rows > 0 THEN
        SELECT 200 AS Codigo,
               'success' AS Tipo,
               'Editorial eliminada correctamente' AS Mensaje;
    ELSE
        SELECT 404 AS Codigo,
               'error' AS Tipo,
               'Editorial no encontrada o ya eliminada' AS Mensaje;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `BIB_ObtenerEditorialPorId`(IN `p_IdEditorial` INT)
BEGIN
    SELECT 
        E.IdEditorial,
        E.Nombre,
        E.Direccion,
        E.Telefono,
        E.Email,
        E.Estado,
        E.UsuarioRegistra,
        E.FechaRegistra,
        E.IpRegistra,
        E.UsuarioEdita,
        E.FechaEdita,
        E.IpEdita
    FROM BIB_Editorial E
    WHERE E.IdEditorial = p_IdEditorial
      AND E.Estado = 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `BIB_ObtenerEditorialesActivas`(
    IN `pInicio` INT, 
    IN `pCantidad` INT, 
    IN `pFiltro` VARCHAR(100)
)
BEGIN
    -- Solo editoriales con estado = 1 (activas)
    SELECT 
        E.IdEditorial,
        E.Nombre,
        E.Estado,
        E.UsuarioRegistra,
        E.FechaRegistra,
        E.IpRegistra,
        E.UsuarioEdita,
        E.FechaEdita,
        E.IpEdita
    FROM BIB_Editorial E
    WHERE E.Estado = 1 
      AND (E.Nombre LIKE CONCAT('%', pFiltro, '%'))
    ORDER BY E.Nombre
    LIMIT pCantidad OFFSET pInicio;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `BIB_RegistrarEditorial`(
    IN nombre_editorial VARCHAR(150), 
    IN direccion_editorial VARCHAR(250), 
    IN telefono_editorial VARCHAR(20), 
    IN correo_editorial VARCHAR(100), 
    IN estado_editorial TINYINT(1), 
    IN usuario VARCHAR(50), 
    IN ipusuario VARCHAR(50)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- En caso de error, revertimos la transacción
        ROLLBACK;
        SELECT
            500 AS Codigo,
            'error' AS Tipo,
            'Ocurrió un error al registrar la editorial' AS Mensaje,
            NULL AS Datos;
    END;

    START TRANSACTION;

    INSERT INTO BIB_Editorial (
        Nombre,
        Direccion,
        Telefono,
        Correo,
        Estado,
        UsuarioRegistra,
        IpRegistra,
        FechaRegistra
    )
    VALUES (
        nombre_editorial,
        direccion_editorial,
        telefono_editorial,
        correo_editorial,
        estado_editorial,
        usuario,
        ipusuario,
        NOW()
    );

    SET @nuevoId = LAST_INSERT_ID();

    COMMIT;

    -- Mensaje de éxito
    SELECT 
        200 AS Codigo, 
        'success' AS Tipo, 
        'Editorial registrada correctamente' AS Mensaje, 
        @nuevoId AS Datos;

END$$
DELIMITER ;