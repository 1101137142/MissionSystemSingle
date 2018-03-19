<?php

class createKPIMission implements actionPerformed {

    public function actionPerformed($event) {

        if ($_SESSION['PlayerName'] == '!NotToLogin') {
            $NewMission['Returnmsg'] = 'Not Login';
        } else {
            $SingleplayerModel = new SingleplayerModel();
            $Name = $_POST["MissionName"];
            $Point = $_POST["MissionPoint"];
            $Period = $_POST["MissionPeriod"];
            $MissionEndTime = $_POST['MissionEndTime'];
            $StartTime=$_POST['StartTime'];
            $MissionEndQuantity=$_POST['MissionEndQuantity'];            
            //$MissionAttribute=$_POST['MissionAttribute'];
            $MissionPeriodList = $_POST['MissionPeriodList'];
            $CreateStatus = $SingleplayerModel->CreateMission($Name, $Point, $Period,$StartTime, $MissionEndTime,$MissionEndQuantity, '1', $MissionPeriodList);
            if ($CreateStatus == '0') {
                $NewMission['Returnmsg'] = 'Mission isn\'t created';
            } else {
                foreach ($CreateStatus as $row) {
                    $NewMission[] = array(
                        'MissionID' => $row["MissionID"],
                        'MissionName' => $row["MissionName"],
                        'MissionPoint' => $row["MissionPoint"],
                        'EndTime' => $row["EndTime"],
                        'MissionPeriod' => $row["MissionPeriod"],
                        'LastFinishTime' => $row["LastFinishTime"],
                        'FinishQuantity' => $row["FinishQuantity"],
                        'Status' => $row["Status"]
                    );
                }
                $NewMission['Returnmsg'] = 'Mission is created';
            }
        }
        //echo $_POST;
        echo json_encode($NewMission);
        //echo $Name;
    }

}

?>
