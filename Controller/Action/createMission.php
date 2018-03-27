<?php

class createMission implements actionPerformed {

    public function actionPerformed($event) {
        /* `MissionName`, `MissionDetails`, `MissionPoint`, 
          `MissionCreateTime`, `MissionStartTime`,
          `MissionLastFinishTime`, `MissionRefreshTime`,
          `MissionEndTime`, `MissionFinishQuantity`,
          `MissionRefreshQuantity`, `MissionStatus`,
          `MissionEndQuantity`, `MissionPeriod`,
          `MissionPeriodList`, `MissionAttribute` */
        $MissionModel = new MissionModel();
        $MissionName = @$_POST["MissionName"];
        $MissionDetails = @$_POST["MissionDetails"];
        $MissionPoint = @$_POST["MissionPoint"];
        $MissionPeriod = @$_POST["MissionPeriod"];
        $MissionPeriodList = @$_POST["MissionPeriodList"];
        if (isset($_POST['MissionEndQuantity'])) {
            $MissionEndQuantity ="'".$_POST['MissionEndQuantity']."'";
        }else{
            $MissionEndQuantity='';
        }
        $MissionStartTime = @$_POST["MissionStartTime"];
        if (isset($_POST['MissionEndTime'])) {
            $MissionEndTime ="'".$_POST['MissionEndTime']."'";
        }else{
            $MissionEndTime='';
        }
        if (isset($_POST['MissionDetails'])) {
            $MissionDetails ="'".$_POST['MissionDetails']."'";
        }else{
            $MissionDetails='';
        }
        $MissionAttribute = @$_POST['MissionAttribute'];
        $CreateStatus = $MissionModel->CreateMission($MissionName, $MissionDetails, $MissionPoint, $MissionStartTime, $MissionEndTime, $MissionEndQuantity, $MissionPeriod, $MissionPeriodList, $MissionAttribute);

        //$CreateStatus['Returnmsg'] = 'Mission is created';
        //echo $_POST;
        echo json_encode($CreateStatus,true);
        //echo $Name;
    }

}

?>
