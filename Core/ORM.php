<?php

namespace Core;

use Core\Database;

class ORM extends Database
{
    /**
     * Method that adds a user into the database (register)
     * 
     * @param string $table - the targeted table 
     * 
     * @param array $fields - fields of the database
     * 
     * @return bool - true if the request has been executed, false otherwise
     */

    public function create(string $table, array $fields) 
    {
        $add = $this->connexion->prepare('INSERT INTO ' . $table . ' (' . 
        implode(',', array_keys($fields)) . ') VALUES(:' . 
        implode(', :', array_keys($fields)) . ')');
        foreach($fields as $field_name => $value) {
            $add->bindValue(':' . $field_name, $value);
        }
        
        $status = $add->execute();
        if($status == true) {
            return intval($this->connexion->lastInsertId());
        } else {
            return $status;
        }
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
    public function read(string $table, int $id)
    {
        $add = $this->connexion->prepare('SELECT * FROM ' . $table . ' WHERE id = :id');
            $status = $add->execute([
                ':id' => $id
            ]);
        
            if($status == true) {
                return $result = $add->fetchAll(\PDO::FETCH_ASSOC);  
            }
            else {
                return false;
            }
            return $status;
    }

    /**
     * Prepare a request that will update the user infos
     * 
     * @param string $table - name of the table
     * 
     * @param array $fields - the fields that will be updated
     * 
     * @param int $id - id of the user
     * 
     * @return bool - true if the request has been executed, false otherwise
     */
    public function update(string $table, array $fields, int $id)
    {
        $update = $this->connexion->prepare('UPDATE ' . $table . ' SET ' . 
        implode(',', array_keys($fields)) . ' = :' . 
        implode(',', array_keys($fields)) . ' WHERE id = :id');
        $update->bindValue(':id', $id);
        foreach($fields as $field_name => $value) {
            $update->bindValue(':' . $field_name, $value);
        }
        
        $status = $update->execute();
        var_dump($status);
        if($status == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Prepare a request that will delete the user ID matching the specified
     * mail and password
     * 
     * @param int $id - id of the user
     * 
     * @return bool $status - true if the request has been executed, false otherwise
     */
    public function delete(string $table, int $id)
    {
        $delete = $this->connexion->prepare('DELETE FROM ' . $table . ' WHERE id = :id');
        //var_dump($delete);
        $status = $delete->execute([
            ':id' => $id
            ]);
        if($status == true) {
            return $status;
        } else {
            return false;
        }
    }

    /**
     * Prepare a request that will get all infos from a table
     * 
     * @param string $table - the selected table
     * 
     * @return bool - true if the request has been executed, false otherwise
     */
    public function read_all(string $table)
    {
        $add = $this->connexion->prepare('SELECT * FROM ' . $table);
            $status = $add->execute();
        
            if($status == true) {
                return $result = $add->fetchAll(\PDO::FETCH_ASSOC);
            }
            else {
                return false;
            }
    }

    /**
     * Select the user id depending on the email and returns it
     * 
     * @param string $mail - The user's mail
     * 
     * @return int $result[0]['id] - the id of the user
     * 
     * @return bool - false if the request has failed
     */
    public function get_user_id($mail)
    {    
        $add = $this->connexion->prepare('SELECT id FROM users WHERE email = :email');
        $status = $add->execute([
            ':email' => $this->mail
        ]);

        if($status == true) {
            $result = $add->fetchAll(\PDO::FETCH_ASSOC);
            return $result[0]['id'];       
        }
        else {
            return false;
        }
    }

    /**
     * Check if the user exists in the database
     * 
     * @param string $mail - The user's mail
     * 
     * @return bool - true if the request has been executed, false otherwise
     */
    public function check_user_exist($table)
    {    
        $add = $this->connexion->prepare('SELECT email, password FROM ' . $table  . ' WHERE email = :email AND password = :password');
        $status = $add->execute([
            ':email' => $this->mail,
            ':password' => $this->password
        ]);
        $result = count($add->fetchAll(\PDO::FETCH_ASSOC));

        if($result > 0) {
            return true;       
        }
        else {
            return false;
        }
    }
}