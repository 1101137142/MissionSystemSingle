<?php

class HomeModel extends Model {

    function reflashMissionStatus() {
        $sql = "SELECT * FROM `mss_mission`";
        $stmt = $this->cont->prepare($sql);
        $status[] = $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $refresh = false;
            $RefreshTime=strtotime($row['MissionRefreshTime']);
            if ($row['MissionAttribute'] == '1' && ($row['MissionStatus'] == '0' || $row['MissionStatus'] == '1')) {
                if (strtotime("now") >= strtotime($row['MissionEndTime']) && $row['MissionEndTime']!='') {
                    $sql_update = "update `mss_mission` set MissionStatus=2 where `MissionID`=?";
                    $stmt_update = $this->cont->prepare($sql_update);
                    $status[] = $stmt_update->execute(array($row['MissionID']));
                }else if(strtotime("now") >= $RefreshTime){
                    $RefreshQuantity=0;
                    switch ($row['MissionPeriodList']) {
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
                    if($refresh == true){
                        $RefreshTime = date("Y-m-d H:i:s", $RefreshTime);
                        $sql_update = "update `mss_mission` set `MissionStatus`=0 ,`MissionRefreshTime`='".$RefreshTime."',`MissionRefreshQuantity`=MissionRefreshQuantity+$RefreshQuantity where `MissionID`=?";
                        $stmt_update = $this->cont->prepare($sql_update);
                        $status[] = $stmt_update->execute(array($row['MissionID']));
                    }
                }
            }
        }
    }

}
