<?php

class MediumTermGoalList implements actionPerformed {

    public function actionPerformed($event) {
        $GoalModel = new GoalModel();
        foreach ($GoalModel->selectMTGListWithRD() as $row) {
            /* `MTGID`, `MTGName`, `MTGDetail`, `MTGCreateTime`, `MTGStartTime`, 
             * `MTGETA`, `MTGDeadline`, `MTGPoint`, `MTGTotalPoint`, `MTGUpdateTime`
             */
            $MTGList[] = array(
                'MTGID' => $row['MTGID'],
                'MTGName' => $row['MTGName'],
                'MTGDetail' => $row['MTGDetail'],
                'MTGCreateTime' => $row['MTGCreateTime'],
                'MTGStartTime' => $row['MTGStartTime'],
                'MTGETA' => $row['MTGETA'],
                'MissionFinishQuantity' => $row['MissionFinishQuantity'],
                'MissionRefreshQuantity' => $row['MissionRefreshQuantity'],
                'MTGDeadline' => $row['MTGDeadline'],
                'MTGPoint' => $row['MTGPoint'],
                'RD' => $row['RD'],
                'MTGTotalPoint' => $row['MTGTotalPoint'],
                'MTGUpdateTime' => $row['MTGUpdateTime']);
        }
        $smarty = new KSmarty();
        @$smarty->assign("MTGList", $MTGList);
        return $smarty->fetch("MediumTermGoalList.tpl");
    }

}

?>