<?php

class ShopStore implements actionPerformed {

    public function actionPerformed($event) {
        $ShopModel = new ShopModel();
        foreach ($ShopModel->selectShopCommodity() as $row) {
            /*`CommodityID`, `CommodityName`, `CommodityDetail`, 
             * `CommodityCreateTime`, `CommodityStartTime`, `CommodityImgScr`, 
             * `CommodityQuantity`, `CommodityPoint`, `CommodityMoney`, 
             * `CommodityPrice`, `CommodityBuyTime`, `CommodityDeadline`, 
             * `CommodityStatus`*/

            $CommodityInfo[] = array(
                'CommodityID' => $row['CommodityID'],
                'CommodityName' => $row['CommodityName'],
                'CommodityDetails' => $row['CommodityDetails'],
                'CommodityImgScr' => $row['CommodityImgScr'],
                'CommodityPoint' => $row['CommodityPoint'],
                'CommodityMoney' => $row['CommodityMoney'],
                'CommodityPrice' => $row['CommodityPrice'],
                'CommodityQuantity' => $row['CommodityQuantity']);
        }


        $smarty = new KSmarty();
        @$smarty->assign("CommodityInfo", $CommodityInfo);
        return $smarty->fetch("ShopStore.tpl");
    }

}

?>