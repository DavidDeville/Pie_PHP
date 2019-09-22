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
        $statusMessage = '';
        $params_array = $this->request->getQueryParams();
        if(count($params_array) === 0) {
            $this->render('register');
        }
        if(isset($params_array['email']) && isset($params_array['password'])) {
            $user = new UserModel($params_array);
            if(!preg_match ("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9
            _]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/", $params_array['email'])) {
                $this->statusMessage = 'format mail invalide';
                $this->render('register', ['statusMessage' => 
                $this->statusMessage]);
            }
            else {
                $status = $user->save();
                var_dump($status);
                if($status != null) {
                    $status = $user->read_user_info();
                    print_r($status);
                    $this->statusMessage = 'bien enregistré';
                    $this->render('index', ['statusMessage' => 
                    $this->statusMessage]);          
                } else {
                    $this->statusMessage = 'mail deja existant';     
                    $this->render('register', ['statusMessage' => 
                    $this->statusMessage]);
                }
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
        $params_array = $this->request->getQueryParams();
        if (count($params_array) === 0) {
            $this->render('login');
        } else { 
            $statusMessage = '';
            if(isset($params_array['email']) && isset($params_array['password'])) {
                $req = new UserModel($params_array);
                //$check_user = $req->login();
                //$check_user = $req->update_user_info();
                $check_user = $req->delete_user_info();
                var_dump($check_user);
                if($check_user != false) {
                    $this->statusMessage = "connexion réussie -> id : " . $check_user;
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

    public function showAction()
    {
        $this->statusMessage = "La page dédiée à l'utilisateur";
        $this->render('show', [
            'statusMessage' => $this->statusMessage
        ]);
    }
}
?>