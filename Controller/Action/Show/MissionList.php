<?php

class MissionList implements actionPerformed {

    public function actionPerformed($event) {
        $MissionModel = new MissionModel();
        foreach ($MissionModel->selectMissionList() as $row) {
            /* `MissionID`, `MissionName`, `MissionDetails`, `MissionPoint`,
              `MissionCreateTime`, `MissionStartTime`, `MissionLastFinishTime`,
              `MissionRefreshTime`, `MissionEndTime`, `MissionFinishQuantity`,
              `MissionRefreshQuantity`, `MissionStatus`, `MissionEndQuantity`,
              `MissionPeriod`, `MissionPeriodList`, `MissionAttribute` */
            //單次任務的進度數值
            if ($row['MissionAttribute'] == '1' && ($row['MissionRefreshQuantity'] - $row['MissionFinishQuantity']) > 0) {
                $percentage = round($row['MissionFinishQuantity'] / $row['MissionRefreshQuantity'], 2) * 100;
            } else if ($row['MissionAttribute'] == '3') {
                switch ($row['MissionStatus']) {
                    case '0':
                        if (strtotime('now') > strtotime($row['MissionStartTime'])) {
                            $percentage = round((strtotime('now') - strtotime($row['MissionStartTime'])) / (strtotime($row['MissionEndTime']) - strtotime($row['MissionStartTime'])), 2) * 100;
                        }else{
                            $percentage='0';
                        }
                        break;
                    case '2':
                        $percentage = round((strtotime($row['MissionEndTime']) - strtotime($row['MissionLastFinishTime']) ) / (strtotime($row['MissionEndTime']) - strtotime($row['MissionStartTime'])), 2) * 100;
                        break;
                    case '3':
                        $percentage = '100';
                        break;
                }
            } else if ($row['MissionRefreshQuantity'] == $row['MissionFinishQuantity'] and $row['MissionFinishQuantity'] != 0) {
                $percentage = '100';
            } else {
                $percentage = '0';
            }
            switch ($row['MissionPeriodList']) {
                case '1':
                    $MissionPeriod = $row['MissionPeriod'] . ' 小時';
                    break;
                case '2':
                    $MissionPeriod = $row['MissionPeriod'] . ' 天';
                    break;
                case '3':
                    $MissionPeriod = $row['MissionPeriod'] . ' 周';
                    break;
                case '4':
                    $MissionPeriod = $row['MissionPeriod'] . ' 月';
                    break;
                case '5':
                    $MissionPeriod = $row['MissionPeriod'] . ' 年';
                    break;
                default :
                    $MissionPeriod = '';
                    break;
            }
            switch ($row['MissionStatus']) {
                case '0':
                    $MissionStatus = $row['MissionStatus'] . ' . 未完成';
                    break;
                case '1':
                    $MissionStatus = $row['MissionStatus'] . ' . 完成';
                    break;
                case '2':
                    $MissionStatus = $row['MissionStatus'] . ' . 結束';
                    break;
                case '3':
                    $MissionStatus = $row['MissionStatus'] . ' . 失敗';
                    break;
                case '9':
                    $MissionStatus = $row['MissionStatus'] . ' . 刪除';
                    break;
                default :
                    $MissionStatus = '狀態Err';
                    break;
            }
            switch ($row['MissionAttribute']) {
                case '1':
                    $MissionAttribute = 'KPI任務';
                    break;
                case '2':
                    $MissionAttribute = '重複性任務';
                    break;
                case '3':
                    $MissionAttribute = '一次性任務';
                    break;
                default :
                    $MissionAttribute = '類型Err';
                    break;
            }

            //$percentage = round((strtotime('now') - strtotime($row['MissionStartTime'])) / (strtotime($row['MissionEndTime']) - strtotime($row['MissionStartTime'])), 2) * 100;
            /* `MissionID`, `MissionName`, `MissionDetails`, `MissionPoint`,
              `MissionCreateTime`, `MissionStartTime`, `MissionLastFinishTime`,
              `MissionRefreshTime`, `MissionEndTime`, `MissionFinishQuantity`,
              `MissionRefreshQuantity`, `MissionStatus`, `MissionEndQuantity`,
              `MissionPeriod`, `MissionPeriodList`, `MissionAttribute` */
            $ProcessingMission[] = array(
                'MissionID' => $row['MissionID'],
                'MissionName' => $row['MissionName'],
                'MissionDetails' => $row['MissionDetails'],
                'MissionPoint' => $row['MissionPoint'],
                'MissionCreateTime' => $row['MissionCreateTime'],
                'MissionStartTime' => $row['MissionStartTime'],
                'MissionLastFinishTime' => $row['MissionLastFinishTime'],
                'MissionEndTime' => $row['MissionEndTime'],
                'MissionRefreshTime' => $row['MissionRefreshTime'],
                'MissionStatusR' => $MissionStatus,
                'MissionStatus' => $row['MissionStatus'],
                'MissionAttribute' => $row['MissionAttribute'],
                'MissionFinishQuantity' => $row['MissionFinishQuantity'],
                'MissionRefreshQuantity' => $row['MissionRefreshQuantity'],
                'MissionPeriod' => $MissionPeriod,
                'MissionPeriodList' => $row['MissionPeriodList'],
                'MissionEndQuantity' => $row['MissionEndQuantity'],
                'MissionAttributeType' => $MissionAttribute,
                'percentage' => $percentage);
        }


        $smarty = new KSmarty();
        @$smarty->assign("ProcessingMission", $ProcessingMission);
        return $smarty->fetch("MissionList.tpl");
    }

}

?>
