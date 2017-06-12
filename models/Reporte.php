<?php
require_once("../db/Database.php");

class Reporte 
{
    private $con;
    private $idreporte;
    private $email;
    private $contenido;

    function __construct(Database $db)
    {
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

    public function save(){
        try {
            $query = $this->con->prepare('INSERT INTO Reporte (idreporte, email, contenido) values (?,?,?)');
            $query->bindParam(1, $this->idreporte, PDO::PARAM_INT);
            $query->bindParam(2, $this->email, PDO::PARAM_STR); //talves sea string
            $query->bindParam(3, $this->contenido, PDO::PARAM_STR);
            $query->execute();
            $this->con->close();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get(){
        try{
            if(is_int($this->idreporte))
            {
                $query = $this->con->prepare('SELECT * FROM reporte WHERE idreporte = ?');
                $query->bindParam(1, $this->idreporte, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM reporte');
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

    public function cuentaReportes(){
        $nro=0;
        $reportes = $this->get();

        foreach ($reportes as $repo) {
            $nro++;
        }
        return $nro;
    }

    public static function baseurl()
    {
         return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . '/ProyFarma/';
    }

    //creo que esta funcion busca un farmacia, si no la encuentra redirecciona al listado inicial
    public function checkFarmacia($reporte)
    {
        if( ! $reporte )
        {
            header("Location:" . reporte::baseurl() . "app/listaReporte.php");
        }
    }

}
