<script>
    function FinishMission(ID) {
        var url = "index.php?action=MissionAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MissionID: ID, doMissionAction: 'finishMission'}, // serializes the form's elements.
            success: function (data)
            {
                //window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=MissionList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function UnfinishMission(ID) {

        var url = "index.php?action=MissionAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MissionID: ID, doMissionAction: 'unfinishMission'}, // serializes the form's elements.
            success: function (data)
            {
                //window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=MissionList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function DelectMission(ID) {
        var url = "index.php?action=MissionAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MissionID: ID, doMissionAction: 'delectMission'}, // serializes the form's elements.
            success: function (data)
            {
                //window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=MissionList';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function EditMission(ID) {
        var url = "index.php?action=MissionAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MissionID: ID, doMissionAction: 'EditMission'}, // serializes the form's elements.
            success: function (data)
            {
                //console.log(data);
                $('.EditMissionBtn').click();
                switch (data['MissionAttribute']) {
                    case '1':
                        $('#EditMissionForm').find('#KPIMission-tab').show();
                        $('#EditMissionForm').find('#KPIMission-tab').click();
                        $('#EditMissionForm').find('#RepeatedlyMission-tab').hide();
                        $('#EditMissionForm').find('#SingleTimeMission-tab').hide();
                        $.each(data, function (k, v) {
                            //console.log('K: ' + k + ' ,V: ' + v + ' !')
                            if ((k == 'MissionStartTime' || k == 'MissionEndTime') && v != null) {
                                v = v.replace(" ", "T");
                            }
                            $('#EditMissionForm').find('#editKPIMission').find('#' + k).val(v);
                        })
                        break;
                    case '2':
                        $('#EditMissionForm').find('#RepeatedlyMission-tab').show();
                        $('#EditMissionForm').find('#RepeatedlyMission-tab').click();
                        $('#EditMissionForm').find('#SingleTimeMission-tab').hide();
                        $('#EditMissionForm').find('#KPIMission-tab').hide();
                        $.each(data, function (k, v) {
                            //console.log('K: ' + k + ' ,V: ' + v + ' !')
                            if ((k == 'MissionStartTime' || k == 'MissionEndTime') && v != null) {
                                v = v.replace(" ", "T");
                            }
                            $('#EditMissionForm').find('#editRepeatedlyMission').find('#' + k).val(v);
                        })
                        break;
                    case '3':
                        $('#EditMissionForm').find('#SingleTimeMission-tab').show();
                        $('#EditMissionForm').find('#SingleTimeMission-tab').click();
                        $('#EditMissionForm').find('#KPIMission-tab').hide();
                        $('#EditMissionForm').find('#RepeatedlyMission-tab').hide();
                        $.each(data, function (k, v) {
                            //console.log('K: ' + k + ' ,V: ' + v + ' !')
                            if ((k == 'MissionStartTime' || k == 'MissionEndTime') && v != null) {
                                v = v.replace(" ", "T");
                            }
                            $('#EditMissionForm').find('#editSingleTimeMission').find('#' + k).val(v);
                        })
                        break;
                }
                //window.location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function editMission() {
        var check_form = true;
        $('#EditMissionForm').find('.active').eq(1).find('.notnull').each(function (k, v) {
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
        $('#EditMissionForm').find('.active').eq(1).find('input').each(function (index, el) {
            if ($(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio') {
                var name = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
            if ($(this).attr('type') == 'radio' && $(this).attr('checked') == 'checked') {
                var na = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
        });
        $("#EditMissionForm").find('.active').eq(1).find('select').each(function (index, el) {
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
        switch ($('#EditMissionForm').find('.active').eq(1).attr('ID')) {
            case 'createKPIMission':
                input_arr['MissionAttribute'] = '1';
                break;
            case 'createRepeatedlyMission':
                input_arr['MissionAttribute'] = '2';
                input_arr['MissionPeriod'] = '0';
                input_arr['MissionPeriodList'] = '0';
                break;
            case 'createSingleTimeMission':
                input_arr['MissionAttribute'] = '3';
                input_arr['MissionEndQuantity'] = '1';
                input_arr['MissionPeriod'] = '9';
                input_arr['MissionPeriodList'] = '9';
                break;
        }
        input_arr['doMissionAction'] = 'doEditMission';
        //console.log(input_arr);
        var url = "index.php?action=MissionAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: input_arr,
            success: function (data) {
                //console.log(data);
                document.location.href = 'index.php?action=Showpage&Content=MissionList';
                //window.location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        })
        //e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    function createMission() {
        var check_form = true;
        $('#createMissionForm').find('.active').eq(1).find('.notnull').each(function (k, v) {
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
        $('#createMissionForm').find('.active').eq(1).find('input').each(function (index, el) {
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
        $("#createMissionForm").find('.active').eq(1).find('select').each(function (index, el) {
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
        switch ($('#createMissionForm').find('.active').eq(1).attr('ID')) {
            case 'createKPIMission':
                input_arr['MissionAttribute'] = '1';
                break;
            case 'createRepeatedlyMission':
                input_arr['MissionAttribute'] = '2';
                input_arr['MissionPeriod'] = '0';
                input_arr['MissionPeriodList'] = '0';
                break;
            case 'createSingleTimeMission':
                input_arr['MissionAttribute'] = '3';
                input_arr['MissionEndQuantity'] = '1';
                input_arr['MissionPeriod'] = '9';
                input_arr['MissionPeriodList'] = '9';
                break;
        }
        //console.log(input_arr);
        var url = "index.php?action=createMission";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: input_arr,
            success: function (data) {
                //window.location.reload();
                document.location.href = 'index.php?action=Showpage&Content=MissionList';
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

    $(document).ready(function () {
    $('.EditMissionBtn').hide();
            $('[data-toggle="tooltip"]').tooltip();
            var url = location.href;
            var ary = url.split('?')[1].split('&');
            for (i = 0; i <= ary.length - 1; i++){
    if (ary[i].split('=')[0] == 'editMission'){
    var MissionID = ary[i].split('=')[1];
            EditMission(MissionID); }
    }
    })



</script>


<div style="clear:both;width:100%">

    <!--<table class="table table-hover" ID="NotFinishTable">-->
    <table class="table table-hover table-sm" ID="MissionTable" style="width:100%">
        <tr ><td colspan="2"  align=left>任務清單</td>
            <td align=right colspan="13">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createMission">新增任務</button>
                <button type="button" class="btn btn-outline-success EditMissionBtn" data-toggle="modal" data-target="#EditMission">修改任務</button>
            </td>
        </tr>
        <tr><td align=center style="white-space:nowrap;">任務ID</td><td align=center style="white-space:nowrap;" colspan="2">任務名稱</td><td align=center>分數</td>
            <td align=center style="white-space:nowrap;">任務開始時間</td>
            <td align=center style="white-space:nowrap;">完成次數/總次數</td>
            <td align=center style="white-space:nowrap;width:150px !important;">進度條</td>
            <td align=center style="white-space:nowrap;">任務類型</td>
            <td align=center style="white-space:nowrap;">功能鍵</td>
        </tr>
        <{foreach key=key item=item from=$ProcessingMission name=ProcessingMission}>
        <tr >
            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MissionID}></td>
            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MissionName}></td>
            <td align=center class="align-middle"><span class="oi oi-info"  data-toggle="tooltip" data-placement="top" title="<{$item.MissionDetails}>"></span></td>
            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MissionPoint}></td>


            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MissionStartTime}></td>
            <{if $item.MissionAttribute=='1'}>            
            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MissionFinishQuantity}> / <{$item.MissionRefreshQuantity}></td>
            <{/if}>
            <td align=center style="white-space:nowrap;" class="align-middle" <{if $item.MissionAttribute=='3'}>colspan="2" <{elseif $item.MissionAttribute=='2'}> colspan="2"<{/if}> ><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated 
                                                                                                                                                                                                        <{if $item.percentage<=60 && $item.MissionAttribute=='3' && $item.MissionStatus=='0'}> bg-success 
                                                                                                                                                                                                        <{elseif $item.percentage>=61 && $item.percentage<=80 && $item.MissionAttribute=='3' && $item.MissionStatus=='0'}> bg-info 
                                                                                                                                                                                                        <{elseif $item.percentage>=81 && $item.percentage<100 && $item.MissionAttribute=='3' && $item.MissionStatus=='0'}> bg-warning  
                                                                                                                                                                                                        <{elseif ($item.percentage>=100 && $item.MissionAttribute=='3' && $item.MissionStatus=='0') or $item.MissionStatus=='3'}> bg-danger 
                                                                                                                                                                                                        <{/if}>"
                                                                                                                                                                                                        role="progressbar" style="width: <{$item.percentage}>%" aria-valuenow="<{$item.percentage}>" aria-valuemin="0" aria-valuemax="100">
                        <{$item.percentage}>%</div>
                </div>
            </td>

            <td align=center style="white-space:nowrap;" class="align-middle"><{$item.MissionAttribute}> . <{$item.MissionAttributeType}></td>
            <td align=center style="white-space:nowrap;" class="align-middle">
                <button id="EditBt<{$item.MissionID}>" type="button" class="btn btn-outline-warning" onclick=EditMission(<{$item.MissionID}>)>修改</button>
                <{if $item.MissionStatus=='0'}>
                <button id="FinishBt<{$item.MissionID}>" type="button" class="btn btn-outline-success" onclick=FinishMission(<{$item.MissionID}>)>完成</button>
                <{elseif $item.MissionStatus=='1' || $item.MissionStatus=='2'}>
                <button id="UnfinishBt<{$item.MissionID}>" type="button" class="btn btn-outline-info" onclick=UnfinishMission(<{$item.MissionID}>)>取消完成</button>
                <{/if}>
                <button id="DelectBt<{$item.MissionID}>" type="button" class="btn btn-outline-danger" onclick=DelectMission(<{$item.MissionID}>)>刪除</button>
            </td></tr>
        <{foreachelse}>
        <tr><td align=center colspan="10">當前沒有任務哦 請先建立任務</td></tr>
        <{/foreach}>


    </table>


    <!-- Create Mission 建立視窗 -->
    <div class="modal fade" id="createMission" tabindex="-1" role="dialog" aria-labelledby="CreateMissionTableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateMissionLongTitle">New Mission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ID="createMissionForm"><ul class="nav nav-tabs" id="CreateTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="KPIMission-tab" data-toggle="tab" href="#createKPIMission" role="tab" aria-controls="KPIMission" aria-selected="true">KPIMission</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="RepeatedlyMission-tab" data-toggle="tab" href="#createRepeatedlyMission" role="tab" aria-controls="RepeatedlyMission" aria-selected="false">RepeatedlyMission</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="SingleTimeMission-tab" data-toggle="tab" href="#createSingleTimeMission" role="tab" aria-controls="SingleTimeMission" aria-selected="false">SingleTimeMission</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="createKPIMission" role="tabpanel" aria-labelledby="KPIMission-tab">
                                <div class="form-group">
                                    <label for="MissionName">任務名稱：</label>
                                    <input type="text" class="form-control notnull" id="MissionName" name="MissionName" placeholder="Enter Mission Name" data-fname="任務名稱">
                                </div>
                                <div class="form-group">
                                    <label for="MissionPoint">任務分數：</label>
                                    <input type="number" class="form-control notnull" id="MissionPoint" name="MissionPoint" placeholder="Enter Mission Point" data-fname="任務分數">
                                </div>
                                <div class="form-group">
                                    <label for="MissionPeriod">任務週期：</label><br>
                                    <input type="number" class="form-control notnull" id="MissionPeriod" name="MissionPeriod" placeholder="Enter Mission Period" style="display: inline;width: 75%;" data-fname="任務週期">
                                    <select ID="MissionPeriodList" name="MissionPeriodList" class="form-control" style="display: inline;width: 24%;">
                                        <option value="1">小時</option>
                                        <option value="2">天</option>
                                        <option value="3">周</option>
                                        <option value="4">月</option>
                                        <option value="5">年</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="MissionEndQuantity">任務結束次數 (選填) ：</label>
                                    <input type="number" class="form-control" id="MissionEndQuantity" name="MissionEndQuantity" placeholder="Enter Mission End Quantity">
                                </div>
                                <div class="form-group">
                                    <label for="MissionStartTime">任務開始時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MissionStartTime" name="MissionStartTime" placeholder="Enter Mission Start Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionStartTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MissionEndTime">任務結束時間 (選填) ：</label>
                                    <input type="datetime-local" class="form-control" id="MissionEndTime" name="MissionEndTime" placeholder="Enter Mission End Time" style="display: inline;width: 80%;">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionEndTime') style="display: inline;width: 19%;">明天4點</button>
                                    <!--input type="hidden" class="form-control" id="MissionAttribute" name="MissionAttribute" -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="createRepeatedlyMission" role="tabpanel" aria-labelledby="RepeatedlyMission-tab">      
                                <div class="form-group">
                                    <label for="MissionName">任務名稱：</label>
                                    <input type="text" class="form-control notnull" id="MissionName" name="MissionName" placeholder="Enter Mission Name" data-fname="任務名稱">
                                </div>
                                <div class="form-group">
                                    <label for="MissionPoint">任務分數：</label>
                                    <input type="number" class="form-control notnull" id="MissionPoint" name="MissionPoint" placeholder="Enter Mission Point" data-fname="任務分數">
                                </div>
                                <div class="form-group">
                                    <label for="MissionEndQuantity">任務結束次數 (選填) ：</label>
                                    <input type="number" class="form-control" id="MissionEndQuantity" name="MissionEndQuantity" placeholder="Enter Mission End Quantity">
                                </div>
                                <div class="form-group">
                                    <label for="MissionStartTime">任務開始時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MissionStartTime" name="MissionStartTime" placeholder="Enter Mission Start Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionStartTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MissionEndTime">任務結束時間 (選填) ：</label>
                                    <input type="datetime-local" class="form-control" id="MissionEndTime" name="MissionEndTime" placeholder="Enter Mission End Time" style="display: inline;width: 80%;">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionEndTime') style="display: inline;width: 19%;">明天4點</button>
                                    <!--input type="hidden" class="form-control" id="MissionAttribute" name="MissionAttribute" -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="createSingleTimeMission" role="tabpanel" aria-labelledby="SingleTimeMission-tab">
                                <div class="form-group">
                                    <label for="MissionName">任務名稱：</label>
                                    <input type="text" class="form-control notnull" id="MissionName" name="MissionName" placeholder="Enter Mission Name" data-fname="任務名稱">
                                </div>
                                <div class="form-group">
                                    <label for="MissionPoint">任務分數：</label>
                                    <input type="number" class="form-control notnull" id="MissionPoint" name="MissionPoint" placeholder="Enter Mission Point" data-fname="任務分數">
                                </div>
                                <div class="form-group">
                                    <label for="MissionStartTime">任務開始時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MissionStartTime" name="MissionStartTime" placeholder="Enter Mission Start Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionStartTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MissionEndTime">任務結束時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MissionEndTime" name="MissionEndTime" placeholder="Enter Mission End Time" style="display: inline;width: 80%;"data-fname="任務結束時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionEndTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success"  id="submitForm" onclick=createMission()>送出</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit Mission 修改視窗-->
    <div class="modal fade" id="EditMission" tabindex="-1" role="dialog" aria-labelledby="EditMissionTableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditMissionLongTitle">Edit Mission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ID="EditMissionForm">
                        <ul class="nav nav-tabs" id="EditTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="KPIMission-tab" data-toggle="tab" href="#editKPIMission" role="tab" aria-controls="KPIMission" aria-selected="true">KPIMission</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="RepeatedlyMission-tab" data-toggle="tab" href="#editRepeatedlyMission" role="tab" aria-controls="RepeatedlyMission" aria-selected="false">RepeatedlyMission</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="SingleTimeMission-tab" data-toggle="tab" href="#editSingleTimeMission" role="tab" aria-controls="SingleTimeMission" aria-selected="false">SingleTimeMission</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="editKPIMission" role="tabpanel" aria-labelledby="KPIMission-tab">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="MissionName" class="col-form-label">任務ID：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext notnull" id="MissionID" name="MissionID" readonly data-fname="任務ID">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionName">任務名稱：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control notnull" id="MissionName" name="MissionName" placeholder="Enter Mission Name" data-fname="任務名稱">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionDetails">任務說明：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="MissionDetails" name="MissionDetails" placeholder="Enter Mission Details" data-fname="任務說明">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionPoint">任務分數：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control notnull" id="MissionPoint" name="MissionPoint" placeholder="Enter Mission Point" data-fname="任務分數">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionPeriod">任務週期：</label><br>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control notnull" id="MissionPeriod" name="MissionPeriod" placeholder="Enter Mission Period"  data-fname="任務週期">
                                    </div>
                                    <div class="col-sm-3">
                                        <select ID="MissionPeriodList" name="MissionPeriodList" class="custom-select" >
                                            <option value="1">小時</option>
                                            <option value="2">天</option>
                                            <option value="3">周</option>
                                            <option value="4">月</option>
                                            <option value="5">年</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionEndQuantity">任務結束次數 (選填)：</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" id="MissionEndQuantity" name="MissionEndQuantity" placeholder="Enter Mission End Quantity">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="MissionStartTime">任務開始時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MissionStartTime" name="MissionStartTime" placeholder="Enter Mission Start Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionStartTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MissionEndTime">任務結束時間 (選填) ：</label>
                                    <input type="datetime-local" class="form-control" id="MissionEndTime" name="MissionEndTime" placeholder="Enter Mission End Time" style="display: inline;width: 80%;">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionEndTime') style="display: inline;width: 19%;">明天4點</button>
                                    <!--input type="hidden" class="form-control" id="MissionAttribute" name="MissionAttribute" -->
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionStatus">任務狀態：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select ID="MissionStatus" name="MissionStatus" class="custom-select" >
                                            0:未完成 1:完成 2:結束 3:失敗 9:刪除
                                            <option value="0">0 . 未完成</option>
                                            <option value="1">1 . 完成</option>
                                            <option value="2">2 . 結束</option>
                                            <option value="3">3 . 失敗</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--
                                /* `MissionID`, `MissionName`, `MissionDetails`, `MissionPoint`,
                                  `MissionCreateTime`, `MissionStartTime`, `MissionLastFinishTime`,
                                  `MissionRefreshTime`, `MissionEndTime`, `MissionFinishQuantity`,
                                  `MissionRefreshQuantity`, `MissionStatus`, `MissionEndQuantity`,
                                  `MissionPeriod`, `MissionPeriodList`, `MissionAttribute` */
                            -->
                            <div class="tab-pane fade" id="editRepeatedlyMission" role="tabpanel" aria-labelledby="RepeatedlyMission-tab">   
                                <div class="form-row">
                                    <div class="col">
                                        <label for="MissionName" class="col-form-label">任務ID：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext notnull" id="MissionID" name="MissionID" readonly data-fname="任務ID">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionName">任務名稱：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control notnull" id="MissionName" name="MissionName" placeholder="Enter Mission Name" data-fname="任務名稱">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionDetails">任務說明：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="MissionDetails" name="MissionDetails" placeholder="Enter Mission Details" data-fname="任務說明">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionPoint">任務分數：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control notnull" id="MissionPoint" name="MissionPoint" placeholder="Enter Mission Point" data-fname="任務分數">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionEndQuantity">任務結束次數 (選填)：</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" id="MissionEndQuantity" name="MissionEndQuantity" placeholder="Enter Mission End Quantity">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="MissionStartTime">任務開始時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MissionStartTime" name="MissionStartTime" placeholder="Enter Mission Start Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionStartTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MissionEndTime">任務結束時間 (選填) ：</label>
                                    <input type="datetime-local" class="form-control" id="MissionEndTime" name="MissionEndTime" placeholder="Enter Mission End Time" style="display: inline;width: 80%;">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionEndTime') style="display: inline;width: 19%;">明天4點</button>
                                    <div class="form-row">
                                        <div class="col col-form-label ">
                                            <label for="MissionStatus">任務狀態：</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select ID="MissionStatus" name="MissionStatus" class="custom-select" >
                                                0:未完成 1:完成 2:結束 3:失敗 9:刪除
                                                <option value="0">0 . 未完成</option>
                                                <option value="1">1 . 完成</option>
                                                <option value="2">2 . 結束</option>
                                                <option value="3">3 . 失敗</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--input type="hidden" class="form-control" id="MissionAttribute" name="MissionAttribute" -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="editSingleTimeMission" role="tabpanel" aria-labelledby="SingleTimeMission-tab">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="MissionName" class="col-form-label">任務ID：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext notnull" id="MissionID" name="MissionID" readonly data-fname="任務ID">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionName">任務名稱：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control notnull" id="MissionName" name="MissionName" placeholder="Enter Mission Name" data-fname="任務名稱">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionDetails">任務說明：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="MissionDetails" name="MissionDetails" placeholder="Enter Mission Details" data-fname="任務說明">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionPoint">任務分數：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control notnull" id="MissionPoint" name="MissionPoint" placeholder="Enter Mission Point" data-fname="任務分數">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="MissionStartTime">任務開始時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MissionStartTime" name="MissionStartTime" placeholder="Enter Mission Start Time" style="display: inline;width: 80%;"data-fname="任務開始時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionStartTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-group">
                                    <label for="MissionEndTime">任務結束時間 ：</label>
                                    <input type="datetime-local" class="form-control notnull" id="MissionEndTime" name="MissionEndTime" placeholder="Enter Mission End Time" style="display: inline;width: 80%;"data-fname="任務結束時間">
                                    <button type="button" class="btn btn-light" onclick=setTime('MissionEndTime') style="display: inline;width: 19%;">明天4點</button>
                                </div>
                                <div class="form-row">
                                    <div class="col col-form-label ">
                                        <label for="MissionStatus">任務狀態：</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select ID="MissionStatus" name="MissionStatus" class="custom-select" >
                                            0:未完成 1:完成 2:結束 3:失敗 9:刪除
                                            <option value="0">0 . 未完成</option>
                                            <option value="1">1 . 完成</option>
                                            <option value="2">2 . 結束</option>
                                            <option value="3">3 . 失敗</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success"  id="submitForm" onclick=editMission()>送出</button>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--tr ><td colspan="2"  align=left>任務清單</td><td align=right colspan="13"><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createMission">新增任務</button></td></tr>
    <tr><td align=center style="white-space:nowrap;">任務ID</td><td align=center style="white-space:nowrap;" colspan="2">任務名稱</td><td align=center>分數</td>
    
    <td align=center style="white-space:nowrap;">任務建立時間</td><td align=center style="white-space:nowrap;">任務開始時間</td>
    <td align=center style="white-space:nowrap;">上次完成時間</td><td align=center style="white-space:nowrap;">任務結束時間</td>
    <td align=center style="white-space:nowrap;">任務狀態</td>
    
    <td align=center style="white-space:nowrap;">上次更新時間/週期</td><td align=center style="white-space:nowrap;">完成次數/總次數</td><td align=center style="white-space:nowrap;">任務結束次數</td>
    <td align=center style="white-space:nowrap;width:150px !important;">進度條</td>
    <td align=center style="white-space:nowrap;">任務類型</td>
    <td align=center style="white-space:nowrap;">功能鍵</td>
    </tr-->
    <!--{ foreach key=key item=item from=$ProcessingMission name=ProcessingMission}>
    <tr >
    <td align=center style="white-space:nowrap;"><{$item.MissionID}></td>
    <td align=center style="white-space:nowrap;"><{$item.MissionName}></td>
    <td  align=center><span class="oi oi-info"  data-toggle="tooltip" data-placement="top" title="<{$item.MissionDetails}>"></span></td>
    <td align=center style="white-space:nowrap;"><{$item.MissionPoint}></td>
    
    <td align=center style="white-space:nowrap;"><{$item.MissionCreateTime}></td>
    <td align=center style="white-space:nowrap;"><{$item.MissionStartTime}></td>
    <td align=center style="white-space:nowrap;"><{$item.MissionLastFinishTime}></td>
    <td align=center style="white-space:nowrap;"><{$item.MissionEndTime}></td>
    <td align=center style="white-space:nowrap;"><{$item.MissionStatusR}></td>
    <{if $item.MissionAttribute=='1'}>
    <td align=center style="white-space:nowrap;"><{$item.MissionRefreshTime}> / <{$item.MissionPeriod}></td>
    <td align=center style="white-space:nowrap;"><{$item.MissionFinishQuantity}> / <{$item.MissionRefreshQuantity}></td>
    <td align=center style="white-space:nowrap;"><{$item.MissionEndQuantity}></td>
    <{elseif $item.MissionAttribute=='2'}>
    <td align=center style="white-space:nowrap;"><{$item.MissionRefreshTime}> </td>
    <td align=center style="white-space:nowrap;"><{$item.MissionFinishQuantity}> </td>
    <{/if}>
    <td align=center style="white-space:nowrap;" <{if $item.MissionAttribute=='3'}>colspan="4" <{elseif $item.MissionAttribute=='2'}> colspan="2"<{/if}> ><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated 
                                                                                                                                                                                     <{if $item.percentage<=60 && $item.MissionAttribute=='3' && $item.MissionStatus=='0'}> bg-success 
                                                                                                                                                                                     <{elseif $item.percentage>=61 && $item.percentage<=80 && $item.MissionAttribute=='3' && $item.MissionStatus=='0'}> bg-info 
                                                                                                                                                                                     <{elseif $item.percentage>=81 && $item.percentage<100 && $item.MissionAttribute=='3' && $item.MissionStatus=='0'}> bg-warning  
                                                                                                                                                                                     <{elseif ($item.percentage>=100 && $item.MissionAttribute=='3' && $item.MissionStatus=='0') or $item.MissionStatus=='3'}> bg-danger 
                                                                                                                                                                                     <{/if}>"
                                                                                                                                                                                     role="progressbar" style="width: <{$item.percentage}>%" aria-valuenow="<{$item.percentage}>" aria-valuemin="0" aria-valuemax="100">
                <{$item.percentage}>%</div>
        </div>
    </td>
    
    <td align=center style="white-space:nowrap;"><{$item.MissionAttribute}></td>
    <td align=center style="white-space:nowrap;">
        <button id="EditBt<{$item.MissionID}>" type="button" class="btn btn-outline-warning" onclick=EditMission(<{$item.MissionID}>)>修改</button>
        <button id="FinishBt<{$item.MissionID}>" type="button" class="btn btn-outline-success" onclick=FinishMission(<{$item.MissionID}>)>完成</button>
        <button id="DelectBt<{$item.MissionID}>" type="button" class="btn btn-outline-danger" onclick=DelectMission(<{$item.MissionID}>)>刪除</button>
    </td></tr>
    <{ foreachelse}>
    <tr><td align=center colspan="10">當前沒有任務哦 請先建立任務</td></tr>
    <!{ /foreach}-->