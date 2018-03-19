<?php


class PreparationsModel extends Model {
    function SelectObjective() {
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
                                $RefreshTime = $RefreshTime + (60 * 60 * $row['MissionPeriod']);
                                $RefreshQuantity = $RefreshQuantity + 1;
                                $refresh = true;
                            };
                            break;
                        case '3':
                            while (strtotime("now") >= $RefreshTime + (60 * 60 * 24 * 7 * $row['MissionPeriod'])) {
                                $RefreshTime = $RefreshTime + (60 * 60 * $row['MissionPeriod']);
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
            T2.`RowID`,T2.LastFinishTime,T2.FinishQuantity,T1.MissionEndQuantity,T2.Status
            FROM `missionsystem_missionlist` T1 
                LEFT JOIN `missionsystem_finishstatus` T2 ON T1.MissionID=T2.MissionID 
            WHERE T2.owner='" . $_SESSION['PlayerID'] . "' AND MissionAttribute='1' Order by T1.`MissionPeriodList` ASC,T1.`MissionPeriod` ASC";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>