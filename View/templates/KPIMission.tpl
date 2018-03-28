<script>
    function FinishMission(ID) {
        var url = "index.php?action=MissionAction";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {MissionID: ID, doMissionAction: 'finishKPIMission'}, // serializes the form's elements.
            success: function (data)
            {
                window.location.reload();
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
            data: {MissionID: ID, doMissionAction: 'unfinishKPIMission'}, // serializes the form's elements.
            success: function (data)
            {
                window.location.reload();
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
                window.location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }
    function createMission() {
        //$('#MissionAttribute').val('1');
        var check_form = true;
        $('.notnull').each(function (k, v) {
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
        $("#createMissionForm").find('input').each(function (index, el) {
            if ($(this).val() == '') {
                var name = $(this).attr('name');
                input_arr[name] = 'NULL';
            }

            if ($(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio') {
                var name = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
            if ($(this).attr('type') == 'radio' && $(this).attr('checked') == 'checked') {
                var na = $(this).attr('name');
                input_arr[name] = $(this).val();
            }
        });
        $("#createMissionForm").find('select').each(function (index, el) {
            var name = $(this).attr('name');
            input_arr[name] = $(this).val();
        });
        input_arr['MissionAttribute'] = '1';
        //console.log(input_arr);
        var url = "index.php?action=createMission";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: input_arr,
            success: function (data) {
                /*console.log(data);
                 alert('您建立了一個序號為' + data[0]['MissionID'] + '的' + data[0]['MissionName'] + '任務');*/
                window.location.reload();
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
        $('#' + field).val(d.getFullYear() + '-' + (d.getMonth() + 1 < 10 ? '0' : '') + (d.getMonth() + 1) + '-' + (d.getDate() + 1) + 'T04:00');
    }
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })


</script>


<div >

    <!--<table class="table table-hover" ID="NotFinishTable">-->
    <table class="table table-hover" ID="MissionTable">
        <tr ><td colspan="2"  align=left>未完成任務</td><td align=right colspan="8"><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createMission">新增任務</button></td></tr>
        <tr><td align=center>任務ID</td><td align=center>任務名稱</td><td align=center>分數</td>
            <td align=center>上次完成時間</td><td align=center>下次刷新時間</td><td align=center>循環週期</td>
            <td align=center>完成次數</td><td align=center>功能鍵</td></tr>
        <{foreach key=key item=item from=$ProcessingMission name=ProcessingMission}>
        <tr ><td align=center ><{$item.MissionID}></td><td align=center><{$item.MissionName}><span class="oi oi-info" style="float:right;" data-toggle="tooltip" data-placement="top" title="<{$item.MissionDetails}>"></span></td><td align=center><{$item.MissionPoint}></td>
            <td align=center><{$item.MissionLastFinishTime}></td><td align=center><{$item.NextRefreshTime}></td><td align=center><{$item.MissionPeriod}><{$item.MissionPeriodList}></td>
            <td align="center"><{$item.MissionFinishQuantity}></td>
            <td align=center>
                <button id="EditBt<{$item.MissionID}>" type="button" class="btn btn-outline-warning" onclick=EditMission(<{$item.MissionID}>)>修改</button>
                <button id="FinishBt<{$item.MissionID}>" type="button" class="btn btn-outline-success" onclick=FinishMission(<{$item.MissionID}>)>完成</button>
                <button id="DelectBt<{$item.MissionID}>" type="button" class="btn btn-outline-danger" onclick=DelectMission(<{$item.MissionID}>)>刪除</button>
            </td></tr>
        <{foreachelse}>
        <tr><td align=center colspan="10">當前沒有任務哦 請先建立任務</td></tr>
        <{/foreach}>
        <!--</table>
        <table class="table table-hover" ID="FinishTable">-->
        <tr ><td colspan="2" align=left>已完成任務</td><td align=right colspan="8"><button type="button" class="btn btn-outline-success disabled">已完成任務</button></td></tr>
        <tr><td align=center>任務ID</td><td align=center>任務名稱</td><td align=center>分數</td>
            <td align=center>上次完成時間</td><td align=center>下次刷新時間</td><td align=center>循環週期</td>
            <td align=center>完成次數</td><td align=center>功能鍵</td></tr>
        <{foreach key=key item=item2 from=$FinishMission name=FinishMission}>
        <tr ><td align=center ><{$item2.MissionID}></td><td align=center><{$item2.MissionName}><span class="oi oi-info" style="float:right;" data-toggle="tooltip" data-placement="top" title="<{$item2.MissionDetails}>"></span></td><td align=center><{$item2.MissionPoint}></td>
            <td align=center><{$item2.MissionLastFinishTime}></td><td align=center><{$item2.NextRefreshTime}></td><td align=center><{$item2.MissionPeriod}><{$item2.MissionPeriodList}></td>
            <td align="center"><{$item2.MissionFinishQuantity}></td>
            <td align=center>
                <button id="EditBt<{$item2.MissionID}>" type="button" class="btn btn-outline-warning" onclick=EditMission(<{$item2.MissionID}>)>修改</button>
                <button id="FinishBt<{$item2.MissionID}>" type="button" class="btn btn-outline-secondary" onclick=UnfinishMission(<{$item2.MissionID}>)>取消完成</button>
                <button id="DelectBt<{$item2.MissionID}>" type="button" class="btn btn-outline-danger" onclick=DelectMission(<{$item2.MissionID}>)>刪除</button>
            </td></tr>
        <{foreachelse}>
        <tr><td align=center colspan="10">當前沒有已完成任務哦</td></tr>
        <{/foreach}>

    </table>

    <!-- Modal -->
    <div class="modal fade" id="createMission" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Mission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ID="createMissionForm">
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
                        <button type="button" class="btn btn-success"  id="submitForm" onclick=createMission()>送出</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

