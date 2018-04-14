<?php

class CommodityAction implements actionPerformed {

    public function actionPerformed($event) {

        $ShopModel = new ShopModel();
        $doCommodityAction = $_POST["doCommodityAction"];
        if ($doCommodityAction != 'doCreateCommodity') {
            $CommodityID = $_POST["CommodityID"];
        }
        switch ($doCommodityAction) {
            case 'buyCommodity':
                $returnData = $ShopModel->buyCommodity($CommodityID);
                break;
            case 'unbuyCommodity':
                $returnData = $ShopModel->unbuyCommodity($CommodityID);
                break;
            case 'EditCommodity':
                $returnData = $ShopModel->selectEditCommodity($CommodityID)->fetch(PDO::FETCH_ASSOC);
                break;
            case 'doEditCommodity':
                $returnData = $ShopModel->doEditCommodity($event->getPost());
                break;
            case 'doCreateCommodity':
                $returnData = $ShopModel->doCreateCommodity($event->getPost());
                break;
        }
        echo json_encode($returnData, true);
    }

}
