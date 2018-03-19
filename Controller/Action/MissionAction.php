<?php

class MissionAction implements actionPerformed {

    public function actionPerformed($event) {
        $SingleplayerModel = new SingleplayerModel();
        $ID = $_POST["RowID"];
        $doAction=$_POST["doAction"];
        switch($doAction){
            case 'KPIFinish':
                return $SingleplayerModel->FinishKPIMission($ID);
                break;
            case 'KPIUnfinish':
                return $SingleplayerModel->UnfinishKPIMission($ID);
                break;
            case 'KPIDelect':
                return $SingleplayerModel->DelectKPIMission($ID);
                break;
            case 'Finish':
                return $SingleplayerModel->FinishMission($ID);
                break;
            case 'Unfinish':
                return $SingleplayerModel->UnfinishMission($ID);
                break;
            case 'Delect':
                return $SingleplayerModel->DelectMission($ID);
                break;
        }
        
        
    }

}

?>
