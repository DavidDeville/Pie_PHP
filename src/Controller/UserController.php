<?php

namespace src\Controller;
use Core\Controller;
use src\Model\UserModel;
use Core\ORM;

/**
 * UserController contains methods related to the user
 */
class UserController extends Controller
{
    private $statusMessage;

    /**
     * Render a specific page & its message depending on
     * the register request status
     * 
     * If conditions are met, the user will be registered
     * and redirected to the index
     * Else, register will be rendered again if the registration
     * hasn't been fulfilled or if there's any error
     */
    public function registerAction()
    {
        // return (new UserModel())->save($statusMessage);
        if(count($_POST) === 0) {
            $this->render('register');
        }
        if(isset($_POST['user_mail']) && isset($_POST['user_pwd'])) {
            //$request = new UserModel();
            $req = new ORM();
            $status = $req->create('users', ['email' => $_POST['user_mail'], 'password' => $_POST['user_pwd']]);
            if(is_int($status)) {
                // echo "ok";
                $this->statusMessage = 'bien enregistré';
                $this->render('index', [
                    'statusMessage' => $this->statusMessage
                ]);
                
            } else { // inscription invalide
                // echo "pas ok";
                $this->statusMessage = 'mail deja existant';
                $this->render('register', [
                    'statusMessage' => $this->statusMessage
                ]);
            }   
        }
    }

    /**
     * Render a specific page & its message depending on
     * the login request status
     * 
     * If conditions are met, user will be redirected to index
     * after logging
     * Else, if mail &/or password are incorrect or haven't been fulfilled
     * the login page will be rendered again
     */
    public function loginAction()
    {
        if (count($_POST) === 0) {
            $this->render('login'); 
        } else { 
            $statusMessage = '';
            if(isset($_POST['user_mail']) && isset($_POST['user_pwd'])) {
                $req = new ORM();
                $check_user = $req->check_user_exist('users');
                if($check_user == true) {
                    $id = $req->get_user_id($_POST['user_mail']);
                    $status = $req->read('users', $id);
                    $this->statusMessage = "connexion réussie";
                    $this->render('index', [
                        'statusMessage' => $this->statusMessage
                    ]);
                }
                else {
                    $this->statusMessage = "connexion échouée";
                    $this->render('login', [
                        'statusMessage' => $this->statusMessage
                    ]);   
                }
            }
        }
    }

    /**
     * Echo a test message
     */
    public function indexAction()
    {
        echo "it works";
    }
}
?>