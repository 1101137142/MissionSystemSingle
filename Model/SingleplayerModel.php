<?php

class SingleplayerModel extends Model {

    function SelectPlayerScore($ID) {
        $sql = "SELECT `PlayerScore` FROM `missionsystem_players` WHERE PlayerID=?";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute(array($ID));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function CreateMission($Name, $Point, $Period, $StartTime, $EndTime, $MissionEndQuantity, $MissionAttribute, $MissionPeriodList) {
        if ($EndTime != '') {
            
            switch($MissionPeriodList){
                case '1':
                    $MissionValidityQuantity=round((strtotime($EndTime)-strtotime($StartTime))/($Period*60*60),0);//結束時間-開始時間 整除 周期時間 得出周期次數 
                    break;
                case '2':
                    $MissionValidityQuantity=round((strtotime($EndTime)-strtotime($StartTime))/($Period*60*60*24),0);//結束時間-開始時間 整除 周期時間 得出周期次數 
                    break;
                case '3':
                    $MissionValidityQuantity=round((strtotime($EndTime)-strtotime($StartTime))/($Period*60*60*24*7),0);//結束時間-開始時間 整除 周期時間 得出周期次數 
                    break;
                case '4':
                    $MissionValidityQuantity=round((strtotime($EndTime)-strtotime($StartTime))/($Period*60*60*24*365),0);//結束時間-開始時間 整除 周期時間 得出周期次數 
                    break;
            }
            $EndTime = "'" . $EndTime . "'";
            //$MissionValidityQuantity="'".$MissionValidityQuantity."'";
        } else {
            $EndTime = 'NULL';
            $MissionValidityQuantity='NULL';
        }
        if ($MissionEndQuantity != '') {
            $MissionEndQuantity = "'" . $MissionEndQuantity . "'";
        } else {
            $MissionEndQuantity = 'NULL';
        }
        try {
            $this->cont->beginTransaction();
            $sql = "SELECT MAX(MissionID)+1 as MissionID FROM `missionsystem_missionlist`";
            $stmt = $this->cont->prepare($sql);
            $status = $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $MissionID = $result['MissionID'];
            if ($StartTime == '' || $StartTime == NULL) {
                $date = date("Y-m-d");
                $Udate = strtotime($date);
                $StartTime = date("Y-m-d H:i:s", $Udate);
            };
            //$StartTime = date('Y-m-d H:i:s');
            $sqlx = "INSERT INTO `missionsystem_missionlist`( `MissionID`,`MissionName`, `MissionPoint`, `MissionCreateTime`,`MissionValidityQuantity`,`MissionEndQuantity`,`MissionPeriod`,`MissionPeriodList`, `MissionAttribute`,`MissionCreater`) VALUES ('" . $MissionID . "','" . $Name . "'," . $Point . ",CURRENT_TIMESTAMP, " .$MissionValidityQuantity. " , " . $MissionEndQuantity . " ,'" . $Period . "','" . $MissionPeriodList . "','" . $MissionAttribute . "'," . $_SESSION['PlayerID'] . ")";
            $stmtx = $this->cont->prepare($sqlx);
            $statusx = $stmtx->execute();
            $sqly = "INSERT INTO `missionsystem_finishstatus`( `MissionID`,`StartTime`,`EndTime`, `Owner`) VALUES ('" . $MissionID . "','" . $StartTime . "'," . $EndTime . ",'" . $_SESSION['PlayerID'] . "')";
            $stmty = $this->cont->prepare($sqly);
            $statusy = $stmty->execute();
            if ($statusx && $statusy) {
                $this->cont->commit();
                $sqls = "SELECT T1.`MissionID`,T1.`MissionName`,T1.`MissionPoint`,T2.`EndTime`,T1.MissionPeriod,T2.`LastFinishTime`,T2.`FinishQuantity`,T2.`Status` FROM `missionsystem_missionlist` T1 LEFT JOIN `missionsystem_finishstatus` T2 on T1.MissionID=T2.MissionID WHERE T1.`MissionID`=:MissionID  AND T2.`Owner`=:Owner";
                $stmts = $this->cont->prepare($sqls);
                $statuss = $stmts->execute(array(':MissionID' => $MissionID, ':Owner' => $_SESSION['PlayerID']));

                return $stmts;
            } else {
                $this->cont->rollback();

                return '0';
            }
        } catch (Exception $e) {
            $this->cont->rollback();
            return 'ERR';
        }
    }

    function SelectKPIMission() {
        $sql = "SELECT T1.`MissionID`,T1.MissionName,T1.MissionPoint,T2.EndTime,
            T2.StartTime,T2.`RefreshTime`,T1.`MissionPeriod`,T1.`MissionPeriodList`,
            T2.`RowID`,T2.LastFinishTime,T2.FinishQuantity,T2.Status
            FROM `missionsystem_missionlist` T1 
                LEFT JOIN `missionsystem_finishstatus` T2 ON T1.MissionID=T2.MissionID 
            WHERE T2.owner='" . $_SESSION['PlayerID'] . "'";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if (strtotime($row['EndTime']) == '') {
                $EndTime = strtotime("now") + 1000;
            } else {
                $EndTime = strtotime($row['EndTime']);
            }
            $refresh = false;
            if ($row['RefreshTime'] == NULL || $row['RefreshTime'] == '') {
                $RefreshTime = strtotime($row['StartTime']);
                $refresh = true;
            } else {
                $RefreshTime = strtotime($row['RefreshTime']);   //轉換成UNIX時間格式
            }
            $RefreshQuantity = 0;
            if ($row['Status'] == '1' || $row['Status'] == '0') {
                if (strtotime("now") >= $EndTime) {
                    $sqlu = "UPDATE `missionsystem_finishstatus` T1 SET  T1.`Status` = 2 WHERE T1.`RowID` = '" . $row['RowID'] . "'";
                    $stmtu = $this->cont->prepare($sqlu);
                    $statusu = $stmtu->execute();
                } else {
                    switch ($row['MissionPeriodList']) {    //判斷更新的時間單位
                        case '1':
                            while (strtotime("now") >= $RefreshTime + (60 * 60 * $row['MissionPeriod'])) {
                                $RefreshTime = $RefreshTime + (60 * 60 * $row['MissionPeriod']);
                                $RefreshQuantity = $RefreshQuantity + 1;
                                $refresh = true;
                            };
                            break;
                        case '2':
                            while (strtotime("now") >= $RefreshTime + (60 * 60 * 24 * $row['MissionPeriod'])) {
                                $RefreshTime = $RefreshTime + (60 * 60 *24* $row['MissionPeriod']);
                                $RefreshQuantity = $RefreshQuantity + 1;
                                $refresh = true;
                            };
                            break;
                        case '3':
                            while (strtotime("now") >= $RefreshTime + (60 * 60 * 24 * 7 * $row['MissionPeriod'])) {
                                $RefreshTime = $RefreshTime + (60 * 60 *24*7* $row['MissionPeriod']);
                                $RefreshQuantity = $RefreshQuantity + 1;
                                $refresh = true;
                            };
                            break;
                        case '4':
                            while (strtotime("now") >= mktime(date("G", $RefreshTime), date("i", $RefreshTime), date("s", $RefreshTime), date("m", $RefreshTime), date("d", $RefreshTime), date("Y", $RefreshTime) + $row['MissionPeriod'])) {
                                $RefreshTime = mktime(date("G", $RefreshTime), date("i", $RefreshTime), date("s", $RefreshTime), date("m", $RefreshTime), date("d", $RefreshTime), date("Y", $RefreshTime) + $row['MissionPeriod']);
                                $RefreshQuantity = $RefreshQuantity + 1;
                                $refresh = true;
                            };
                            break;
                        default:
                            break;
                    }
                    if ($refresh == true) {
                        $RefreshTime = date("Y-m-d H:i:s", $RefreshTime);
                        $sqlu = "UPDATE `missionsystem_finishstatus` SET `RefreshTime` = '" . $RefreshTime . "' ,`RefreshQuantity`= RefreshQuantity+$RefreshQuantity , `Status` = 0 WHERE `missionsystem_finishstatus`.`RowID` = '" . $row['RowID'] . "'";
                        $stmtu = $this->cont->prepare($sqlu);
                        $statusu = $stmtu->execute();
                    };
                }
            }
        };
        $sqlu = "UPDATE `missionsystem_finishstatus` T1 join `missionsystem_missionlist` T2 on T1.MissionID=T2.MissionID SET  T1.`Status` = 2 WHERE  T1.FinishQuantity>=T2.MissionEndQuantity";
        $stmtu = $this->cont->prepare($sqlu);
        $statusu = $stmtu->execute();
        $sql = "SELECT T1.`MissionID`,T1.`MissionName`,T1.`MissionPoint`,T2.`EndTime`,T2.`RefreshTime`,T1.`MissionPeriod`,T1.`MissionPeriodList`,
            T2.`RowID`,T2.LastFinishTime,T2.FinishQuantity,T1.MissionEndQuantity,T2.Status,T1.MissionCreater
            FROM `missionsystem_missionlist` T1 
                LEFT JOIN `missionsystem_finishstatus` T2 ON T1.MissionID=T2.MissionID 
            WHERE T2.owner='" . $_SESSION['PlayerID'] . "' AND MissionAttribute='1' Order by T1.`MissionPeriodList` ASC,T1.`MissionPeriod` ASC,T2.RowID ASC";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
      function SelectFinishKPIMission() {
      $sql = "SELECT `MissionID`,`MissionName`,`MissionPoint`,`MissionFinishQuantity`,`MissionStatus`,`MissionPeriod` FROM `missionsystem_missionlist` WHERE MissionKPI=1 and MissionStatus=1";
      $stmt = $this->cont->prepare($sql);
      $status = $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
     */
    /*
      function selectNewCreateMission($Name, $Point, $Period) {
      $sql = "SELECT `MissionID`,`MissionName`,`MissionPoint`,`MissionFinishQuantity`,`MissionStatus`,`MissionPeriod` FROM `missionsystem_missionlist` WHERE MissionKPI=1 and MissionName=" . $Name . " and MissionPoint=" . $Point . " and MissionPeriod=" . $Period;
      $stmt = $this->cont->prepare($sql);
      $status = $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
      } */

    function FinishKPIMission($ID) {
        $this->cont->beginTransaction();
        $sql = "UPDATE `missionsystem_finishstatus` SET `LastFinishTime` = CURRENT_TIMESTAMP, `FinishQuantity` = FinishQuantity+1, `Status` = '1' WHERE `missionsystem_finishstatus`.`RowID` = '" . $ID . "' and `Status`=0";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        $sqlA = "SELECT `MissionPoint` FROM `missionsystem_missionlist` T1 JOIN `missionsystem_finishstatus` T2 ON T1.`MissionID`=T2.`MissionID` WHERE RowID='" . $ID . "'";
        $stmtA = $this->cont->prepare($sqlA);
        $statusA = $stmtA->execute();
        $MissionPoint = 0;
        foreach ($stmtA->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $MissionPoint = $row['MissionPoint'];
        }
        $sqlB = "UPDATE `missionsystem_players` SET `PlayerScore`=`PlayerScore`+" . $MissionPoint . " WHERE `PlayerID`= '" . $_SESSION['PlayerID'] . "' ";
        $stmtB = $this->cont->prepare($sqlB);
        $statusB = $stmtB->execute();
        if ($status && $statusB) {
            $this->cont->commit();
            $sql = "UPDATE `missionsystem_finishstatus` T1 left join `missionsystem_missionlist` T2 on T1.MissionID=T2.MissionID  SET  `Status` = '2' WHERE T1.`RowID` = '" . $ID . "' and T1.`FinishQuantity`>=T2.`MissionEndQuantity`";
            $stmt = $this->cont->prepare($sql);
            $status = $stmt->execute();
            $Ajaxstatus = 'true';
        } else {
            $this->cont->rollback();
            $Ajaxstatus = 'false';
        }

        return $Ajaxstatus;
        //return false;
    }

    function DelectKPIMission($ID) {
        $sql = "SELECT MissionID FROM `missionsystem_finishstatus` WHERE `RowID`='" . $ID . "'";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $MissionID = $row['MissionID'];
        }

        $sql = "DELETE FROM `missionsystem_finishstatus` WHERE `RowID`='" . $ID . "'";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();


        $sql = "SELECT T1.`MissionID`,COUNT(RowID) as Count FROM missionsystem_missionlist T1 LEFT JOIN missionsystem_finishstatus T2 ON T1.MissionID=T2.MissionID where T1.MissionID='" . $MissionID . "'  GROUP BY T1.MissionID ";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if ($row['Count'] == '0') {
                $sqlx = "DELETE FROM `missionsystem_missionlist` WHERE `MissionID` = '" . $row['MissionID'] . "'";
                $stmtx = $this->cont->prepare($sqlx);
                $statusx = $stmtx->execute();
            }
        }

        return $status;
    }

    function UnfinishKPIMission($ID) {
        $this->cont->beginTransaction();
        $sql = "UPDATE `missionsystem_finishstatus` SET `FinishQuantity` = FinishQuantity-1,`Status` = '0',`LastFinishTime` = NULL WHERE `RowID`=" . $ID . " and `Status`=1";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        $sqlA = "SELECT `MissionPoint` FROM `missionsystem_missionlist` T1 JOIN `missionsystem_finishstatus` T2 ON T1.`MissionID`=T2.`MissionID` WHERE RowID='" . $ID . "'";
        $stmtA = $this->cont->prepare($sqlA);
        $statusA = $stmtA->execute();
        $MissionPoint = 0;
        foreach ($stmtA->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $MissionPoint = $row['MissionPoint'];
        }
        $sqlB = "UPDATE `missionsystem_players` SET `PlayerScore`=`PlayerScore`-" . $MissionPoint . " WHERE `PlayerID`= '" . $_SESSION['PlayerID'] . "' ";
        $stmtB = $this->cont->prepare($sqlB);
        $statusB = $stmtB->execute();
        if ($status && $statusB) {
            $this->cont->commit();
        } else {
            $this->cont->rollback();
        }
        return $status;
    }

    function SelectMissionAndPoint() {
        $sql = "SELECT T1.`MissionID`,T1.MissionName,T1.MissionPoint,T2.EndTime,
            T2.StartTime,T2.`RefreshTime`,T1.`MissionPeriod`,T1.`MissionPeriodList`,
            T2.`RowID`,T2.LastFinishTime,T2.FinishQuantity,T2.Status
            FROM `missionsystem_missionlist` T1 
                LEFT JOIN `missionsystem_finishstatus` T2 ON T1.MissionID=T2.MissionID 
            WHERE T2.owner='" . $_SESSION['PlayerID'] . "'";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if (strtotime($row['EndTime']) == '') {
                $EndTime = strtotime("now") + 1000;
            } else {
                $EndTime = strtotime($row['EndTime']);
            }
            if ($row['Status'] == '1' || $row['Status'] == '0') {
                if (strtotime("now") >= $EndTime) {
                    $sqlu = "UPDATE `missionsystem_finishstatus` T1 SET  T1.`Status` = 2 WHERE T1.`RowID` = '" . $row['RowID'] . "'";
                    $stmtu = $this->cont->prepare($sqlu);
                    $statusu = $stmtu->execute();
                }
            }
        };
        $sqlu = "UPDATE `missionsystem_finishstatus` T1 join `missionsystem_missionlist` T2 on T1.MissionID=T2.MissionID SET  T1.`Status` = 2 WHERE  T1.FinishQuantity>=T2.MissionEndQuantity";
        $stmtu = $this->cont->prepare($sqlu);
        $statusu = $stmtu->execute();
        $sql = "SELECT T1.`MissionID`,T1.`MissionName`,T1.`MissionPoint`,T2.`StartTime`,T2.`EndTime`,T2.`RefreshTime`,T1.`MissionPeriod`,T1.`MissionPeriodList`,
            T2.`RowID`,T2.LastFinishTime,T2.FinishQuantity,T1.MissionEndQuantity,T2.Status
            FROM `missionsystem_missionlist` T1 
                LEFT JOIN `missionsystem_finishstatus` T2 ON T1.MissionID=T2.MissionID 
            WHERE T2.owner='" . $_SESSION['PlayerID'] . "' AND MissionAttribute='2'";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function FinishMission($ID){
        
        $this->cont->beginTransaction();
        $sql = "UPDATE `missionsystem_finishstatus` SET `LastFinishTime` = CURRENT_TIMESTAMP, `FinishQuantity` = FinishQuantity+1, `Status` = '2' WHERE `missionsystem_finishstatus`.`RowID` = '" . $ID . "' and `Status`=0";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        $sqlA = "SELECT `MissionPoint` FROM `missionsystem_missionlist` T1 JOIN `missionsystem_finishstatus` T2 ON T1.`MissionID`=T2.`MissionID` WHERE RowID='" . $ID . "'";
        $stmtA = $this->cont->prepare($sqlA);
        $statusA = $stmtA->execute();
        $MissionPoint = 0;
        foreach ($stmtA->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $MissionPoint = $row['MissionPoint'];
        }
        $sqlB = "UPDATE `missionsystem_players` SET `PlayerScore`=`PlayerScore`+" . $MissionPoint . " WHERE `PlayerID`= '" . $_SESSION['PlayerID'] . "' ";
        $stmtB = $this->cont->prepare($sqlB);
        $statusB = $stmtB->execute();
        if ($status && $statusB) {
            $this->cont->commit();
            $Ajaxstatus = 'true';
        } else {
            $this->cont->rollback();
            $Ajaxstatus = 'false';
        }

        return $Ajaxstatus;
    }
    
    function UnfinishMission($ID) {
        $this->cont->beginTransaction();
        $sql = "UPDATE `missionsystem_finishstatus` SET `FinishQuantity` = FinishQuantity-1,`Status` = '0',`LastFinishTime` = NULL WHERE `RowID`=" . $ID . " and `Status`=2";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        $sqlA = "SELECT `MissionPoint` FROM `missionsystem_missionlist` T1 JOIN `missionsystem_finishstatus` T2 ON T1.`MissionID`=T2.`MissionID` WHERE RowID='" . $ID . "'";
        $stmtA = $this->cont->prepare($sqlA);
        $statusA = $stmtA->execute();
        $MissionPoint = 0;
        foreach ($stmtA->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $MissionPoint = $row['MissionPoint'];
        }
        $sqlB = "UPDATE `missionsystem_players` SET `PlayerScore`=`PlayerScore`-" . $MissionPoint . " WHERE `PlayerID`= '" . $_SESSION['PlayerID'] . "' ";
        $stmtB = $this->cont->prepare($sqlB);
        $statusB = $stmtB->execute();
        if ($status && $statusB) {
            $this->cont->commit();
        } else {
            $this->cont->rollback();
        }
        return $status;
    }

}

?>
