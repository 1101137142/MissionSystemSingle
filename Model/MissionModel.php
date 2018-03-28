<?php

class MissionModel extends Model {

    function createMission($MissionName, $MissionDetails = NULL, $MissionPoint, $MissionStartTime, $MissionEndTime = NULL, $MissionEndQuantity = NULL, $MissionPeriod, $MissionPeriodList, $MissionAttribute) {
        $add_field_arr = array(
            'MissionName'
            , 'MissionDetails'
            , 'MissionPoint'
            , 'MissionStartTime'
            , 'MissionRefreshTime'
            , 'MissionEndTime'
            , 'MissionEndQuantity'
            , 'MissionPeriod'
            , 'MissionPeriodList'
            , 'MissionAttribute'
        );
        $fields = '';
        $values = '';
        foreach ($add_field_arr as $val) {
            $fields .= " `$val` ,";
            switch ($val) {
                case 'MissionRefreshTime':
                    $values .= " '" . $MissionStartTime . "' ,";
                    break;
                case 'MissionEndQuantity':
                case 'MissionEndTime':
                case 'MissionDetails':
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


        $sql_insert = "INSERT into `mss_mission` ($fields) VALUES ($values);";
        $stmt_insert = $this->cont->prepare($sql_insert);
        $status[] = $stmt_insert->execute($val_arr);
        $last_id = $this->cont->lastInsertId();
        $sql_search = "SELECT * FROM `mss_mission` where MissionID=:MissionID";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':MissionID' => $last_id));
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }

    function finishKPIMission($ID) {
        $this->cont->beginTransaction();
        //鎖表
        $sql_search = "SELECT * FROM `mss_mission` WHERE MissionID=:MissionID FOR UPDATE";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':MissionID' => $ID));
        $row_search = $stmt_search->fetchAll(PDO::FETCH_ASSOC);
        $MissionPoint = $row_search[0]['MissionPoint'];
        $nowTime = date("Y-m-d H:i:s");
        //更新任務狀態 如果結束次數不為空 且已完成次數+1大於等於結束次數時 更改狀態為結束  條件不成立時則更改狀態為完成
        if ($row_search[0]['MissionEndQuantity'] != '' && $row_search[0]['MissionEndQuantity'] <= $row_search[0]['MissionFinishQuantity'] + 1) {
            $sql_update = "UPDATE `mss_mission` set `MissionStatus`=2,`MissionFinishQuantity`=`MissionFinishQuantity`+1,`MissionLastFinishTime`=:MissionLastFinishTime WHERE MissionID=:MissionID and MissionStatus='0'";
        } else {
            $sql_update = "UPDATE `mss_mission` set `MissionStatus`=1,`MissionFinishQuantity`=`MissionFinishQuantity`+1,`MissionLastFinishTime`=:MissionLastFinishTime WHERE MissionID=:MissionID and MissionStatus='0'";
        }
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':MissionID' => $ID, ':MissionLastFinishTime' => $nowTime));

        //增加任務點數到表中
        $sql_update = "UPDATE `mss_point` set `LastPoint`=`LastPoint`+$MissionPoint,`TotalPoint`=`TotalPoint`+$MissionPoint WHERE PlayerID='1' ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute();
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

    function unfinishKPIMission($ID) {
        $this->cont->beginTransaction();
        //鎖表
        $sql_search = "SELECT * FROM `mss_mission` WHERE MissionID=:MissionID FOR UPDATE";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':MissionID' => $ID));
        $row_search = $stmt_search->fetchAll(PDO::FETCH_ASSOC);
        $MissionPoint = $row_search[0]['MissionPoint'];
        //將任務回歸為未完成狀態 並扣除完成次數
        $sql_update = "UPDATE `mss_mission` set `MissionStatus`=0,`MissionFinishQuantity`=`MissionFinishQuantity`-1,`MissionLastFinishTime`=NULL WHERE `MissionID`=:MissionID and (`MissionStatus`='0' or `MissionStatus`='1')";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':MissionID' => $ID));

        //從表中扣除任務點數
        $sql_update = "UPDATE `mss_point` set `LastPoint`=`LastPoint`-$MissionPoint,`TotalPoint`=`TotalPoint`-$MissionPoint WHERE PlayerID='1' ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute();
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

    function finishSingleTimeMission($ID) {
        $this->cont->beginTransaction();
        //鎖表
        $sql_search = "SELECT * FROM `mss_mission` WHERE MissionID=:MissionID FOR UPDATE";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':MissionID' => $ID));
        $row_search = $stmt_search->fetchAll(PDO::FETCH_ASSOC);
        $MissionPoint = $row_search[0]['MissionPoint'];
        if (strtotime($row_search[0]['MissionStartTime']) < strtotime('now')) {
            $MissionPoint = round($MissionPoint * (((strtotime($row_search[0]['MissionEndTime']) - strtotime('now')) / (strtotime($row_search[0]['MissionEndTime']) - strtotime($row_search[0]['MissionStartTime']))) + 1), 0);
        } else {
            $MissionPoint = $MissionPoint * 2;
        }
        $nowTime = date("Y-m-d H:i:s");
        $sql_update = "UPDATE `mss_mission` set `MissionStatus`=2,`MissionFinishQuantity`=`MissionFinishQuantity`+1,`MissionLastFinishTime`=:MissionLastFinishTime WHERE MissionID=:MissionID and MissionStatus='0'";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':MissionID' => $ID, ':MissionLastFinishTime' => $nowTime));

        //增加任務點數到表中
        $sql_update = "UPDATE `mss_point` set `LastPoint`=`LastPoint`+$MissionPoint,`TotalPoint`=`TotalPoint`+$MissionPoint WHERE PlayerID='1' ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute();
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

    function unfinishSingleTimeMission($ID) {
        $this->cont->beginTransaction();
        //鎖表
        $sql_search = "SELECT * FROM `mss_mission` WHERE MissionID=:MissionID FOR UPDATE";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute(array(':MissionID' => $ID));
        $row_search = $stmt_search->fetchAll(PDO::FETCH_ASSOC);
        $MissionPoint = $row_search[0]['MissionPoint'];
        if (strtotime($row_search[0]['MissionStartTime']) < strtotime($row_search[0]['MissionLastFinishTime'])) {
            $MissionPoint = round($MissionPoint * (((strtotime($row_search[0]['MissionEndTime']) - strtotime($row_search[0]['MissionLastFinishTime'])) / (strtotime($row_search[0]['MissionEndTime']) - strtotime($row_search[0]['MissionStartTime']))) + 1), 0);
        } else {
            $MissionPoint = $MissionPoint * 2;
        }
        //將任務回歸為未完成狀態 並扣除完成次數
        $sql_update = "UPDATE `mss_mission` set `MissionStatus`=0,`MissionFinishQuantity`=`MissionFinishQuantity`-1,`MissionLastFinishTime`=NULL WHERE `MissionID`=:MissionID and `MissionStatus`='2' ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':MissionID' => $ID));

        //從表中扣除任務點數
        $sql_update = "UPDATE `mss_point` set `LastPoint`=`LastPoint`-$MissionPoint,`TotalPoint`=`TotalPoint`-$MissionPoint WHERE PlayerID='1' ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute();
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

    function delectMission($ID) {
        //更改任務狀態為 9 刪除
        $sql_update = "UPDATE `mss_mission` set `MissionStatus`='9' WHERE `MissionID`=:MissionID ";
        $stmt_update = $this->cont->prepare($sql_update);
        $status[] = $stmt_update->execute(array(':MissionID' => $ID));

        $MissionMsg = 'true';
        return $MissionMsg;
    }

    function selectMissionList() {
        $sql_search = 'SELECT * FROM `mss_mission` ';
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search;
    }

    function selectKPIMission() {
        $sql_search = "SELECT * FROM `mss_mission` WHERE ( `MissionAttribute`='1' or `MissionAttribute`='2' ) AND `MissionStartTime`<=now() ORDER BY MissionPeriodList ASC,MissionPeriod ASC,MissionID ASC ";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search;
    }

    function selectSingleTimeMission() {
        $sql_search = "SELECT * FROM `mss_mission` WHERE `MissionAttribute`='3'  ORDER BY MissionLastFinishTime DESC,MissionID ASC";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search;
    }

}
