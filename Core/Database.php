<?php

namespace Core;

class Database
{
    protected $mail;
    protected $password;
    protected $connexion = null;

    /**
     * Construct contains database informations to execute a connection
     */
    public function __construct()
    {
        $this->mail = $_POST['user_mail'];
        $this->password = $_POST['user_pwd'];
        $this->server = "localhost";
		$this->user = "root";
		$this->bdd_password = "root";
        $this->database = "piephp";

		try
		{
			$this->connexion = new \PDO('mysql:host='.$this->server.';dbname='.$this->database, $this->user, $this->bdd_password);
		}
		catch(PDOException $e) 
		{
        	echo "Connection failed:" . $e->getMessage();
        }
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setConnexion($connexion)
    {
        $this->connexion = $connexion;   
    }

    public function getMail($mail)
    {
        return $this->$mail;
    }

    public function getPassword($password)
    {
        return $this->password;
    }

    public function getConnexion($connexion)
    {
        return $this->connexion;   
    }
}