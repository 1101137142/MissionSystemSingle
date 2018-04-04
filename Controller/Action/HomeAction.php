<?php

class HomeAction implements actionPerformed {

    public function actionPerformed($event) {
        $HomeModel = new HomeModel();
        $doHomeAction = $_POST["doHomeAction"];
        switch ($doHomeAction) {
            case 'getPoint':
                $returnData=$HomeModel->getPoint()->fetch(PDO::FETCH_ASSOC);
                break;
        }
        echo json_encode($returnData, true);
    }

}

?>
