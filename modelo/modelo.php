<?php
class Modelo {
    private $dbBiblioteca;

    public function __construct()
    {
        $this->dbBiblioteca = null;
    }

    public function getBiblioteca(){
        if(!$this->dbBiblioteca){
            $this->dbBiblioteca = Conexion::Biblioteca();
        }
        return $this->dbBiblioteca;
    }

    public function BIB_RegistrarAutor(
        string $nombre_autor, 
        string $apellido_autor, 
        string $nacionalidad_autor, 
        string $fnacimiento_autor, 
        int $estado_autor, 
        int $usuario, 
        string $ipusuario
    ){
        try {
            $conn = $this->getBiblioteca();
            $sql = "CALL BIB_RegistrarAutor(:nombre_autor, :apellido_autor, :nacionalidad_autor, 
                                            :fnacimiento_autor, :estado_autor, :usuario, :ipusuario)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre_autor', $nombre_autor, PDO::PARAM_STR);
            $stmt->bindParam(':apellido_autor', $apellido_autor, PDO::PARAM_STR);
            $stmt->bindParam(':nacionalidad_autor', $nacionalidad_autor, PDO::PARAM_STR);
            $stmt->bindParam(':fnacimiento_autor', $fnacimiento_autor, PDO::PARAM_STR);
            $stmt->bindParam(':estado_autor', $estado_autor, PDO::PARAM_INT);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
            $stmt->bindParam(':ipusuario', $ipusuario, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error al registrar autor: " . $e->getMessage());
        }        
    }

    public function BIB_ObtenerAutoresActivos(int $pInicio, int $pCantidad, string $pFiltro){
        try {
            $conn = $this->getBiblioteca();
            $sql = "CALL BIB_ObtenerAutoresActivos(:pInicio, :pCantidad, :pFiltro)";            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pInicio', $pInicio, PDO::PARAM_INT);
            $stmt->bindParam(':pCantidad', $pCantidad, PDO::PARAM_INT);
            $stmt->bindParam(':pFiltro', $pFiltro, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener autores: " . $e->getMessage());
        }        
    }

    public function BIB_ContarAutoresActivos(){
        try{
            $conn = $this->getBiblioteca();
            $sql = "CALL BIB_ContarAutoresActivos()";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e){
            throw new Exception("Error al obtener cantidad de autores: " . $e->getMessage());
        }
    }

    public function BIB_ObtenerAutorPorId(int $IdAutor){
        try {
            $conn = $this->getBiblioteca();
            $sql = "CALL BIB_ObtenerAutorPorId(:p_IdAutor)";            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':p_IdAutor', $IdAutor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el autor: " . $e->getMessage());
        }        
    }

    public function BIB_EliminarAutorPorId(int $IdAutor, int $IdUsuario, string $IpElimina){
        try {
            $conn = $this->getBiblioteca();
            $sql = "CALL BIB_EliminarAutorPorId(:p_IdAutor, :p_UsuarioElimina, :p_IpElimina)";            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':p_IdAutor', $IdAutor, PDO::PARAM_INT);
            $stmt->bindParam(':p_UsuarioElimina', $IdUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':p_IpElimina', $IpElimina, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar el autor: " . $e->getMessage());
        }        
    }

    public function BIB_ActualizarAutor(
        int $IdAutor,
        string $nombre_autor, 
        string $apellido_autor, 
        string $nacionalidad_autor, 
        string $fnacimiento_autor, 
        int $estado_autor, 
        int $usuario, 
        string $ipusuario
    ){
        try {
            $conn = $this->getBiblioteca();
            $sql = "CALL BIB_ActualizarAutor(:p_IdAutor, :p_Nombre, :p_Apellido, :p_Nacionalidad, 
                                            :p_FechaNacimiento, :p_Estado, :p_UsuarioModifica, :p_IPModifica)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':p_IdAutor', $IdAutor, PDO::PARAM_INT);
            $stmt->bindParam(':p_Nombre', $nombre_autor, PDO::PARAM_STR);
            $stmt->bindParam(':p_Apellido', $apellido_autor, PDO::PARAM_STR);
            $stmt->bindParam(':p_Nacionalidad', $nacionalidad_autor, PDO::PARAM_STR);
            $stmt->bindParam(':p_FechaNacimiento', $fnacimiento_autor, PDO::PARAM_STR);
            $stmt->bindParam(':p_Estado', $estado_autor, PDO::PARAM_INT);
            $stmt->bindParam(':p_UsuarioModifica', $usuario, PDO::PARAM_INT);
            $stmt->bindParam(':p_IPModifica', $ipusuario, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar el autor: " . $e->getMessage());
        }        
    }

    public function BIB_BuscarPaises(string $nombre){
        try {
            $conn = $this->getBiblioteca();
            $sql = "CALL BIB_BuscarPaises(:p_Nombre)";            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':p_Nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los paises: " . $e->getMessage());
        }        
    }
}
