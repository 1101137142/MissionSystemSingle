<script>
    $(document).ready(function () {
        $('.EditCommodityBtn').hide();
        $('[data-toggle="tooltip"]').tooltip();
        /*var url = location.href;
         var ary = url.split('?')[1].split('&');
         for (i = 0; i <= ary.length - 1; i++) {
         if (ary[i].split('=')[0] == 'editCommodity') {
         var CommodityID = ary[i].split('=')[1];
         EditCommodity(CommodityID);
         }
         }*/
    })
    function buyCommodity(ID) {
        var url = "index.php?action=CommodityAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {CommodityID: ID, doCommodityAction: 'buyCommodity'}, // serializes the form's elements.
            success: function (data)
            {
                window.location.reload();
                //document.location.href = 'index.php?action=Showpage&Content=CommodityList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function unbuyCommodity(ID) {
        var url = "index.php?action=CommodityAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {CommodityID: ID, doCommodityAction: 'unbuyCommodity'}, // serializes the form's elements.
            success: function (data)
            {
                window.location.reload();
                //document.location.href = 'index.php?action=Showpage&Content=CommodityList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function EditCommodity(ID) {
        var url = "index.php?action=CommodityAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {CommodityID: ID, doCommodityAction: 'EditCommodity'}, // serializes the form's elements.
            success: function (data)
            {
                //console.log(data);
                $('.EditCommodityBtn').click();
                $.each(data, function (k, v) {
                    //console.log('K: ' + k + ' ,V: ' + v + ' !')
                    if ((k == 'CommodityStartTime' || k == 'CommodityDeadline') && v != null) {
                        v = v.replace(" ", "T");
                    }
                    $('#EditCommodityForm').find('#' + k).val(v);
                })
                //window.location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function editCommodity() {
        var check_form = true;
        $('#EditCommodityForm').find('.notnull').each(function (k, v) {
            var in_na = $(this).attr('name');
            if ($(this).attr('type') == 'radio') {
                //console.log($(this).attr('checked'));
                if (!$('.' + in_na + ':checked').val()) {
                    var f_name = $(this).data('fname');
                    check_form = false;
                    alert(f_name + '不可空白');
                    return false;
                }
            } else if ($(this).attr('type') != 'radio' && $(this).attr('type') != 'password') {
                if (!$(this).val().trim()) {
                    var f_name = $(this).data('fname');
                    check_form = false;
                    alert(f_name + '不可空白');
                    $(this).focus();
                    return false;
                }
            }
        });
        if (check_form != true) {
            return false;
        }
        var input_arr = new Object();
        $('#EditCommodityForm').find('input').each(function (index, el) {
            if ($(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio') {
                var name = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
            if ($(this).attr('type') == 'radio' && $(this).attr('checked') == 'checked') {
                var na = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
        });
        $("#EditCommodityForm").find('select').each(function (index, el) {
            var name = $(this).attr('name');
            input_arr[name] = $(this).val();
        });
        /* `CommodityID`, `CommodityName`, `CommodityDetails`, `CommodityPoint`,
         `CommodityCreateTime`, `CommodityStartTime`, `CommodityLastFinishTime`,
         `CommodityRefreshTime`, `CommodityEndTime`, `CommodityFinishQuantity`,
         `CommodityRefreshQuantity`, `CommodityStatus`, `CommodityEndQuantity`,
         `CommodityPeriod`, `CommodityPeriodList`, `CommodityAttribute` 
         $CommodityName, $CommodityDetails, $CommodityPoint, $CommodityStartTime, $CommodityEndTime, $CommodityEndQuantity, $CommodityPeriod, $CommodityPeriodList, $CommodityAttribute
         */
        input_arr['doCommodityAction'] = 'doEditCommodity';
        console.log(input_arr);
        var url = "index.php?action=CommodityAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: input_arr,
            success: function (data) {
                //console.log(data);
                //document.location.href = 'index.php?action=Showpage&Content=CommodityList';
                window.location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        })
        //e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    function createCommodity() {
        var check_form = true;
        $('#createCommodityForm').find('.notnull').each(function (k, v) {
            var in_na = $(this).attr('name');
            if ($(this).attr('type') == 'radio') {
                //console.log($(this).attr('checked'));
                if (!$('.' + in_na + ':checked').val()) {
                    var f_name = $(this).data('fname');
                    check_form = false;
                    alert(f_name + '不可空白');
                    return false;
                }
            } else if ($(this).attr('type') != 'radio' && $(this).attr('type') != 'password') {
                if (!$(this).val().trim()) {
                    var f_name = $(this).data('fname');
                    check_form = false;
                    alert(f_name + '不可空白');
                    $(this).focus();
                    return false;
                }
            }
        });
        if (check_form != true) {
            return false;
        }
        var input_arr = new Object();
        $('#createCommodityForm').find('input').each(function (index, el) {
            if ($(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio') {
                var name = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
            if ($(this).attr('type') == 'radio' && $(this).attr('checked') == 'checked') {
                var na = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
        });
        $("#createCommodityForm").find('select').each(function (index, el) {
            var name = $(this).attr('name');
            input_arr[name] = $(this).val();
        });
        /*
         * `CommodityID`, `CommodityName`, `CommodityDetails`,
         *  `CommodityCreateTime`, `CommodityStartTime`, 
         *  `CommodityImgScr`, `CommodityQuantity`, 
         *  `CommodityPoint`, `CommodityMoney`, `CommodityPrice`, 
         *  `CommodityBuyTime`, `CommodityDeadline`, `CommodityStatus`
         */
        console.log(input_arr);
        input_arr['doCommodityAction'] = 'doCreateCommodity';
        var url = "index.php?action=CommodityAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: input_arr,
            success: function (data) {
                console.log(data);
                window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=CommodityList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        })
        //e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    function setTime(field) {
        var d = new Date();
        d.setDate(d.getDate()+1);
        $('.show').eq(0).find('#' + field).val(d.getFullYear() + '-' + (d.getMonth() + 1 < 10 ? '0' : '') + (d.getMonth() + 1) + '-' + (d.getDate()  < 10 ? '0' : '') + (d.getDate() ) + 'T04:00');
        
    }
</script>
<div style="clear:both;width:100%">

    <!--<table class="table table-hover" ID="NotFinishTable">-->
    <table class="table table-hover table-sm" ID="CommodityTable" style="width:100%">
        <tr ><td colspan="2"  align=left>商品清單</td>
            <td align=right colspan="13">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createCommodity">新增商品</button>
                <button type="button" class="btn btn-outline-success EditCommodityBtn" data-toggle="modal" data-target="#EditCommodity">修改商品</button>
            </td>
        </tr>
        <tr><td align=center style="">商品ID</td>
            <td align=center style=""colspan="2">商品名稱</td>
            <td align=center style="">商品開始時間</td>
            <td align=center style="">需求 點數/金額</td>
            <td align=center style="">實際價格</td>
            <td align=center style="">數量</td>
            <td align=center style="">商品下架時間</td>
            <td align=center style="">商品狀態</td>
            <td align=center style="">功能鍵</td>
        </tr>
        <{foreach key=key item=item from=$CommodityInfo name=CommodityInfo}>
        <tr >
            <td align=center style="" class="align-middle"><{$item.CommodityID}></td>
            <td align=center style="" class="align-middle" ><{$item.CommodityName}></td>
            <td align=center class="align-middle"><span class="oi oi-info"  data-toggle="tooltip" data-placement="top" title="<{$item.CommodityDetails}>"></span></td>
            <td align=center style="" class="align-middle"><{$item.CommodityStartTime}></td>
            <td align=center style="" class="align-middle"><{$item.CommodityPoint}> / <{$item.CommodityMoney}></td>
            <td align=center style="" class="align-middle"><{$item.CommodityPrice}></td>
            <td align=center style="" class="align-middle"><{$item.CommodityQuantity}></td>
            <td align=center style="" class="align-middle"><{$item.CommodityDeadline}></td>
            <td align=center style="" class="align-middle"><{$item.CommodityStatus2}></td>
            <td align=center style="" class="align-middle">
                <button id="EditBt<{$item.CommodityID}>" type="button" class="btn btn-outline-warning" onclick=EditCommodity(<{$item.CommodityID}>)>修改</button>
                <{if $item.CommodityStatus=='1'}>
                <button id="buyBt<{$item.CommodityID}>" type="button" class="btn btn-outline-success" onclick=buyCommodity(<{$item.CommodityID}>)>購買</button>
                <{elseif $item.CommodityStatus=='2'}>
                <button id="unbuyBt<{$item.CommodityID}>" type="button" class="btn btn-outline-info" onclick=unbuyCommodity(<{$item.CommodityID}>)>取消購買</button>
                <{/if}>
            </td></tr>
        <{foreachelse}>
        <tr><td align=center colspan="10">當前沒有商品哦 請先建立商品</td></tr>
        <{/foreach}>
    </table>


    <!-- Create Commodity 建立視窗 -->
    <div class="modal fade" id="createCommodity" tabindex="-1" role="dialog" aria-labelledby="CreateCommodityTableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateCommodityLongTitle">New Commodity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ID="createCommodityForm">
                        <div class="form-group">
                            <label for="CommodityName">商品名稱：</label>
                            <input type="text" class="form-control notnull" id="CommodityName" name="CommodityName" placeholder="Enter Commodity Name" data-fname="商品名稱">
                        </div>
                        <div class="form-group">
                            <label for="CommodityDetail">商品詳細說明：</label>
                            <input type="text" class="form-control " id="CommodityDetails" name="CommodityDetails" placeholder="Enter Commodity Details" data-fname="商品名稱">
                        </div>
                        <div class="form-group">
                            <label for="CommodityImgScr">商品圖片網址：</label>
                            <input type="text" class="form-control " id="CommodityImgScr" name="CommodityImgScr" placeholder="Enter Commodity Img Scr" data-fname="商品圖片網址">
                        </div>
                        <div class="form-group">
                            <label for="CommodityPoint">商品需求分數：</label>
                            <input type="number" class="form-control notnull" id="CommodityPoint" name="CommodityPoint" placeholder="Enter Commodity Point" data-fname="商品分數">
                        </div>
                        <div class="form-group">
                            <label for="CommodityMoney">商品需求金額：</label>
                            <input type="number" class="form-control notnull" id="CommodityMoney" name="CommodityMoney" placeholder="Enter Commodity Money" data-fname="商品分數">
                        </div>
                        
                        <div class="form-group">
                            <label for="CommodityPrice">商品數量：</label>
                            <input type="number" class="form-control notnull" id="CommodityQuantity" name="CommodityQuantity" placeholder="Enter Commodity Quantity" data-fname="商品數量">
                        </div>
                        <div class="form-group">
                            <label for="CommodityPrice">商品價格：</label>
                            <input type="number" class="form-control notnull" id="CommodityPrice" name="CommodityPrice" placeholder="Enter Commodity Price" data-fname="商品價格">
                        </div>
                        <div class="form-group">
                            <label for="CommodityStartTime">商品上架時間 ：</label>
                            <input type="datetime-local" class="form-control notnull" id="CommodityStartTime" name="CommodityStartTime" placeholder="Enter Commodity Start Time" style="display: inline;width: 80%;"data-fname="商品上架時間">
                            <button type="button" class="btn btn-light" onclick=setTime('CommodityStartTime') style="display: inline;width: 19%;">明天4點</button>
                        </div>
                        <div class="form-group">
                            <label for="CommodityDeadline">商品下架時間 (選填) ：</label>
                            <input type="datetime-local" class="form-control" id="CommodityDeadline" name="CommodityDeadline" placeholder="Enter Commodity Deadline" style="display: inline;width: 80%;" data-fname="商品下架時間">
                            <button type="button" class="btn btn-light" onclick=setTime('CommodityDeadline') style="display: inline;width: 19%;">明天4點</button>
                            <!--input type="hidden" class="form-control" id="CommodityAttribute" name="CommodityAttribute" -->
                        </div>
                        <button type="button" class="btn btn-success"  id="submitForm" onclick=createCommodity()>送出</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit Commodity 修改視窗-->
    <div class="modal fade" id="EditCommodity" tabindex="-1" role="dialog" aria-labelledby="EditCommodityTableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditCommodityLongTitle">Edit Commodity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ID="EditCommodityForm">
                        <div class="form-row">
                            <div class="col">
                                <label for="CommodityID" class="col-form-label">商品ID：</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext notnull" id="CommodityID" name="CommodityID" readonly data-fname="商品ID">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-form-label ">
                                <label for="CommodityName">商品名稱：</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control notnull" id="CommodityName" name="CommodityName" placeholder="Enter Commodity Name" data-fname="商品名稱">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-form-label ">
                                <label for="CommodityDetails">商品說明：</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="CommodityDetails" name="CommodityDetails" placeholder="Enter Commodity Details" data-fname="商品說明">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-form-label ">
                                <label for="CommodityImgScr">商品圖片網址：</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="CommodityImgScr" name="CommodityImgScr" placeholder="Enter Commodity Img Scr" data-fname="商品圖片網址">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-form-label ">
                                <label for="CommodityPoint">商品需求分數：</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" class="form-control notnull" id="CommodityPoint" name="CommodityPoint" placeholder="Enter Commodity Point" data-fname="商品需求分數">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-form-label ">
                                <label for="CommodityMoney">商品需求金額：</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" class="form-control notnull" id="CommodityMoney" name="CommodityMoney" placeholder="Enter Commodity Money" data-fname="商品需求金額">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-form-label ">
                                <label for="CommodityPrice">商品價格：</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" class="form-control notnull" id="CommodityPrice" name="CommodityPrice" placeholder="Enter Commodity Price" data-fname="商品價格">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-form-label ">
                                <label for="CommodityQuantity">商品數量：</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" class="form-control notnull" id="CommodityQuantity" name="CommodityQuantity" placeholder="Enter Commodity Quantity" data-fname="商品數量">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CommodityStartTime">商品開始時間 ：</label>
                            <input type="datetime-local" class="form-control notnull" id="CommodityStartTime" name="CommodityStartTime" placeholder="Enter Commodity Start Time" style="display: inline;width: 80%;"data-fname="商品開始時間">
                            <button type="button" class="btn btn-light" onclick=setTime('CommodityStartTime') style="display: inline;width: 19%;">明天4點</button>
                        </div>
                        <div class="form-group">
                            <label for="CommodityDeadline">商品結束時間 (選填) ：</label>
                            <input type="datetime-local" class="form-control" id="CommodityDeadline" name="CommodityDeadline" placeholder="Enter Commodity Deadline" style="display: inline;width: 80%;">
                            <button type="button" class="btn btn-light" onclick=setTime('CommodityDeadline') style="display: inline;width: 19%;">明天4點</button>
                            <!--input type="hidden" class="form-control" id="CommodityAttribute" name="CommodityAttribute" -->
                        </div>
                        <div class="form-row">
                            <div class="col col-form-label ">
                                <label for="CommodityStatus">商品狀態：</label>
                            </div>
                            <div class="col-sm-9">
                                <select ID="CommodityStatus" name="CommodityStatus" class="custom-select" >
                                    <option value="0">0 . 準備中</option>
                                    <option value="1">1 . 上架中</option>
                                    <option value="2">2 . 售完</option>
                                    <option value="3">3 . 下架</option>
                                    <option value="9">9 . 刪除</option>
                                </select>
                            </div>
                        </div>
                        <!--
                            /* `CommodityID`, `CommodityName`, `CommodityDetails`, `CommodityPoint`,
                              `CommodityCreateTime`, `CommodityStartTime`, `CommodityLastFinishTime`,
                              `CommodityRefreshTime`, `CommodityEndTime`, `CommodityFinishQuantity`,
                              `CommodityRefreshQuantity`, `CommodityStatus`, `CommodityEndQuantity`,
                              `CommodityPeriod`, `CommodityPeriodList`, `CommodityAttribute` */
                        -->
                        <button type="button" class="btn btn-success"  id="submitForm" onclick=editCommodity()>送出</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>