<?php

class ShopModel extends Model {

    function selectShopCommodity() {
        $sql_search = "SELECT * FROM `mss_shopstore` WHERE `CommodityStatus`='1'";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }

}
