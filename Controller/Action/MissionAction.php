<?php

class MissionAction implements actionPerformed {

    public function actionPerformed($event) {
        $MissionModel = new MissionModel();
        $MissionID = $_POST["MissionID"];
        $doMissionAction = $_POST["doMissionAction"];
        switch ($doMissionAction) {
            case 'finishKPIMission':
                $returnData = $MissionModel->finishKPIMission($MissionID);
                break;
            case 'unfinishKPIMission':
                $returnData = $MissionModel->unfinishKPIMission($MissionID);
                break;
            case 'delectMission':
                $returnData = $MissionModel->delectMission($MissionID);
                break;
        }
        echo json_encode($returnData, true);
    }

}

?>
