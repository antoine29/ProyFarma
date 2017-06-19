<?php
require_once("../db/Database.php");
require_once("../interfaces/IUser.php");

class Farmacia implements IUser
{
    private $con;   //conexion a la DB
    private $direccion;
    private $idfarmacia;    //columnas de la tabla
    private $telefono;
    private $lat;
    private $long;
    private $nombre;

    public function __construct(Database $db) //constructor por defecto
    {
        $this->con = new $db;
    }

    public function setId($id)
    {
        $this->idfarmacia = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDireccion($direc)
    {
        $this->direccion = $direc;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    public function setLong($long)
    {
        $this->long = $long;
    }

    public function setTelefono($tele)
    {
        $this->telefono = $tele;
    }

    public function getId(){
        return $this->idfarmacia;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getLat(){
        return $this->lat;
    }

    public function getLong(){
        return $this->long;
    }

    //insertamos farmacias en una tabla con postgreSql
    public function save()
    {
        try{
            $query = $this->con->prepare('INSERT INTO Farmacia (direccion, idFarmacia, telefono, lat, long, nombre) values (?,?,?,?,?,?)');
            $query->bindParam(1, $this->direccion, PDO::PARAM_STR);
            $query->bindParam(2, $this->idfarmacia, PDO::PARAM_INT); //talves sea string
            $query->bindParam(3, $this->telefono, PDO::PARAM_STR);
            $query->bindParam(4, $this->lat, PDO::PARAM_STR);
            $query->bindParam(5, $this->long, PDO::PARAM_STR);
            $query->bindParam(6, $this->nombre, PDO::PARAM_STR);
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
            $query = $this->con->prepare('UPDATE Farmacia SET direccion = ?, telefono = ?, lat = ?, long = ?, nombre = ? WHERE idfarmacia = ?');
            $query->bindParam(1, $this->direccion, PDO::PARAM_STR);
            $query->bindParam(2, $this->telefono, PDO::PARAM_STR);
            $query->bindParam(3, $this->lat, PDO::PARAM_STR);
            $query->bindParam(4, $this->long, PDO::PARAM_STR);
            $query->bindParam(5, $this->nombre, PDO::PARAM_STR);
            $query->bindParam(6, $this->idfarmacia, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }

    //obtenemos las farmacias de una tabla con postgreSql
    public function get()
    {
        try{
            if(is_int($this->idfarmacia))
            {
                $query = $this->con->prepare('SELECT * FROM farmacia WHERE idFarmacia = ? ORDER BY idFarmacia');
                $query->bindParam(1, $this->idfarmacia, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM farmacia ORDER BY idFarmacia');
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
            $query = $this->con->prepare('DELETE FROM medicamentofarmacia WHERE idfarmacia = ?');
            $query->bindParam(1, $this->idfarmacia, PDO::PARAM_INT);
            $query->execute();
            $query = $this->con->prepare('DELETE FROM Farmacia WHERE idfarmacia = ?');
            $query->bindParam(1, $this->idfarmacia, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
            return true;
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
        return false;
    }

    public static function baseurl()
    {
         return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/ProyFarma/";
    }

    //creo que esta funcion busca un farmacia, si no la encuentra redirecciona al listado inicial
    public function checkFarmacia($farmacia)
    {
        if( ! $farmacia )
        {
            header("Location:" . Farmacia::baseurl() . "app/listaFarmacia.php");
            
        }
    }
}
