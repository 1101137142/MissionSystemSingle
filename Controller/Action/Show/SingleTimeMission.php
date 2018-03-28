<?php

class SingleTimeMission implements actionPerformed {

    public function actionPerformed($event) {
        $MissionModel = new MissionModel();
        foreach ($MissionModel->selectSingleTimeMission() as $row) {
            /* `MissionID`, `MissionName`, `MissionDetails`, `MissionPoint`,
              `MissionCreateTime`, `MissionStartTime`, `MissionLastFinishTime`,
              `MissionRefreshTime`, `MissionEndTime`, `MissionFinishQuantity`,
              `MissionRefreshQuantity`, `MissionStatus`, `MissionEndQuantity`,
              `MissionPeriod`, `MissionPeriodList`, `MissionAttribute` */

            switch ($row['MissionStatus']) {
                case 0:
                    if (strtotime($row['MissionEndTime']) > strtotime($row['MissionStartTime'])) {
                        $percentage = round((strtotime('now') - strtotime($row['MissionStartTime'])) / (strtotime($row['MissionEndTime']) - strtotime($row['MissionStartTime'])), 2) * 100;
                    } else {
                        $percentage = 0;
                    }
                    $ProcessingMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionDetails' => $row['MissionDetails'],
                        'MissionPoint' => $row['MissionPoint'],
                        'MissionStartTime' => $row['MissionStartTime'],
                        'MissionEndTime' => $row['MissionEndTime'],
                        'percentage' => $percentage);
                    break;
                case 2:
                    if (strtotime($row['MissionEndTime']) > strtotime($row['MissionStartTime'])) {
                        $percentage = round((strtotime($row['MissionLastFinishTime']) - strtotime($row['MissionStartTime'])) / (strtotime($row['MissionEndTime']) - strtotime($row['MissionStartTime'])), 2) * 100;
                    } else {
                        $percentage = 0;
                    }
                    $FinishMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionDetails' => $row['MissionDetails'],
                        'MissionPoint' => $row['MissionPoint'],
                        'MissionLastFinishTime' => $row['MissionLastFinishTime'],
                        'MissionEndTime' => $row['MissionEndTime'],
                        'percentage' => $percentage);
                    break;
                default :
                    break;
            }
        }


        $smarty = new KSmarty();
        @$smarty->assign("ProcessingMission", $ProcessingMission);
        @$smarty->assign("FinishMission", $FinishMission);
        return $smarty->fetch("SingleTimeMission.tpl");
    }

}

?>