<html lang="zh-Hant-TW">
    <title>Mission System Single</title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script-->
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="./libs/open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://kendo.cdn.telerik.com/2018.1.221/js/angular.min.js"></script>
        <script src="https://kendo.cdn.telerik.com/2018.1.221/js/kendo.all.min.js"></script>

        <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2018.1.221/styles/kendo.common.min.css">
        <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2018.1.221/styles/kendo.default.min.css">
        <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2018.1.221/styles/kendo.default.mobile.min.css" />


    </head>
    <script>
        $(document).ready(function () {
            var url = "index.php?action=HomeAction";
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {doHomeAction: 'getPoint'}, // serializes the form's elements.
                success: function (data)
                {
                    //console.log(data['LastPoint']);

                    $('p').eq(0).html('你的分數：' + data['LastPoint']);

                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                }
            });
        })
    </script>
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
                            Goal
                        </a>
                        <div class="dropdown-menu" aria-labelledby="PreparationsDropdown">
                            <h6 class="dropdown-header">Long-term goal</h6>
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=LongTermGoalList">Long Term Goal</a>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Medium-term goal</h6>
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=MediumTermGoalList">Medium Term Goal</a>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="PreparationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Store
                        </a>
                        <div class="dropdown-menu" aria-labelledby="PreparationsDropdown">
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=CommodityList">Commodity List</a><!--商品列表-->
                            <a class="dropdown-item" href="index.php?action=Showpage&Content=ShopStore">Shop Store</a><!--分數購物商店-->
                        </div>
                    </li>
                </ul>
                <p class="text-light bg-dark align-middle" style="margin-bottom: 0px;">你的分數：</p>
            </div>
        </nav>


        <!-- Fixed navbar -->


        <div class="container-fluid" style="margin-top: 20px;margin-left: 20px;">
            <{$showContent}>
        </div>

    </body>
</html>


<script>

</script>