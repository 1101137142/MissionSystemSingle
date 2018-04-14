<?php

class CommodityList implements actionPerformed {

    public function actionPerformed($event) {
        $ShopModel = new ShopModel();
        foreach ($ShopModel->selectCommodityList() as $row) {
            /* `CommodityID`, `CommodityName`, `CommodityDetail`, 
             * `CommodityCreateTime`, `CommodityStartTime`, `CommodityImgScr`, 
             * `CommodityQuantity`, `CommodityPoint`, `CommodityMoney`, 
             * `CommodityPrice`, `CommodityBuyTime`, `CommodityDeadline`, 
             * `CommodityStatus`,Commodity
              商品狀態 0:準備中 1:上架中 2:售完 3:下架 9:刪除 */

            switch ($row['CommodityStatus']) {
                case '0':
                    $CommodityStatus = $row['CommodityStatus'] . ' . 準備中';
                    break;
                case '1':
                    $CommodityStatus = $row['CommodityStatus'] . ' . 上架中';
                    break;
                case '2':
                    $CommodityStatus = $row['CommodityStatus'] . ' . 售完';
                    break;
                case '3':
                    $CommodityStatus = $row['CommodityStatus'] . ' . 下架';
                    break;
                case '9':
                    $CommodityStatus = $row['CommodityStatus'] . ' . 刪除';
                    break;
                default :
                    $CommodityStatus = '狀態Err';
                    break;
            }
            $CommodityInfo[] = array(
                'CommodityID' => $row['CommodityID'],
                'CommodityName' => $row['CommodityName'],
                'CommodityDetails' => $row['CommodityDetails'],
                'CommodityStartTime' => $row['CommodityStartTime'],
                'CommodityImgScr' => $row['CommodityImgScr'],
                'CommodityPoint' => $row['CommodityPoint'],
                'CommodityMoney' => $row['CommodityMoney'],
                'CommodityPrice' => $row['CommodityPrice'],
                'CommodityDeadline' => $row['CommodityDeadline'],
                'CommodityStatus' => $row['CommodityStatus'],
                'CommodityQuantity' => $row['CommodityQuantity'],
                'CommodityStatus2'=>$CommodityStatus);
        }


        $smarty = new KSmarty();
        @$smarty->assign("CommodityInfo", $CommodityInfo);
        return $smarty->fetch("CommodityList.tpl");
    }

}

?>