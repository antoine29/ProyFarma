<?php
require_once("../db/Database.php");
require_once("../interfaces/IUser.php");

class User implements IUser
{
    private $con;
    private $id;
    private $nombre;
    private $lat;
    private $long;

    public function __construct(Database $db)
    {
        $this->con = new $db;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    public function setLong($long)
    {
        $this->long = $long;
    }

    //insertamos usuarios en una tabla con postgreSql
    public function save()
    {
        try{
            $query = $this->con->prepare('INSERT INTO Farmacia (id, nombre, lat, long) values (?,?,?,?)');
            $query->bindParam(1, $this->id, PDO::PARAM_STR);
            $query->bindParam(2, $this->nombre, PDO::PARAM_STR);
            $query->bindParam(3, $this->lat, PDO::PARAM_STR);
            $query->bindParam(4, $this->long, PDO::PARAM_STR);
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
            $query = $this->con->prepare('UPDATE Farmacia SET username = ?, password = ? WHERE id = ?');
            $query->bindParam(1, $this->username, PDO::PARAM_STR);
            $query->bindParam(2, $this->password, PDO::PARAM_STR);
            $query->bindParam(3, $this->id, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }
    //obtenemos usuarios de una tabla con postgreSql
    public function get()
    {
        try{
            if(is_int($this->id))
            {
                $query = $this->con->prepare('SELECT * FROM farmacia WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return $query->fetch(PDO::FETCH_OBJ);
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
    }

    public function delete()
    {
        try{
            $query = $this->con->prepare('DELETE FROM Farmacia WHERE id = ?');
            $query->bindParam(1, $this->id, PDO::PARAM_INT);
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

    public function checkUser($user)
    {
        if( ! $user )
        {
            header("Location:" . User::baseurl() . "app/list.php");
        }
    }
}