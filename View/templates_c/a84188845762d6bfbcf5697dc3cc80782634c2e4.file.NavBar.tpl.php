<?php /* Smarty version Smarty-3.1.19, created on 2018-02-17 21:13:46
         compiled from "View\templates\NavBar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:260995a882a8a5fa206-63009638%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a84188845762d6bfbcf5697dc3cc80782634c2e4' => 
    array (
      0 => 'View\\templates\\NavBar.tpl',
      1 => 1518873208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260995a882a8a5fa206-63009638',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MissionContent' => 0,
    'PlayerName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5a882a8a69e327_54198728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a882a8a69e327_54198728')) {function content_5a882a8a69e327_54198728($_smarty_tpl) {?><html lang="zh-Hant-TW">
    <title>My Mission System</title>
    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- DOJO -->
        <script src="//ajax.googleapis.com/ajax/libs/dojo/1.10.4/dojo/dojo.js" data-dojo-config="async: true"></script>

        <!-- 最新編譯和最佳化的 CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- 選擇性佈景主題 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

        <!-- 最新編譯和最佳化的 JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="View/templates/Login.css">
    </head>

    <body role="document">


        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">MMS - My Mission System</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preparations<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Purpose/Objective/Solve the problem</li><!--小類別  為了什麼 目標/目的/問題-->
                                <li><a href="index.php?action=Homepage&Content=KPIMission">Objective</a></li><!--設立短期目標的KPI系統-->
                                <li role="separator" class="divider"></li><!--分隔橫線-->
                                <li class="dropdown-header">To do list</li><!--小類別 根據目標/目的/問題 產生的待辦清單-->
                                <li><a href="#">To do list</a></li><!--任務與計分系統-->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mission System<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Singleplayer Mission</li><!--小類別 單人-->
                                <li><a href="index.php?action=Homepage&Content=KPIMission">KPIMission</a></li><!--設立短期目標的KPI系統-->
                                <li><a href="index.php?action=Homepage&Content=MissionAndPoint">Mission & Point</a></li><!--任務與計分系統-->
                                <li role="separator" class="divider"></li><!--分隔橫線-->
                                <li class="dropdown-header">Multiplayer Mission</li><!--小類別 多人-->
                                <li><a href="#">Mission & Point</a></li><!--任務與計分系統-->
                                <li><a href="#">Friend</a></li><!--朋友設定-->
                                <li><a href="#">Set Up</a></li><!--環境設定-->
                            </ul>
                        </li>
                        <li><a href="index.php?action=Homepage&Content=Store">Shop Store</a></li><!--分數購物商店-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Anything<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#about">About Developers</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li id="loginli" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            Login via
                                            <form class="form" role="form" method="post"  accept-charset="UTF-8" id="login-nav">
                                                <div class="form-group">
                                                    <label class="sr-only" for="PlayerName">PlayerName</label>
                                                    <input type="text" class="form-control" name="PlayerName" id="PlayerName" placeholder="PlayerName" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="Password">Password</label>
                                                    <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" required>

                                                    <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="bottom text-center">
                                            New here ? <a href="#"><b>Join Us</b></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div id="ChangePassword" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
            <div class="modal-dialog modal-sm" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        <div class="modal-title ">
                            變更密碼 ChangePassword
                        </div>
                    </div>
                    <form class="form" role="form" method="post"  accept-charset="UTF-8" id="ChangePasswordForm">
                        <div class="modal-body" >
                            <label class="sr-only" for="Password">舊密碼 Password</label>
                            <input type="text" class="form-control" name="OldPassword" id="OldPassword" placeholder="舊密碼 Old Password" required>
                            <label class="sr-only" for="NewPassword">新密碼 New Password</label>
                            <input type="text" class="form-control" name="NewPassword" id="NewPassword" placeholder="新密碼 New Password" required>
                            <label class="sr-only" for="RetypeNewPassword">重新輸入新密碼 Retype New Password</label>
                            <input type="text" class="form-control"  name="RetypeNewPassword" id="RetypeNewPassword" placeholder="重新輸入新密碼 Retype New Password" required>
                        </div>
                        <div class="modal-footer" >
                            <button class="btn">OK</button>
                            <button class="btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 80px;">
            <?php echo $_smarty_tpl->tpl_vars['MissionContent']->value;?>

        </div>

    </body>
</html>


<script>
    if ("<?php echo $_smarty_tpl->tpl_vars['PlayerName']->value;?>
" != "!NotToLogin") {
        var HTML = '<a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello ';
        HTML += "<?php echo $_smarty_tpl->tpl_vars['PlayerName']->value;?>
";
        HTML += '<span class="caret"></span></a><ul class="dropdown-menu">';
        HTML += '<li><a href="#" data-toggle="modal" data-target="#ChangePassword">Change Password</a></li>';
        HTML += '<li><a href="#">My Profile</a></li>';
        HTML += '<li><a href="index.php?action=doLogout">Log out</a></li></ul>';
        $('#loginli').html(HTML);
    }
    $("#login-nav").submit(function (e) {
        var url = "index.php?action=doLogin"; // the script where you handle the form input.
        //var url = "Controller/Action/createMission.php";
        //console.log($("#createMissionForm").serialize());
        $.ajax({
            type: "POST",
            url: url,
            data: $("#login-nav").serialize(), // serializes the form's elements.
            dataType: "json",
            success: function (data)
            {

                if (data['0']['PlayerID'] == '-1') {
                    alert("登入失敗");
                    //console.log(data);
                } else {
                    var HTML = '<a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello ';
                    HTML += data['0']['PlayerName'];
                    HTML += '<span class="caret"></span></a><ul class="dropdown-menu">';
                    HTML += '<li><a href="#">Change Password</a></li>';
                    HTML += '<li><a href="#">My Profile</a></li>';
                    HTML += '<li><a href="index.php?action=doLogout">Log out</a></li></ul>';
                    $('#loginli').html(HTML);
                }


            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    })
</script><?php }} ?>
