<?php

class doLogout implements actionPerformed {

    public function actionPerformed($event) {
        session_destroy();
        echo '<script>window.location.replace("index.php")</script>';
    }

}

?>
