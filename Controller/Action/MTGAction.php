<?php

class MTGAction implements actionPerformed {

    public function actionPerformed($event) {
        $GoalModel = new GoalModel();
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
            case 'EditMission':
                $returnData = $MissionModel->selectEditMission($MissionID)->fetch(PDO::FETCH_ASSOC);
                break;
            case 'doEditMission':
                $returnData=$MissionModel->doEditMission($event->getPost());
                //$returnData=$event->getPost();
                //$returnData = $MissionModel->selectEditMission($MissionID);
                break;
        }
        echo json_encode($returnData, true);
    }

}

?>
