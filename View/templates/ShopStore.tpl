<div>

    <{foreach key=key item=item from=$CommodityInfo name=CommodityInfo}>
    <!--$CommodityInfo[] = array(
    'CommodityID' => $row['CommodityID'],
    'CommodityName' => $row['CommodityName'],
    'CommodityDetail' => $row['CommodityDetail'],
    'CommodityImgScr' => $row['CommodityImgScr'],
    'CommodityPoint' => $row['CommodityPoint'],
    'CommodityMoney' => $row['CommodityMoney'],
    'CommodityPrice' => $row['CommodityPrice']);-->
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<{$item.CommodityImgScr}>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><{$item.CommodityName}></h5>
            <p class="card-text"><{$item.CommodityDetail}></p>
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
    <{/foreach}>
</div>