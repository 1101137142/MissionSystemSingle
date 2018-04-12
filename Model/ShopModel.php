<?php

class ShopModel extends Model {

    function selectShopCommodity() {
        $sql_search = "SELECT * FROM `mss_shopstore` WHERE `CommodityStatus`='1'";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }

    /* `CommodityID`, `CommodityName`, `CommodityDetail`, `CommodityCreateTime`,
     *  `CommodityStartTime`, `CommodityImgScr`, `CommodityQuantity`, 
     * `CommodityPoint`, `CommodityMoney`, `CommodityPrice`, 
     * `CommodityBuyTime`, `CommodityDeadline`, `CommodityStatus` */

    function buyCommodity($CommodityID) {
        $sql_search = "SELECT * FROM `mss_shopstore` WHERE `CommodityID`=:CommodityID";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':CommodityID' => $CommodityID));
        $row_search = $stmt_search->fetch(PDO::FETCH_ASSOC);
        $this->cont->beginTransaction();

        $sql_update = "UPDATE `mss_point` set `LastPoint`=`LastPoint`-:CommodityPoint,`LastMoney`=`LastMoney`-:CommodityMoney WHERE PlayerID='1' ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':CommodityPoint' => $row_search['CommodityPoint'], ':CommodityMoney' => $row_search['CommodityMoney']));

        $sql_update = "UPDATE `mss_shopstore` set `CommodityQuantity`=`CommodityQuantity`-1,`CommodityBuyTime`=NOW() WHERE CommodityID=:CommodityID ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':CommodityID' => $CommodityID));

        $sql_update = "UPDATE `mss_shopstore` set `CommodityStatus`='2' WHERE 0 >= `CommodityQuantity` ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':CommodityPoint' => $row_search['CommodityPoint'], ':CommodityMoney' => $row_search['CommodityMoney'], ':CommodityID' => $CommodityID));



        $update = 'Y';
        foreach ($status as $val) {
            if ($val != true) {
                $update = 'N';
            }
        }
        if ($update == 'Y') {
            $this->cont->commit();
            $MissionMsg = 'true';
        } else {
            $this->cont->rollback();
            $MissionMsg = 'false';
        }
        return $MissionMsg;
    }

}
