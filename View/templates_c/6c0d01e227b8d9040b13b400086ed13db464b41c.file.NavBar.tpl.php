<?php /* Smarty version Smarty-3.1.19, created on 2018-03-19 20:44:47
         compiled from "View\templates\NavBar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9831801685aae20254fa112-95510287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c0d01e227b8d9040b13b400086ed13db464b41c' => 
    array (
      0 => 'View\\templates\\NavBar.tpl',
      1 => 1521463318,
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
    'MissionContent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5aae2025680b75_91123146')) {function content_5aae2025680b75_91123146($_smarty_tpl) {?><html lang="zh-Hant-TW">
    <title>Mission System Single</title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
        <nav class=" navbar-expand-lg  navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">MSS-Mission System Single</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                            <a class="dropdown-item" href="index.php?action=Homepage&Content=KPIMission">Objective</a>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">To do list</h6>
                            <a class="dropdown-item" href="index.php?action=Homepage&Content=TDL">To do list</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="PreparationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mission
                        </a>
                        <div class="dropdown-menu" aria-labelledby="PreparationsDropdown">
                            <h6 class="dropdown-header">Singleplayer Mission</h6>
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=KPIMission">KPI</a>
                            <a class="dropdown-item" href="index.php?action=Homepage&Content=KPIMission">Mission</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?action=Homepage&Content=Store">Shop Store</a><!--分數購物商店-->
                    </li>
                </ul>
            </div>
        </nav>


        <!-- Fixed navbar -->
        
        
        <div class="container" style="margin-top: 80px;">
            <?php echo $_smarty_tpl->tpl_vars['MissionContent']->value;?>

        </div>

    </body>
</html>


<script>
    
</script><?php }} ?>
