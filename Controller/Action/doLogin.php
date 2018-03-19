<?php

class doLogin implements actionPerformed {

    public function actionPerformed($event) {

        $PlayerModel = new PlayerModel();
        $PlayerName = $_POST["PlayerName"];
        $Password = $_POST["Password"];
        foreach ($PlayerModel->SelectForDoLogin($PlayerName, $Password) as $row) {
            $Player[] = array(
                'PlayerID' => $row["PlayerID"],
                'PlayerName' => $row["PlayerName"],
                'PlayerPassword' => $row["PlayerPassword"],
                'PlayerScore' => $row["PlayerScore"]);
        }
        //如果使用者存在
        if (!empty($Player)) {
            $_SESSION['PlayerID'] = $Player['0']['PlayerID'];
            $_SESSION['PlayerName'] = $Player['0']['PlayerName'];
            echo json_encode($Player);
        } else {
            $Player['0']['PlayerID'] = '-1';
            echo json_encode($Player);
        }
    }

}

?>
