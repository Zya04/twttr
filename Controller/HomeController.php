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
                $message = htmlentities($data['content']);
                $creation = date('Y-m-d H:i:s');
                $manager->sendMessage($message, $creation, $username);
                $result['success'] = 'ok';
                $logs = fopen('logs/access.log', 'a+');
                fwrite($logs, $_SESSION['username'].' just write a message at '. $creation."\n");
                fclose($logs);
                return json_encode($result);

            } else {
                return json_encode($manager->getMessage());
            }
        }
        else {
            $logs = fopen('logs/security.log', 'a+');
            fwrite($logs,'Someone just tried to backdoor at '.date('Y-m-d H:i:s')."\n");
            fclose($logs);
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
            $logs = fopen('logs/security.log', 'a+');
            fwrite($logs,'Someone just tried to backdoor at '.date('Y-m-d H:i:s')."\n");
            fclose($logs);
            return $this->redirect('?action=hall');
        }

    }

    function followAction(){
        //var_dump($_SESSION['user_id']);
        //var_dump($_GET['id']);
        if (isset($_GET['id']) AND $_GET['id'] > 0) {
            $getid = intval($_GET['id']);

            $dbm = DBManager::getInstance();
            $pdo = $dbm->getPdo();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :userid");
            $stmt->bindParam(':userid', $getid);
            $stmt->execute();
            $result = $stmt->fetch();
            //var_dump($result);
            
        }
        $manager = new HomeManager();
        $manager -> follow();   
    }
}