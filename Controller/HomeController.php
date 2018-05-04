<?php

require_once('Cool/BaseController.php');
require_once('Model/HomeManager.php');

class HomeController extends BaseController
{
    public function messageAction()
    {
        if(isset($_SESSION['username'])) {
            if(isset($_POST['tweetBtn'])
            && isset($_POST['message'])) {
                $message = htmlentities($_POST['message']);
                $creation = date('Y-m-d H:i:s');
                $username = $_SESSION['username'];
                $manager = new HomeManager();
                $manager->sendMessage($message, $creation, $username);
            }
            $manager = new HomeManager();
            $message = $manager->getMessage();
            $arr = [
                'user' => $_SESSION,
                'messages' => $message
            ];
            return $this->render('home.html.twig', $arr);
        }
        else {
            return $this->redirect('?action=hall');
        }
    
    }
    
}