<?php

class ShopModel extends Model {

    function selectShopCommodity() {
        $sql_search = "SELECT * FROM `mss_shopstore` WHERE `CommodityStatus`='1'";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }

    function selectCommodityList() {
        $sql_search = "SELECT * FROM `mss_shopstore` ";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }

    function selectEditCommodity($ID) {
        $sql_search = "SELECT * FROM `mss_shopstore` WHERE CommodityID=:CommodityID";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':CommodityID' => $ID));
        return $stmt_search;
    }
    
    function doCreateCommodity($POST) {
        $add_field_arr = array(
            'CommodityName'
            , 'CommodityDetails'
            , 'CommodityCreateTime'
            , 'CommodityStartTime'
            , 'CommodityImgScr'
            , 'CommodityQuantity'
            , 'CommodityPoint'
            , 'CommodityMoney'
            , 'CommodityPrice'
            , 'CommodityDeadline'
            , 'CommodityStatus'
        );
        $fields = '';
        $values = '';
        foreach ($add_field_arr as $val) {
            $fields .= " `$val` ,";
            switch ($val) {
                case 'CommodityCreateTime':
                    $values .= " NOW() ,";
                    break;
                case 'CommodityStatus':
                    $values .= " 0 ,";
                    break;
                case 'CommodityDetails':
                case 'CommodityImgScr':
                case 'CommodityDeadline':
                    if (@$_POST[$val] == '') {
                        $values .= "NULL,";
                    } else {
                        $values .= " :$val ,";
                        $val_arr[':' . $val] = $_POST[$val];
                    }
                    break;
                default:
                    if ($_POST[$val] == '') {
                        $values .= " '',";
                    } else {
                        $values .= " :$val ,";
                        $val_arr[':' . $val] = $_POST[$val];
                    }

                    break;
            }
        }
        $fields = trim($fields, ',');
        $values = trim($values, ',');


        $sql_insert = "INSERT into `mss_shopstore` ($fields) VALUES ($values);";
        $stmt_insert = $this->cont->prepare($sql_insert);
        $status[] = $stmt_insert->execute($val_arr);
        $last_id = $this->cont->lastInsertId();
        $sql_search = "SELECT * FROM `mss_shopstore` where CommodityID=:CommodityID";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':CommodityID' => $last_id));
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function doEditCommodity($POST) {
        $setValue = '';
        $CommodityID = $POST['CommodityID'];
        $sql_search = "SELECT * FROM `mss_shopstore` WHERE CommodityID=:CommodityID ";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':CommodityID' => $CommodityID));
        $row_search = $stmt_search->fetchAll(PDO::FETCH_ASSOC);
        $CommodityStartTime = $row_search[0]['CommodityStartTime'];
        $CommodityStartTime = str_replace(" ", "T", $CommodityStartTime);
            /*`CommodityID`, `CommodityName`, `CommodityDetail`, 
             * `CommodityCreateTime`, `CommodityStartTime`, `CommodityImgScr`, 
             * `CommodityQuantity`, `CommodityPoint`, `CommodityMoney`, 
             * `CommodityPrice`, `CommodityBuyTime`, `CommodityDeadline`, 
             * `CommodityStatus`*/
        foreach ($POST as $key => $value) {
            switch ($key) {
                case 'CommodityID':
                case 'doCommodityAction':
                    break;
                case 'CommodityDetails':
                case 'CommodityDeadline':
                case 'CommodityImgScr':
                    if ($value == '') {
                        $setValue .= "`" . $key . "`=NULL,";
                    } else {
                        $setValue .= "`" . $key . "`='" . $value . "',";
                    }
                    break;
                default:
                    $setValue .= "`" . $key . "`='" . $value . "',";
                    break;
            }
        }

        $setValue = trim($setValue, ',');
        $sql_update = "UPDATE `mss_shopstore` set " . $setValue . " WHERE CommodityID=:CommodityID";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':CommodityID' => $CommodityID)); 

        return $status;
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
            $CommodityMsg = 'true';
        } else {
            $this->cont->rollback();
            $CommodityMsg = 'false';
        }
        return $CommodityMsg;
    }

    function unbuyCommodity($CommodityID) {
        $sql_search = "SELECT * FROM `mss_shopstore` WHERE `CommodityID`=:CommodityID";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':CommodityID' => $CommodityID));
        $row_search = $stmt_search->fetch(PDO::FETCH_ASSOC);
        $this->cont->beginTransaction();

        $sql_update = "UPDATE `mss_point` set `LastPoint`=`LastPoint`+:CommodityPoint,`LastMoney`=`LastMoney`+:CommodityMoney WHERE PlayerID='1' ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':CommodityPoint' => $row_search['CommodityPoint'], ':CommodityMoney' => $row_search['CommodityMoney']));

        $sql_update = "UPDATE `mss_shopstore` set `CommodityQuantity`=`CommodityQuantity`+1,`CommodityBuyTime`=NULL WHERE CommodityID=:CommodityID ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':CommodityID' => $CommodityID));

        $sql_update = "UPDATE `mss_shopstore` set `CommodityStatus`='1' WHERE 0 < `CommodityQuantity` ";
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
            $CommodityMsg = 'true';
        } else {
            $this->cont->rollback();
            $CommodityMsg = 'false';
        }
        return $CommodityMsg;
    }

}
