<?php

class MissionModel extends Model {
    function createMission($MissionName,$MissionDetails,$MissionPoint,$MissionStartTime,$MissionEndTime,$MissionEndQuantity,$MissionPeriod,$MissionPeriodList,$MissionAttribute) {
        
    }
    function selectMissionList(){
        $sql_search='SELECT * FROM `mss_mission` ';
    }
    function selectKPIMission(){
        $sql_search='SELECT * FROM `mss_mission` ';
        $stmt_search= $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search;
    }

}