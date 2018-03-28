<?php

class KPIMission implements actionPerformed {

    public function actionPerformed($event) {
        $MissionModel = new MissionModel();
        foreach ($MissionModel->selectKPIMission() as $row) {
            switch ($row["MissionPeriodList"]) {
                case '1':
                    $MissionPerioList = '小時';
                    $NextRefreshTime = strtotime($row['MissionRefreshTime']) + (60 * 60 * $row['MissionPeriod']);
                    break;
                case '2':
                    $MissionPerioList = '天';
                    $NextRefreshTime = strtotime($row['MissionRefreshTime']) + (60 * 60 * 24 * $row['MissionPeriod']);
                    break;
                case '3':
                    $MissionPerioList = '周';
                    $NextRefreshTime = strtotime($row['MissionRefreshTime']) + (60 * 60 * 24 * 7 * $row['MissionPeriod']);
                    break;
                case '4':
                    $MissionPerioList = '月';
                    $RefreshTime = strtotime($row['MissionRefreshTime']);
                    $NextRefreshTime = mktime(date("G", $RefreshTime), date("i", $RefreshTime), date("s", $RefreshTime), date("m", $RefreshTime) + $row['MissionPeriod'], date("d", $RefreshTime), date("Y", $RefreshTime));
                    break;
                case '5':
                    $MissionPerioList = '年';
                    $RefreshTime = strtotime($row['MissionRefreshTime']);
                    $NextRefreshTime = mktime(date("G", $RefreshTime), date("i", $RefreshTime), date("s", $RefreshTime), date("m", $RefreshTime), date("d", $RefreshTime), date("Y", $RefreshTime) + $row['MissionPeriod']);
                    break;
                default:
                    $MissionPerioList = '';
                    $NextRefreshTime = '';
                    break;
            }
            $NextRefreshTime = date("Y-m-d H:i:s", $NextRefreshTime);
            /* `MissionID`, `MissionName`, `MissionDetails`, `MissionPoint`,
              `MissionCreateTime`, `MissionStartTime`, `MissionLastFinishTime`,
              `MissionRefreshTime`, `MissionEndTime`, `MissionFinishQuantity`,
              `MissionRefreshQuantity`, `MissionStatus`, `MissionEndQuantity`,
              `MissionPeriod`, `MissionPeriodList`, `MissionAttribute` */
            switch ($row['MissionStatus']) {
                case 0:
                    $ProcessingMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionDetails' => $row['MissionDetails'],
                        'MissionPoint' => $row['MissionPoint'],
                        'MissionLastFinishTime' => $row['MissionLastFinishTime'],
                        'NextRefreshTime' => $NextRefreshTime,
                        'MissionPeriod' => $row['MissionPeriod'],
                        'MissionPeriodList' => $MissionPerioList,
                        'MissionFinishQuantity' => $row['MissionFinishQuantity']);
                    break;
                case 1:
                    $FinishMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionDetails' => $row['MissionDetails'],
                        'MissionPoint' => $row['MissionPoint'],
                        'MissionLastFinishTime' => $row['MissionLastFinishTime'],
                        'NextRefreshTime' => $NextRefreshTime,
                        'MissionPeriod' => $row['MissionPeriod'],
                        'MissionPeriodList' => $MissionPerioList, //$row["MissionPeriodList"],                        
                        'MissionFinishQuantity' => $row['MissionFinishQuantity']);
                    break;
                default :
                    break;
            }
        }


        $smarty = new KSmarty();
        @$smarty->assign("ProcessingMission", $ProcessingMission);
        @$smarty->assign("FinishMission", $FinishMission);
        return $smarty->fetch("KPIMission.tpl");
    }

}

?>