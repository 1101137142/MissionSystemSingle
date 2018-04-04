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
        $MissionEndQuantity = @$_POST['MissionEndQuantity'];
        $MissionStartTime = @$_POST["MissionStartTime"];
        $MissionEndTime = @$_POST['MissionEndTime'];
        /* if (isset($_POST['MissionEndTime'])) {
          $MissionEndTime ="'".$_POST['MissionEndTime']."'";
          }else{
          $MissionEndTime='';
          } */
        $MissionDetails = @$_POST['MissionDetails'];
        $MissionAttribute = @$_POST['MissionAttribute'];
        $CreateStatus = $MissionModel->CreateMission($MissionName, $MissionDetails, $MissionPoint, $MissionStartTime, $MissionEndTime, $MissionEndQuantity, $MissionPeriod, $MissionPeriodList, $MissionAttribute);

        //$CreateStatus['Returnmsg'] = 'Mission is created';
        //echo $_POST;
        echo json_encode($CreateStatus, true);
        //echo $Name;
    }

}

?>
