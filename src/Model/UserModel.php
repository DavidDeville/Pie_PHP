<?php

namespace src\Model;

/**
 * UserModel contains methods executing database related requests
 * 
 */
class UserModel
{
    private $mail;
    private $password ;
    private $connexion = null;

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

    /**
     * Résumé de la fonction
     * 
     * @param string &$statusMessage - 
     * 
     * @return boolean - dans quel cas vrai, dans quel cas faux
     */

    public function create(string $table, array $fields) 
    {
        // Method à modifier
        // Changer les paramètres et ajouter le $fields (les champs) & $table (la table à check)
        // Rajouter une requête pour récupérer la dernière ID (une méthode PDO existe, lastinsertid)
        //('INSERT INTO users (email, password) VALUES(:mail, :password)');
        $add = $this->connexion->prepare('INSERT INTO ' . $table . ' (' . implode(',', array_keys($fields)) . ') VALUES(:' . implode(', :', array_keys($fields)) . ')');
        foreach($fields as $field_name => $value)
        {
            $add->bindValue(':' . $field_name, $value);
        }
        $status = $add->execute();
        if($status == true) {
            return intval($this->connexion->lastInsertId());
        } else {
            return $status;
        }
        
            
            // $statusMessage = ($status) ? "L'inscription a réussi" : "L'inscription a échouée";
            // return $status;
    }

    /**
     * Prepare a request that will select the user ID matching the specified
     * mail and password
     * 
     * @param string &$statusMessage - Success if the request is correct
     * error otherwise
     * 
     * @return bool - true if the request has been executed, false otherwise
     */
    public function read(string $table, array $fields, int $id)
    {
        $add = $this->connexion->prepare('SELECT ' . implode(',', $fields) . ' FROM ' . $table . ' WHERE id = :id');
        
            $status = $add->execute([
                ':id' => $id
            ]);
        
            if($status == true)
            {
                return $result = $add->fetchAll(\PDO::FETCH_ASSOC);
            }
            else
            {
                return false;
            }
    }
    
    /**
     * Check if the register form has been submitted and calls create method
     * if that's the case, returns false otherwise
     * 
     * @param string &$statusMessage - Success if the request is correct
     * error otherwise
     * 
     * @return bool - true if the request has been executed, false otherwise
     */
    public function save()
    {    
        $add = $this->connexion->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $status = $add->execute([
            ':email' => $this->mail,
            ':password' => $this->password
        ]);
        return $status;
    }
}