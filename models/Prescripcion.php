<?php
require_once("../db/Database.php");
require_once("../interfaces/IUser.php");

class Prescripcion
{
    private $con;   //consulta a la DB
    private $fecha;    //columnas de la tabla
    private $cantidad;
    private $idprescripcion;
    private $iddoctor;
    private $cipaciente;
    private $idmedicamento;
    private $idestablecimiento;

    private $nombredoc;
    private $nombrepac;
    private $nombreest;

    public function setNombreDoc($nom){
        $this->nombredoc=$nom;
    }
    public function setNombrePac($nom){
        $this->nombrepac=$nom;
    }
    public function setNombreEst($nom){
        $this->nombreest=$nom;
    }


    public function __construct(Database $db)
    {
        $this->con = new $db;
    }

    public function get()
    {
        try{
            if(is_int($this->idprescripcion))
            {   
                $query = $this->con->prepare('SELECT * FROM presdocpacmed WHERE idprescripcion = ?');
                $query->bindParam(1, $this->idprescripcion, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            if(is_string($this->nombredoc))
            {
                $query = $this->con->prepare('SELECT * FROM presdocpacmed WHERE nombredoctor = ?');
                $query->bindParam(1, $this->nombredoc, PDO::PARAM_STR);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            if(is_string($this->nombrepac))
            {
                $query = $this->con->prepare('SELECT * FROM presdocpacmed WHERE nombrepaciente = ?');
                $query->bindParam(1, $this->nombrepac, PDO::PARAM_STR);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            if(is_string($this->nombreest))
            {
                $query = $this->con->prepare('SELECT * FROM presdocpacmed WHERE nombreestablecimiento = ?');
                $query->bindParam(1, $this->nombreest, PDO::PARAM_STR);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }

            $query = $this->con->prepare('SELECT * FROM presdocpacmed');
            $query->execute();
            $this->con->close();
            return $query->fetchAll(PDO::FETCH_OBJ);            
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
    public function checkprescripcion($prescripcion)
    {
        if( ! $prescripcion )
        {
            header("Location:" . Prescripcion::baseurl() . "app/listaPrescripcion.php");
        }
    }
}
