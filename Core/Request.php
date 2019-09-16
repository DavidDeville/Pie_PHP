<?php

namespace Core;

class Request
{
    private $post_array = [];
    private $get_array = [];
    public function post_content()
    {
        if($_POST) {
            foreach($_POST as $param => $value) {
                $this->post_array[$param] = trim($value);
                $this->post_array[$param] = htmlspecialchars($value, ENT_QUOTES);
                $this->post_array[$param] = stripslashes($value);
            }
        }

        if($_GET) {
            foreach($_POST as $param => $value) {
                $this->get_array[$param] = trim($value);
                $this->get_array[$param] = htmlspecialchars($value, ENT_QUOTES, UTF-8);
                $this->get_array[$param] = stripslashes($value);
            }
        }
    }
    //$request->password donne le pwd
}