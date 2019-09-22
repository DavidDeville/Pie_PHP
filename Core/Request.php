<?php

namespace Core;

class Request
{
    private $params_array = [];
    public function post_content()
    {
        if($_POST) {
            foreach($_POST as $param => $value) {
                $this->params_array[$param] = trim($value);
                $this->params_array[$param] = htmlspecialchars($value, ENT_QUOTES);
                $this->params_array[$param] = stripslashes($value);
                unset($_POST[$param]);
            }
        }

        if($_GET) {
            foreach($_POST as $param => $value) {
                $this->params_array[$param] = trim($value);
                $this->params_array[$param] = htmlspecialchars($value, ENT_QUOTES);
                $this->params_array[$param] = stripslashes($value);
            }
        }
        if(isset($this->params_array['password'])) {
            $salt = "kebab";
            $this->params_array['password'] = hash('ripemd160', $this->params_array['password'] . $salt);
        }
    }

    public function getQueryParams()
    {
        return $this->params_array;
    }
    //$request->password donne le pwd
}