<?php

class MissionModel extends Model {
    function createMission($MissionName,$MissionDetails,$MissionPoint,$MissionStartTime,$MissionEndTime,$MissionEndQuantity,$MissionPeriod,$MissionPeriodList,$MissionAttribute) {
        
    }
    function selectMission(){
        $sql_search='SELECT * FROM `mss_mission` ';
    }

}