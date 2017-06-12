<?php
require_once("../db/Database.php");
require_once("../interfaces/IUser.php");

class Medicamento implements IUser
{
    private $con;   //consulta a la DB
    private $idmedicamento;    //columnas de la tabla
    private $nombre;
    private $descripcion;
    private $dosis;
    private $tipo;

    public function __construct(Database $db)
    {
        $this->con = new $db;
    }

    public function setId($id)
    {
        $this->idmedicamento = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setDescripcion($descrip)
    {
        $this->descripcion = $descrip;
    }

    public function setDosis($dosis)
    {
        $this->dosis = $dosis;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    //insertamos medicamentos en una tabla con postgreSql
    public function save()
    {
        try{
            $query = $this->con->prepare('INSERT INTO medicamento (idmedicamento, nombre, descripcion, dosis, tipo) values (?,?,?,?,?)');
            $query->bindParam(1, $this->idmedicamento, PDO::PARAM_INT); //talves sea string
            $query->bindParam(2, $this->nombre, PDO::PARAM_STR);
            $query->bindParam(3, $this->descripcion, PDO::PARAM_STR);
            $query->bindParam(4, $this->dosis, PDO::PARAM_STR);
            $query->bindParam(5, $this->tipo, PDO::PARAM_STR);
            $query->execute();
            $this->con->close();
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }

    public function update()
    {
        try{
            $query = $this->con->prepare('UPDATE medicamento SET nombre = ?, descripcion = ?, dosis = ?, tipo = ? WHERE idmedicamento = ?');
            $query->bindParam(1, $this->nombre, PDO::PARAM_STR);
            $query->bindParam(2, $this->descripcion, PDO::PARAM_STR);
            $query->bindParam(3, $this->dosis, PDO::PARAM_STR);
            $query->bindParam(4, $this->tipo, PDO::PARAM_STR);
            $query->bindParam(5, $this->idmedicamento, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }

    //obtenemos las medicamentos de una tabla con postgreSql
    public function get()
    {
        try{
            if(is_int($this->idmedicamento))
            {
                $query = $this->con->prepare('SELECT * FROM medicamento WHERE idmedicamento = ?');
                $query->bindParam(1, $this->idmedicamento, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM medicamento');
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }

    public function buscaNombre()
    {
        try{
            if(is_string($this->nombre))
            {
                $query = $this->con->prepare('SELECT * FROM medicamento WHERE nombre = ?');
                $query->bindParam(1, $this->nombre, PDO::PARAM_STR);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM medicamento');
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }

    public function buscaMedicamentoEnFarmacias(){
        try{
            if(is_string($this->nombre))
            {
                $query = $this->con->prepare('SELECT * FROM p1(?)');
                $query->bindParam(1, $this->nombre, PDO::PARAM_STR);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM medicamento');
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }        

    }


    public function delete()
    {
        try{
            $query = $this->con->prepare('DELETE FROM medicamento WHERE idmedicamento = ?');
            $query->bindParam(1, $this->idmedicamento, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
            return true;
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }

    public static function baseurl()
    {
         return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/ProyFarma/";
    }

    //creo que esta funcion busca un medicamento, si no la encuentra redirecciona al listado inicial
    public function checkmedicamento($medicamento)
    {
        if( ! $medicamento )
        {
            header("Location:" . Medicamento::baseurl() . "app/listaMedicamento.php");
            
        }
    }
}

