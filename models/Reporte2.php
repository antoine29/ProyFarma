<?php

require_once("../db/Database.php");
require_once("../interfaces/IUser.php");

 class Reporte implements IUser{

    echo "lleog";

    private $con;   //conexion a la DB
    private $idreporte;    //columnas de la tabla
    private $email;
    private $contenido;

    public function __construct(Database $db){  //constructor por defecto
        $this->con = new $db;
    }

    public function setId($id){
        $this->idreporte = $id;
    }

    public function setEmail($ema){
        $this->email = $ema;
    }

    public function setContenido($conte){
        $this->contenido = $conte;
    }

}

    //insertamos farmacias en una tabla con postgreSql
    public function save()
    {
        /*
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
        */
        return "weee";
    }

    public function update()
    {
        /*
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
        */

        return "weee";
    }

    //obtenemos las farmacias de una tabla con postgreSql
    public function get()
    {
        /*
        try{
            if(is_int($this->idfarmacia))
            {
                $query = $this->con->prepare('SELECT * FROM farmacia WHERE idfarmacia = ?');
                $query->bindParam(1, $this->idfarmacia, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM farmacia');
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
        */
        return "weee";
    }

    public function delete()
    {
        /*
        try{
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
        */
        return "weee";
    }

    public static function baseurl()
    {
        /*
         return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/ProyFarma/";
         */
         return "weee";
    }

    //creo que esta funcion busca un farmacia, si no la encuentra redirecciona al listado inicial
    public function checkFarmacia($farmacia)
    {
        /*
        if( ! $farmacia )
        {
            header("Location:" . Farmacia::baseurl() . "app/listaFarmacia.php");
            
        }
        */
        return "weee";
    }


echo "lleog";