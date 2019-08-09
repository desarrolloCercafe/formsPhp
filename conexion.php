<?php
class Conn extends PDO
{
    //Atributos de la base de datos
    private $dbname;
    private $host;
    private $user;
    private $pass;
    private $port;
    //Métodos
    public function __construct()
    {
        $this->dbname = "pruebas";
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "cercafeRoot";
        $this->port = "3306";
        $dsn="mysql:host=$this->host;port=$this->port;dbname=$this->dbname";
        $options = array(
            PDO::ATTR_EMULATE_PREPARES => FALSE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try{
            parent::__construct($dsn, $this->user, $this->pass, $options);
        }catch(Exception $e)
        {
            echo "Tienes el siguiente error:", $e->getMessage();
        }
    }
}
?>
