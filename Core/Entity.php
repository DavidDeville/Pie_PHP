<?php

namespace Core;
use Core\ORM;

class Entity
{
    public function __construct(array $array)
    {
        $this->orm = new ORM();
        if(count($array) == 1 && array_key_exists('id', $array)) {
            $array = $this->orm->read('users', $array['id']);
            $array = $array[0];
            // echo "<pre>";
            // var_dump($array);
            // echo "</pre>";
        }
        $this->param = $array;
        //var_dump($this->param);
        foreach($array as $name_attr => $value_attr) {   
            $this->$name_attr = $value_attr;
        }
    }

    public function save()
    {
        $user_info = $this->orm->check_user_exist('users', $this->param);
        if(count($user_info) > 0) {
            echo "Adresse mail déjà utilisée";    
        }
        else {
            return $this->orm->create('users', $this->param);
        }
    }

    public function login()
    {
        $user_info = $this->orm->check_user_exist('users', $this->param);
        if(count($user_info) > 0) {
            return $user_info[0]['id'];
        } else {
            return false;
        }
    }

    public function update_user_info()
    {
        $user_info = $this->orm->check_user_exist('users', $this->param);
        $user_id = intval($user_info[0]['id']);
        $salt = "kebab";
        $this->param['password'] = hash('ripemd160', "maison" . $salt);
        $this->param['email'] = "papoune@gmail.com";
        return $this->orm->update('users', $user_id, ['email' => $this->param['email'], 'password' => $this->param['password']]);
    }

    public function read_user_info()
    {
        $user_info = $this->orm->check_user_exist('users', $this->param);
        $user_id = intval($user_info[0]['id']);
        return $this->orm->read('users', $user_id);
    }

    public function delete_user_info()
    {
        $user_info = $this->orm->check_user_exist('users', $this->param);
        //var_dump($user_info[0]['id']);
        $user_id = intval($user_info[0]['id']);
        return $this->orm->delete('users', $user_id);
    }
}