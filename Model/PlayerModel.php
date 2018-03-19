<?php


class PlayerModel extends Model {

    
    function SelectForDoLogin($Name,$Password) {

        $sql ="SELECT `PlayerID`, `PlayerName`, `PlayerPassword`, `PlayerScore` FROM `missionsystem_players` WHERE `PlayerName`='".$Name . "' AND `PlayerPassword` ='".$Password."'";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function SelectPlayerToCheckLogin($ID,$Name){
        $sql ="SELECT `PlayerID`, `PlayerName`, `PlayerScore` FROM `missionsystem_players` WHERE `PlayerName`='".$Name . "' AND `PlayerID` ='".$ID."'";
        $stmt = $this->cont->prepare($sql);
        $status = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>
