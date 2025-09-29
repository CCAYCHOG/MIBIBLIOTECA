-- =====================================
-- CREACIÓN DE BASE DE DATOS
-- =====================================
CREATE DATABASE IF NOT EXISTS BibliotecaDB;
USE BibliotecaDB;

-- =====================================
-- TABLA: Editorial
-- =====================================
CREATE TABLE Editorial (
    IdEditorial INT AUTO_INCREMENT PRIMARY KEY,
    Nombre NVARCHAR(150) NOT NULL,
    Direccion NVARCHAR(250),
    Telefono NVARCHAR(20),
    Correo NVARCHAR(100),

    -- Auditoría
    Estado TINYINT(1) DEFAULT 1, -- 1=Activo, 0=Inactivo
    UsuarioRegistra NVARCHAR(50),
    FechaRegistra DATETIME,
    IpRegistra NVARCHAR(50),
    UsuarioEdita NVARCHAR(50),
    FechaEdita DATETIME,
    IpEdita NVARCHAR(50),
    UsuarioElimina NVARCHAR(50),
    FechaElimina DATETIME,
    IpElimina NVARCHAR(50)
);

-- =====================================
-- TABLA: Categoria
-- =====================================
CREATE TABLE Categoria (
    IdCategoria INT AUTO_INCREMENT PRIMARY KEY,
    Nombre NVARCHAR(100) NOT NULL,
    Descripcion NVARCHAR(250),

    -- Auditoría
    Estado TINYINT(1) DEFAULT 1,
    UsuarioRegistra NVARCHAR(50),
    FechaRegistra DATETIME,
    IpRegistra NVARCHAR(50),
    UsuarioEdita NVARCHAR(50),
    FechaEdita DATETIME,
    IpEdita NVARCHAR(50),
    UsuarioElimina NVARCHAR(50),
    FechaElimina DATETIME,
    IpElimina NVARCHAR(50)
);

-- =====================================
-- TABLA: TipoCubierta
-- =====================================
CREATE TABLE TipoCubierta (
    IdTipoCubierta INT AUTO_INCREMENT PRIMARY KEY,
    Nombre NVARCHAR(50) NOT NULL,

    -- Auditoría
    Estado TINYINT(1) DEFAULT 1,
    UsuarioRegistra NVARCHAR(50),
    FechaRegistra DATETIME,
    IpRegistra NVARCHAR(50),
    UsuarioEdita NVARCHAR(50),
    FechaEdita DATETIME,
    IpEdita NVARCHAR(50),
    UsuarioElimina NVARCHAR(50),
    FechaElimina DATETIME,
    IpElimina NVARCHAR(50)
);

-- =====================================
-- TABLA: Estante
-- =====================================
CREATE TABLE Estante (
    IdEstante INT AUTO_INCREMENT PRIMARY KEY,
    Codigo NVARCHAR(20) NOT NULL UNIQUE, -- Ej: "A1", "B3"
    Ubicacion NVARCHAR(100),
    NumNiveles INT DEFAULT 1,

    -- Auditoría
    Estado TINYINT(1) DEFAULT 1,
    UsuarioRegistra NVARCHAR(50),
    FechaRegistra DATETIME,
    IpRegistra NVARCHAR(50),
    UsuarioEdita NVARCHAR(50),
    FechaEdita DATETIME,
    IpEdita NVARCHAR(50),
    UsuarioElimina NVARCHAR(50),
    FechaElimina DATETIME,
    IpElimina NVARCHAR(50)
);

-- =====================================
-- TABLA: Libro
-- =====================================
CREATE TABLE Libro (
    IdLibro INT AUTO_INCREMENT PRIMARY KEY,
    Titulo NVARCHAR(200) NOT NULL,
    ISBN NVARCHAR(20) UNIQUE NOT NULL,
    AnioPublicacion INT,
    NumPaginas INT,
    Cantidad INT DEFAULT 1,

    -- Relaciones
    IdEditorial INT,
    IdCategoria INT,
    IdTipoCubierta INT,
    IdEstante INT,
    NivelEstante INT,
    
    -- Auditoría
    Estado TINYINT(1) DEFAULT 1,
    UsuarioRegistra NVARCHAR(50),
    FechaRegistra DATETIME,
    IpRegistra NVARCHAR(50),
    UsuarioEdita NVARCHAR(50),
    FechaEdita DATETIME,
    IpEdita NVARCHAR(50),
    UsuarioElimina NVARCHAR(50),
    FechaElimina DATETIME,
    IpElimina NVARCHAR(50)
);

-- =====================================
-- TABLA: Autor
-- =====================================
CREATE TABLE Autor (
    IdAutor INT AUTO_INCREMENT PRIMARY KEY,
    Nombre NVARCHAR(100) NOT NULL,
    Apellido NVARCHAR(100) NOT NULL,
    Nacionalidad NVARCHAR(80),
    FechaNacimiento DATE,

    -- Auditoría
    Estado TINYINT(1) DEFAULT 1,
    UsuarioRegistra NVARCHAR(50),
    FechaRegistra DATETIME,
    IpRegistra NVARCHAR(50),
    UsuarioEdita NVARCHAR(50),
    FechaEdita DATETIME,
    IpEdita NVARCHAR(50),
    UsuarioElimina NVARCHAR(50),
    FechaElimina DATETIME,
    IpElimina NVARCHAR(50)
);

-- =====================================
-- TABLA: LibroAutor (relación N:N)
-- =====================================
CREATE TABLE LibroAutor (
    IdLibroAutor INT AUTO_INCREMENT PRIMARY KEY,
    IdLibro INT NOT NULL,
    IdAutor INT NOT NULL,

    -- Auditoría
    Estado TINYINT(1) DEFAULT 1,
    UsuarioRegistra NVARCHAR(50),
    FechaRegistra DATETIME,
    IpRegistra NVARCHAR(50),
    UsuarioEdita NVARCHAR(50),
    FechaEdita DATETIME,
    IpEdita NVARCHAR(50),
    UsuarioElimina NVARCHAR(50),
    FechaElimina DATETIME,
    IpElimina NVARCHAR(50)
);
