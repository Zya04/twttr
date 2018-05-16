<?php

require_once('Cool/BaseController.php');
require_once('Model/UserManager.php');

class UserController extends BaseController
{
    public function userAction()
    {
        if (isset($_SESSION['user_id'])){
            $id = $_GET['user_id'];
            return $this -> redirect ('?action=profile&id='.$id);
        }
    }

    public function profileAction()
    {
        if (isset($_SESSION['username'])) {
            $arr = [
                'user' => $_SESSION
            ];
            return $this->render('profile.html.twig', $arr);
        }
        else {
            return $this->redirect('?action=hall');
        }
           
    }
}