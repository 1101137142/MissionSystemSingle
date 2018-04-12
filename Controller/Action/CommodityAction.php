<?php

class CommodityAction implements actionPerformed {

    public function actionPerformed($event) {
        
        $ShopModel = new ShopModel();
        $CommodityID = $_POST["CommodityID"];
        $doCommodityAction = $_POST["doCommodityAction"];
        switch ($doCommodityAction) {
            case 'buyCommodity':
                $returnData = $ShopModel->buyCommodity($CommodityID);
                break;
        }
        echo json_encode($returnData, true);
    }

}
