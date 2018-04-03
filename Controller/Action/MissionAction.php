<?php

class MissionAction implements actionPerformed {

    public function actionPerformed($event) {
        $MissionModel = new MissionModel();
        $MissionID = $_POST["MissionID"];
        $doMissionAction = $_POST["doMissionAction"];
        switch ($doMissionAction) {
            case 'finishMission':
            case 'finishKPIMission':
            case 'finishSingleTimeMission':
                $returnData = $MissionModel->finishMission($MissionID);
                break;
            case 'unfinishMission':
            case 'unfinishKPIMission':
            case 'unfinishSingleTimeMission':
                $returnData = $MissionModel->unfinishMission($MissionID);
                break;
            case 'delectMission':
                $returnData = $MissionModel->delectMission($MissionID);
                break;
        }
        echo json_encode($returnData, true);
    }

}

?>
