<?php /* Smarty version Smarty-3.1.19, created on 2018-04-03 06:44:04
         compiled from "View\templates\NavBar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9831801685aae20254fa112-95510287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c0d01e227b8d9040b13b400086ed13db464b41c' => 
    array (
      0 => 'View\\templates\\NavBar.tpl',
      1 => 1522736130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9831801685aae20254fa112-95510287',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5aae2025680b75_91123146',
  'variables' => 
  array (
    'showContent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5aae2025680b75_91123146')) {function content_5aae2025680b75_91123146($_smarty_tpl) {?><html lang="zh-Hant-TW">
    <title>Mission System Single</title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script-->
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="./libs/open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>

    <body role="document">
        <nav class="navbar  navbar-expand-lg  navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">MSS-Mission System Single</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="PreparationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Preparations
                        </a>
                        <div class="dropdown-menu" aria-labelledby="PreparationsDropdown">
                            <h6 class="dropdown-header">Purpose/Objective/Solve the problem</h6>
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=KPIMission">Objective</a>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">To do list</h6>
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=TDL">To do list</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="PreparationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mission
                        </a>
                        <div class="dropdown-menu" aria-labelledby="PreparationsDropdown">
                            <h6 class="dropdown-header">Singleplayer Mission</h6>
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=MissionList">List</a>
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=KPIMission">KPI</a>
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=SingleTimeMission">Mission</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?action=Showpage&Content=Store">Shop Store</a><!--分數購物商店-->
                    </li>
                </ul>
            </div>
        </nav>


        <!-- Fixed navbar -->


        <div class="container-fluid" style="margin-top: 20px;margin-left: 20px;">
            <?php echo $_smarty_tpl->tpl_vars['showContent']->value;?>

        </div>

    </body>
</html>


<script>

</script><?php }} ?>
