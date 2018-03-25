<script>
    function FinishMission(ID) {
        var url = "index.php?action=MissionAction";
        $.ajax({
            type: "POST",
            url: url,
            data: {RowID: ID,doAction:'KPIFinish'}, // serializes the form's elements.
            success: function (data)
            {
                alert("已變更任務狀態");
                /*console.log(data);
                 if (data == 'true') {
                 alert("已變更任務狀態");
                 } else {
                 alert("任務狀態變更失敗");
                 }*/
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
            data: {RowID: ID,doAction:'KPIDelect'}, // serializes the form's elements.
            success: function (data)
            {
                console.log(data);
                alert("已刪除任務");
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
            data: {RowID: ID,doAction:'KPIUnfinish'}, // serializes the form's elements.
            success: function (data)
            {
                alert("已變更任務狀態");
                //console.log(data);
                /*if (data == 'true') {
                 alert("已變更任務狀態");
                 } else {
                 alert("任務狀態變更失敗");
                 }*/
                window.location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    }




</script>


<div style="clear:both;">

    <!--<table class="table table-hover" ID="NotFinishTable">-->
    <table class="table table-hover" ID="MissionTable">
        <tr ><td colspan="2">未完成任務</td><td align=right colspan="8"><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createMission">新增任務</button></td></tr>
        <tr><td align=center>任務ID</td><td align=center>任務名稱</td><td align=center>分數</td>
            <td align=center>上次完成時間</td><td align=center>下次刷新時間</td><td align=center>循環週期</td>
            <td align=center>完成次數</td><td align=center>功能鍵</td></tr>
        <{foreach key=key item=item from=$ProcessingMission name=ProcessingMission}>
        <tr ><td align=center ><{$item.MissionID}></td><td align=center><{$item.MissionName}></td><td align=center><{$item.MissionPoint}></td>
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
        <tr ><td colspan="2">已完成任務</td><td align=right colspan="8"><button type="button" class="btn btn-outline-success disabled">已完成任務</button></td></tr>
        <tr><td align=center>任務ID</td><td align=center>任務名稱</td><td align=center>分數</td>
            <td align=center>上次完成時間</td><td align=center>下次刷新時間</td><td align=center>循環週期</td>
            <td align=center>完成次數</td><td align=center>功能鍵</td></tr>
        <{foreach key=key item=item2 from=$FinishMission name=FinishMission}>
        <tr ><td align=center ><{$item2.MissionID}></td><td align=center><{$item2.MissionName}></td><td align=center><{$item2.MissionPoint}></td>
            <td align=center><{$item2.MissionLastFinishTime}></td><td align=center><{$item2.NextRefreshTime}></td><td align=center><{$item2.MissionPeriod}><{$item2.MissionPeriodList}></td>
            <td align="center"><{$item2.MissionFinishQuantity}></td>
            <td align=center>
                <button id="EditBt<{$item2.MissionID}>" type="button" class="btn btn-outline-warning" onclick=EditMission(<{$item2.MissionID}>)>修改</button>
                <button id="FinishBt<{$item2.MissionID}>" type="button" class="btn btn-outline-success" onclick=FinishMission(<{$item2.MissionID}>)>完成</button>
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
                        <table class="table">
                            <tr><td>任務名稱：</td><td><input type="text" name="MissionName" ID="MissionName" class="form-control"></td></tr>
                            <tr><td>任務分數：</td><td><input type="number" name="MissionPoint" ID="MissionPoint" class="form-control"></td></tr>
                            <tr><td>任務週期：</td><td><input type="number" name="MissionPeriod" ID="MissionPeriod" class="form-control">
                                    <select ID="MissionPeriodList" name="MissionPeriodList" class="form-control" style="display: inline;width: 30%;">
                                        <option value="1">小時</option>
                                        <option value="2">天</option>
                                        <option value="3">月</option>
                                        <option value="4">年</option>
                                    </select></td></tr>
                            <tr><td>任務結束次數 (選填) ：</td><td><input type="number" name="MissionEndQuantity" ID="MissionEndQuantity" class="form-control"></td></tr>                            
                            <tr><td>任務開始時間 　　　 ：</td><td><input type="datetime-local" name="StartTime" ID="StartTime" class="form-control"></td></tr>
                            <tr><td>任務結束時間 (選填) ：</td><td><input type="datetime-local" name="MissionEndTime" ID="MissionEndTime" class="form-control"></td></tr>                            
                        </table>
                        <button type="submit" class="btn btn-success"  id="submitForm">送出</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- showOrtheMission Modal -->
    <div id="showOrtheMission" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mission List</h4>
                </div>
                <div class="modal-body">
                    <form ID="createMissionForm">
                        <table class="table">
                            <tr><td>任務名稱：</td><td><input type="text" name="MissionName" ID="MissionName"></td></tr>
                            <tr><td>任務分數：</td><td><input type="number" name="MissionPoint" ID="MissionPoint"></td></tr>
                            <tr><td>任務週期：</td><td><input type="number" name="MissionPeriod" ID="MissionPeriod">
                                    <select ID="MissionPeriodList" name="MissionPeriodList" class="form-control" style="display: inline;width: 30%;">
                                        <option value="1">小時</option>
                                        <option value="2">天</option>
                                        <option value="3">月</option>
                                        <option value="4">年</option>
                                    </select></td></tr>
                            <tr><td>任務結束次數 (選填) ：</td><td><input type="number" name="MissionEndQuantity" ID="MissionEndQuantity"></td></tr>                            
                            <tr><td>任務開始時間 　　　 ：</td><td><input type="datetime-local" name="StartTime" ID="StartTime"></td></tr>
                            <tr><td>任務結束時間 (選填) ：</td><td><input type="datetime-local" name="MissionEndTime" ID="MissionEndTime"></td></tr>                            
                        </table>
                        <button type="submit" class="btn btn-success"  id="submitForm">送出</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#createMissionForm").submit(function (e) {

        var url = "index.php?action=createKPIMission"; // the script where you handle the form input.
        //var url = "Controller/Action/createMission.php";
        //console.log($("#createMissionForm").serialize());
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $("#createMissionForm").serialize(), // serializes the form's elements.
            success: function (data) {
                console.log(data);
                if (data['Returnmsg'] == 'Not Login') {
                    alert('您尚未登入');
                } else {
                    alert('您建立了一個序號為' + data[0]['MissionID'] + '的' + data[0]['MissionName'] + '任務');
                }
                //$("#NotFinishTable").append("<tr ><td align=center ></td><td></td><td></td><td ></td><td id=MS<$smarty.foreach.Mission.iteration}>></td><td></td><td align=center><button id=Bt type=button class=btn btn-success onclick=FinishMission(<$item.MissionID}>,<$item.MissionStatus}>)>完成</button></td></tr>")
            },
            error: function (data) {

                console.log('An error occurred.');
                console.log(data);
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    })
</script>