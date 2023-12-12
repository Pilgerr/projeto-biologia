<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Usuario;

class App
{
    private $view;

    public function __construct()
    {
          if (empty($_SESSION["user"]) && empty($_COOKIE['userName'])) {
              header("location:". url(""));
          } 

        $this->view = new Engine(CONF_VIEW_APP, 'php');
    }

    public function home () : void 
    {
        echo $this->view->render("home");
    }

    public function logout () : void 
    {
        session_destroy();
        setcookie("userId", "", time()-3600, "/");
        setcookie("userName", "", time()-3600, "/");
        header("location:". url(""));
    }

    public function profile (array $data) 
    {
        if(!empty($data)){
            if(!empty($_FILES['edit-photo']['tmp_name'])) {
                $upload = uploadImage($_FILES['edit-photo']);
                unlink($_SESSION["user"]["photo"]);
            } else {
                // se não houve alteração da imagem, manda a imagem que está no cookie
                $upload = $_SESSION["user"]["photo"];
            }
            $user = new Usuario(
                $data['edit-email'], 
                $data['edit-name'], 
                $data['edit-phoneNumber'], 
                NULL,
                $data['edit-dtBorn'], 
                $data['edit-document'],
                $upload
            );
            $returnInsert = $user->updateUser($data['edit-id']);

            if ($returnInsert == true) {
                $userJson = [
                    "type" => "input-edit-success",
                    "photo" => url($user->photo)
                ];
                echo json_encode($userJson);
            } else {
                $userJson = [
                    "type" => "input-edit-error"
                ];
                echo json_encode($userJson);
            }
            return;

        } else {
            $user = new Usuario();
            if (!isset($_SESSION['user']['id'])) {
                $id = $_COOKIE['userId'];
            } else {
                $id = $_SESSION['user']['id'];
            }
            
            $userLoged = $user->selectUser($id);
    
            echo $this->view->render("profile",[ "userLoged" => $userLoged ]);
        }
    }

}
