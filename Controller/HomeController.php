<?php

require_once('Cool/BaseController.php');
require_once('Model/HomeManager.php');

class HomeController extends BaseController
{

    public function messageAction()
    {
        $data= json_decode(file_get_contents('php://input'), true);
        if(isset($_SESSION['username'])) {

            $manager = new HomeManager();
            if(count($data) == 1){
                $username = $_SESSION['username'];
                $message = $data['content'];
                $creation = date('Y-m-d H:i:s');
                $manager->sendMessage($message, $creation, $username);
                $result['success'] = 'ok';
                return json_encode($result);

            } else {
                return json_encode($manager->getMessage());
            }
        }
        else {
            return $this->redirect('?action=hall');
        }
    }

    function pageAction()
    {
        if(isset($_SESSION['username'])) {
            $arr = [
                'user' => $_SESSION
            ];
            return $this->render('home.html.twig', $arr);
        }
        else {
            return $this->redirect('?action=hall');
        }

    }
}