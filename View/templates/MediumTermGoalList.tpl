<script>
    $(document).ready(function () {
        $('.EditMTGBtn').hide();
        $('[data-toggle="tooltip"]').tooltip();
        var url = location.href;
        var ary = url.split('?')[1].split('&');
        for (i = 0; i <= ary.length - 1; i++) {
            if (ary[i].split('=')[0] == 'editMTG') {
                var MTGID = ary[i].split('=')[1];
                EditMTG(MTGID);
            }
        }
    })
    function FinishMTG(ID) {
        var url = "index.php?action=MTGAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MTGID: ID, doMTGAction: 'finishMTG'}, // serializes the form's elements.
            success: function (data)
            {
                //window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=MediumTermGoalList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function UnfinishMTG(ID) {

        var url = "index.php?action=MTGAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MTGID: ID, doMTGAction: 'unfinishMTG'}, // serializes the form's elements.
            success: function (data)
            {
                //window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=MediumTermGoalList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function DelectMTG(ID) {
        var url = "index.php?action=MTGAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MTGID: ID, doMTGAction: 'delectMTG'}, // serializes the form's elements.
            success: function (data)
            {
                //window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=MediumTermGoalList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function EditMTG(ID) {
        var url = "index.php?action=MTGAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MTGID: ID, doMTGAction: 'EditMTG'}, // serializes the form's elements.
            success: function (data)
            {
                //console.log(data);
                $('.EditMTGBtn').click();
                $.each(data, function (k, v) {
                    //console.log('K: ' + k + ' ,V: ' + v + ' !')
                    if ((k == 'MTGStartTime' || k == 'MTGEndTime') && v != null) {
                        v = v.replace(" ", "T");
                    }
                    $('#EditMTGForm').find('#editMediumTermGoal').find('#' + k).val(v);
                })
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function editMTG() {
        var check_form = true;
        $('#EditMTGForm').find('.active').eq(1).find('.notnull').each(function (k, v) {
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
        $('#EditMTGForm').find('.active').eq(1).find('input').each(function (index, el) {
            if ($(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio') {
                var name = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
            if ($(this).attr('type') == 'radio' && $(this).attr('checked') == 'checked') {
                var na = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
        });
        $("#EditMTGForm").find('.active').eq(1).find('select').each(function (index, el) {
            var name = $(this).attr('name');
            input_arr[name] = $(this).val();
        });
        /* `MissionID`, `MissionName`, `MissionDetails`, `MissionPoint`,
         `MissionCreateTime`, `MissionStartTime`, `MissionLastFinishTime`,
         `MissionRefreshTime`, `MissionEndTime`, `MissionFinishQuantity`,
         `MissionRefreshQuantity`, `MissionStatus`, `MissionEndQuantity`,
         `MissionPeriod`, `MissionPeriodList`, `MissionAttribute` 
         $MissionName, $MissionDetails, $MissionPoint, $MissionStartTime, $MissionEndTime, $MissionEndQuantity, $MissionPeriod, $MissionPeriodList, $MissionAttribute
         */
        input_arr['doMTGAction'] = 'doEditMTG';
        //console.log(input_arr);
        var url = "index.php?action=MTGAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: input_arr,
            success: function (data) {
                //console.log(data);
                document.location.href = 'index.php?action=Showpage&Content=MediumTermGoalList';
                //window.location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        })
        //e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    function createMTG() {
        var check_form = true;
        $('#createMTGForm').find('.active').eq(1).find('.notnull').each(function (k, v) {
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
        $('#createMTGForm').find('.active').eq(1).find('input').each(function (index, el) {
            /*if ($(this).val() == '') {
             var name = $(this).attr('name');
             input_arr[name] = 'NULL';
             }*/

            if ($(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio') {
                var name = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
            if ($(this).attr('type') == 'radio' && $(this).attr('checked') == 'checked') {
                var na = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
        });
        $("#createMTGForm").find('.active').eq(1).find('select').each(function (index, el) {
            var name = $(this).attr('name');
            input_arr[name] = $(this).val();
        });
        /* `MissionID`, `MissionName`, `MissionDetails`, `MissionPoint`,
         `MissionCreateTime`, `MissionStartTime`, `MissionLastFinishTime`,
         `MissionRefreshTime`, `MissionEndTime`, `MissionFinishQuantity`,
         `MissionRefreshQuantity`, `MissionStatus`, `MissionEndQuantity`,
         `MissionPeriod`, `MissionPeriodList`, `MissionAttribute` 
         $MissionName, $MissionDetails, $MissionPoint, $MissionStartTime, $MissionEndTime, $MissionEndQuantity, $MissionPeriod, $MissionPeriodList, $MissionAttribute
         */
        //console.log(input_arr);
        var url = "index.php?action=createMTG";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: input_arr,
            success: function (data) {
                //window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=MediumTermGoalList';
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
        $('.show').eq(0).find('.active').eq(1).find('#' + field).val(d.getFullYear() + '-' + (d.getMonth() + 1 < 10 ? '0' : '') + (d.getMonth() + 1) + '-' + (d.getDate() + 1 < 10 ? '0' : '') + (d.getDate() + 1) + 'T04:00');
        $('.show').eq(1).find('.active').eq(1).find('#' + field).val(d.getFullYear() + '-' + (d.getMonth() + 1 < 10 ? '0' : '') + (d.getMonth() + 1) + '-' + (d.getDate() + 1 < 10 ? '0' : '') + (d.getDate() + 1) + 'T04:00');
    }

</script>


<div style="clear:both;width:100%">

    <!--<table class="table table-hover" ID="NotFinishTable">-->
    <table class="table table-hover table-sm" ID="MTGTable" style="width:95%">
        <tr ><td colspan="2"  align=left>中期目標清單</td>
            <td align=right colspan="13">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createMTG">新增中期目標</button>
                <button type="button" class="btn btn-outline-success EditMTGBtn" data-toggle="modal" data-target="#EditMTG">修改中期目標</button>
            </td>
        </tr>
        <tr><td align=center style="white-space:nowrap;">目標ID</td><td align=center style="white-space:nowrap;" colspan="2">目標名稱</td><td align=center>分數</td>
            <td align=center style="white-space:nowrap;">目標開始時間</td>
            <td align=center style="white-space:nowrap;">預計完成時間</td>
            <td align=center style="white-space:nowrap;width:150px !important;">進度條</td>
            <td align=center style="white-space:nowrap;">功能鍵</td>
        </tr>
        <{foreach key=key item=item from=$MTGList name=MTGList}>
        <tr >
            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MTGID}></td>
            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MTGName}></td>
            <td align=center class="align-middle"><span class="oi oi-info"  data-toggle="tooltip" data-placement="top" title="<{$item.MTGDetail}>"></span></td>
            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MTGPoint}></td>


            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MTGStartTime}></td>
            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MTGETA}></td>
            <td align=center style="white-space:nowrap;" class="align-middle">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated
                         <{if $item.RD<=60}> bg-success 
                         <{elseif $item.RD>=61 && $item.RD<=80}> bg-info 
                         <{elseif $item.RD>=81 && $item.RD<100}> bg-warning  
                         <{elseif $item.RD>=100}> bg-danger 
                         <{/if}>"role="progressbar" style="width: <{$item.RD}>%" aria-valuenow="<{$item.RD}>" aria-valuemin="0" aria-valuemax="100">
                        <{$item.RD}>%</div>
                </div>
            </td>
            <td align=center style="white-space:nowrap;" class="align-middle">
                <button id="EditBt<{$item.MTGID}>" type="button" class="btn btn-outline-warning" onclick=EditMTG(<{$item.MTGID}>)>修改</button>
                <button id="DelectBt<{$item.MTGID}>" type="button" class="btn btn-outline-danger" onclick=DelectMTG(<{$item.MTGID}>)>刪除</button>
            </td></tr>
        <{foreachelse}>
        <tr><td align=center colspan="10">當前沒有任務哦 請先建立任務</td></tr>
        <{/foreach}>
    </table>


    <!-- Create MTG 建立視窗 -->
    <div class="modal fade" id="createMTG" tabindex="-1" role="dialog" aria-labelledby="CreateMTGTableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateMTGLongTitle">New MTG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ID="createMTGForm">
                        <ul class="nav nav-tabs" id="CreateTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="MediumTermGoal-tab" data-toggle="tab" href="#createMediumTermGoal" role="tab" aria-controls="MediumTermGoal" aria-selected="true">MediumTermGoal</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="createMediumTermGoal" role="tabpanel" aria-labelledby="MediumTermGoal-tab">
                                <div class="form-group">
                                    <label for="MTGName">目標名稱：</label>
                                    <input type="text" class="form-control notnull" id="MTGName" name="MTGName" placeholder="Enter MTG Name" data-fname="任務名稱">
                                </div>
                                <div class="form-group">
                                    <label for="MTGDetail">目標說明：</label>
                                    <input type="number" class="form-control notnull" id="MTGDetail" name="MTGDetail" placeholder="Enter MTG Point" data-fname="任務分數">
                                </div>
                                <div class="form-group">
                                    <label for="MTGStartTime">目標開始時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MTGStartTime" name="MTGStartTime" placeholder="Enter MTG Start Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MTGStartTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MTGETATime">預計完成時間 (選填) ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MTGETATime" name="MTGETATime" placeholder="Enter MTG ETA Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MTGETATime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MTGEndTime">目標結束時間 (選填) ：</label>
                                    <input type="datetime-local" class="form-control" id="MTGEndTime" name="MTGEndTime" placeholder="Enter MTG End Time" style="display: inline;width: 80%;">
                                    <button type="button" class="btn btn-light" onclick=setTime('MTGEndTime') style="display: inline;width: 19%;">明天4點</button>

                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success"  id="submitForm" onclick=createMTG()>送出</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit MTG 修改視窗-->
    <div class="modal fade" id="EditMTG" tabindex="-1" role="dialog" aria-labelledby="EditMTGTableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditMTGLongTitle">Edit MTG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ID="EditMTGForm">
                        <ul class="nav nav-tabs" id="EditTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="MediumTermGoal-tab" data-toggle="tab" href="#editMediumTermGoal" role="tab" aria-controls="MediumTermGoal" aria-selected="true">MediumTermGoal</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="editMediumTermGoal" role="tabpanel" aria-labelledby="MediumTermGoal-tab">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="MTGID" class="col-form-label">任務ID：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext notnull" id="MTGID" name="MTGID" readonly data-fname="任務ID">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MTGName">任務名稱：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control notnull" id="MTGName" name="MTGName" placeholder="Enter MTG Name" data-fname="任務名稱">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MTGDetails">任務說明：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="MTGDetails" name="MTGDetails" placeholder="Enter MTG Details" data-fname="任務說明">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MTGPoint">任務分數：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control notnull" id="MTGPoint" name="MTGPoint" placeholder="Enter MTG Point" data-fname="任務分數">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="MTGStartTime">任務開始時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MTGStartTime" name="MTGStartTime" placeholder="Enter MTG Start Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MTGStartTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MTGETATime">預計完成時間 (選填) ：</label>
                                    <input type="datetime-local" class="form-control" id="MTGETATime" name="MTGETATime" placeholder="Enter MTG End Time" style="display: inline;width: 80%;">
                                    <button type="button" class="btn btn-light" onclick=setTime('MTGETATime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MTGEndTime">任務結束時間 (選填) ：</label>
                                    <input type="datetime-local" class="form-control" id="MTGEndTime" name="MTGEndTime" placeholder="Enter MTG End Time" style="display: inline;width: 80%;">
                                    <button type="button" class="btn btn-light" onclick=setTime('MTGEndTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success"  id="submitForm" onclick=editMTG()>送出</button>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>