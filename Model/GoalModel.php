<?php

class GoalModel extends Model {
    function selectMTGList(){
        $sql_search = "SELECT *,0 RD FROM `mss_mtg`";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }
    function selectLTGList(){
        $sql_search = "SELECT * FROM `mss_ltg`";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }
    function selectMTGListWithRD(){
        $sql_search="SELECT T1.*,sum(round(T3.MissionFinishQuantity / T3.MissionRefreshQuantity,4)*100*T2.LinkProportion) as RD,sum(T3.MissionFinishQuantity*T2.LinkProportion) as MissionFinishQuantity , sum(T3.MissionRefreshQuantity*T2.LinkProportion) as MissionRefreshQuantity FROM `mss_mtg` T1 left join `mss_link` T2 on T1.MTGID=T2.LinkMainID and T2.LinkType='2' left join mss_mission T3 on T2.LinkSubID=T3.MissionID GROUP BY T1.MTGID";
        $stmt_search = $this->cont->prepare($sql_search);
        $status[] = $stmt_search->execute();
        return $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    }
}