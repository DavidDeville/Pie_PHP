<?php

namespace Core;

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
        
        var_dump($add);
        $status = $add->execute();
        return intval($this->connexion->lastInsertId());
        
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
    public function read(string $table, int $id_param)
    {
        $add = $this->connexion->prepare('SELECT * FROM ' . $table . ' WHERE id = :id');
            $status = $add->execute([
                ':id' => $id_param
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
    public function update(string $table, int $id, array $fields)
    {   
        $q = 'UPDATE ' . $table . ' SET ';
        foreach($fields as $field_name => $value) {
            $q .= $field_name . ' = ' . " :" . $field_name . ', ';
        }
        $q = rtrim($q, ', ');
        $q .= ' WHERE id = :id';
        $update = $this->connexion->prepare($q);

        foreach($fields as $field_name => $value) {
            $update->bindValue(':' . $field_name, $value);
        }
        $update->bindValue(':id', $id);
        var_dump($q);
        
        $status = $update->execute();
        $update->debugDumpParams();
        return $status;
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
     * Prepare a request that will get infos from a table
     * 
     * @param string $table - the selected table
     * 
     * @param array $params - the selected table
     * 
     * @return bool - true if the request has been executed, false otherwise
     */
    public function find(string $table, array $params)
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
    public function get_user_id($params)
    {    
        $add = $this->connexion->prepare('SELECT id FROM users WHERE email = :email');
        $status = $add->execute([
            ':email' => $params['email']
        ]);

        if($status == true) {
            $result = $add->fetchAll(\PDO::FETCH_ASSOC);
            var_dump($result);
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
    public function check_user_exist($table, $params)
    {    
        $add = $this->connexion->prepare('SELECT * FROM ' . $table  . ' WHERE email = :email AND password = :password');
        $status = $add->execute([
            ':email' => $params['email'],
            ':password' => $params['password']
        ]);
        return $add->fetchAll(\PDO::FETCH_ASSOC);
    }
}