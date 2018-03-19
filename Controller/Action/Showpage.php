<?php

class ShowPage implements actionPerformed {

    public function actionPerformed($Event) {

        
        $get = $Event->getGet();
        //判斷並連接內容頁
        if (empty($get["Content"])) {
            $Content = "Content";
        }else {
            $Content = $get["Content"];
        }
            $ACTION = "Controller/Action/Show/";
            require_once $ACTION . $Content . '.php';
            $ContentListener = NULL;
            $ContentListener = new $Content();
            $showContent = $ContentListener->actionPerformed($Event);
        

        $smarty = new KSmarty();
        $smarty->assign("showContent", $showContent);
        $smarty->display("NavBar.tpl");
    }

}

?>