<?php

class Objective implements actionPerformed {

    public function actionPerformed($event) {
        $PreparationsModel = new PreparationsModel();
        foreach ($PreparationsModel->SelectObjective() as $row) {
            switch ($row["MissionPeriodList"]) {
                            case '1':
                                $MissionPerioList='小時';
                                break;
                            case '2':
                                $MissionPerioList='天';
                                break;
                            case '3':
                                $MissionPerioList='月';
                                break;
                            case '4':
                                $MissionPerioList='年';
                                break;
                            default:
                                $MissionPerioList='';
                                break;
                        }
            switch ($row['Status']) {
                case 0:
                    $ProcessingMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionPoint' => $row['MissionPoint'],
                        'MissionEndTime' => $row['EndTime'],
                        'MissionPeriod' => $row['MissionPeriod'],
                        'MissionPeriodList' => $MissionPerioList,//$row["MissionPeriodList"],
                        'RowID' => $row['RowID'],
                        'LastFinishTime' => $row['LastFinishTime'],
                        'FinishQuantity' => $row['FinishQuantity'],
                        'MissionEndQuantity'=> $row['MissionEndQuantity']);
                    break;
                case 1:
                    $FinishMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionPoint' => $row['MissionPoint'],
                        'MissionEndTime' => $row['EndTime'],
                        'MissionPeriod' => $row['MissionPeriod'],
                        'MissionPeriodList' => $MissionPerioList,//$row["MissionPeriodList"],
                        'RowID' => $row['RowID'],
                        'LastFinishTime' => $row['LastFinishTime'],
                        'FinishQuantity' => $row['FinishQuantity'],
                        'MissionEndQuantity'=> $row['MissionEndQuantity']);
                    break;
                case 2:
                    $EndMission[] = array(
                        'MissionID' => $row['MissionID'],
                        'MissionName' => $row['MissionName'],
                        'MissionPoint' => $row['MissionPoint'],
                        'MissionEndTime' => $row['EndTime'],
                        'MissionPeriod' => $row['MissionPeriod'],
                        'MissionPeriodList' => $MissionPerioList,//$row["MissionPeriodList"],
                        'RowID' => $row['RowID'],
                        'LastFinishTime' => $row['LastFinishTime'],
                        'FinishQuantity' => $row['FinishQuantity'],
                        'MissionEndQuantity'=> $row['MissionEndQuantity']);
                    break;
                default :
                    break;
            }
        }


        $smarty = new KSmarty();
        @$smarty->assign("ProcessingMission", $ProcessingMission);
        @$smarty->assign("FinishMission", $FinishMission);
        @$smarty->assign("EndMission", $EndMission);
        return $smarty->fetch("KPIMission.tpl");
    }

}

?>