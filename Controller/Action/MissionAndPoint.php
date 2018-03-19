<?php

class MissionAndPoint implements actionPerformed {

    public function actionPerformed($event) {
        $SingleplayerModel = new SingleplayerModel();
        foreach ($SingleplayerModel->SelectMissionAndPoint() as $row) {
            switch ($row['Status']) {
                case 0:
                    if ($row['EndTime'] == NULL || $row['EndTime'] == '') {
                        $percentage = '100';
                    } else {
                        $percentage = round((strtotime('now') - strtotime($row['StartTime'])) / (strtotime($row['EndTime']) - strtotime($row['StartTime'])), 2) * 100;
                    }
                    $ProcessingMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionPoint' => $row['MissionPoint'],
                        'StartTime' => $row['StartTime'],
                        'UStartTime' => strtotime($row['StartTime']),
                        'MissionEndTime' => $row['EndTime'],
                        'UMissionEndTime' => strtotime($row['EndTime']),
                        'UNow' => strtotime('now'),
                        'percentage' => $percentage,
                        'RowID' => $row['RowID']);
                    break;
                case 2:
                    if ($row['LastFinishTime'] == NULL || $row['LastFinishTime'] == '') {
                        $percentage = '0';
                    } else if ($row['EndTime'] == NULL || $row['EndTime'] == '') {
                        $percentage = '100';
                    } else {
                        $percentage = round((strtotime($row['LastFinishTime']) - strtotime($row['StartTime'])) / (strtotime($row['EndTime']) - strtotime($row['StartTime'])), 2) * 100;
                    }
                    $EndMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionPoint' => $row['MissionPoint'],
                        'StartTime' => $row['StartTime'],
                        'UStartTime' => strtotime($row['StartTime']),
                        'LastFinishTime' => $row['LastFinishTime'],
                        'ULastFinishTime' => strtotime($row['LastFinishTime']),
                        'MissionEndTime' => $row['EndTime'],
                        'UMissionEndTime' => strtotime($row['EndTime']),
                        'UNow' => strtotime('now'),
                        'percentage' => $percentage,
                        'RowID' => $row['RowID']);

                    break;
                default :
                    break;
            }
        }


        $smarty = new KSmarty();
        @$smarty->assign("ProcessingMission", $ProcessingMission);
        @$smarty->assign("EndMission", $EndMission);
        return $smarty->fetch("MissionAndPoint.tpl");
    }

}

?>
