<script>
    function Buy(ID) {
        var url = "index.php?action=CommodityAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {CommodityID: ID, doCommodityAction: 'buyCommodity'}, // serializes the form's elements.
            success: function (data)
            {
                console.log(data);
                window.location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
</script>
<div>
    <div class="card-group">
        <!--<div class="col-2">
            <div class="card" style="width: 18rem;">

                <input type="hidden" class="notnull" id="CommodityImgScr" name="CommodityImgScr" placeholder="Enter Commodity Img Scr " data-fname="圖片網址">
                <div class="card-body" style="padding-top: 10px; padding-bottom: 10px;">
                    <table style="width:100%;"><tr><td style="float:right"><button type="button" class="btn btn-outline-secondary" onclick="create()">Buy it</button></td></tr></table>

                </div>
            </div>
        </div>-
        
        <!--$CommodityInfo[] = array(
        'CommodityID' => $row['CommodityID'],
        'CommodityName' => $row['CommodityName'],
        'CommodityDetail' => $row['CommodityDetail'],
        'CommodityImgScr' => $row['CommodityImgScr'],
        'CommodityPoint' => $row['CommodityPoint'],
        'CommodityMoney' => $row['CommodityMoney'],
        'CommodityPrice' => $row['CommodityPrice']);-->
        <{foreach key=key item=item from=$CommodityInfo name=CommodityInfo}>
        <div class="col-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body" style="height: 286px;width: 286px;">
                <img class="card-img-top" src="<{$item.CommodityImgScr}>" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><{$item.CommodityName}></h5>
                    <p class="card-text" style="height: 72px;" ><{$item.CommodityDetails}></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><table style="width:100%"><tr><td style="float:left">需求點數：</td><td style="float:right"><{$item.CommodityPoint}></td></tr></table></li>
                    <li class="list-group-item"><table style="width:100%"><tr><td style="float:left">需求金額：</td><td style="float:right"><{$item.CommodityMoney}></td></tr></table></li>
                    <li class="list-group-item"><table style="width:100%"><tr><td style="float:left">商品價格：</td><td style="float:right"><{$item.CommodityPrice}></td></tr></table></li>
                </ul>
                <div class="card-body" style="padding-top: 10px; padding-bottom: 10px;">
                    <table style="width:100%;"><tr><td style="float:left">商品數量：<{$item.CommodityQuantity}></td><td style="float:right"><button type="button" class="btn btn-outline-secondary" onclick="Buy(<{$item.CommodityID}>)">Buy it</button></td></tr></table>

                </div>
            </div>
        </div>
        <{/foreach}>

    </div>
</div>