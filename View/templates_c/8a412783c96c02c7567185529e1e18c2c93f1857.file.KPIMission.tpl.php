<?php /* Smarty version Smarty-3.1.19, created on 2018-03-15 14:07:14
         compiled from "View\templates\KPIMission.tpl" */ ?>
<?php /*%%SmartyHeaderCode:54175a882ab64a4607-17941614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a412783c96c02c7567185529e1e18c2c93f1857' => 
    array (
      0 => 'View\\templates\\KPIMission.tpl',
      1 => 1521121512,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54175a882ab64a4607-17941614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5a882ab6715696_38792318',
  'variables' => 
  array (
    'ProcessingMission' => 0,
    'item' => 0,
    'FinishMission' => 0,
    'item2' => 0,
    'EndMission' => 0,
    'item3' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a882ab6715696_38792318')) {function content_5a882ab6715696_38792318($_smarty_tpl) {?><script>
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
        <tr ><td colspan="2">未完成任務</td><td align=right colspan="8"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#createMission">新增任務</button></td></tr>
        <tr><td align=center>任務ID</td><td align=center>專屬ID</td><td align=center>任務名稱</td><td align=center>分數</td><td align=center>循環週期</td><td align=center>上次完成時間</td><td align=center>任務結束時間</td><td align=center>任務完成次數</td><td align="center">任務目標次數</td><td align=center>功能鍵</td></tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ProcessingMission']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
        <tr ><td align=center ><?php echo $_smarty_tpl->tpl_vars['item']->value['MissionID'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item']->value['RowID'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item']->value['MissionName'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item']->value['MissionPoint'];?>
</td>
            <td align=center><?php echo $_smarty_tpl->tpl_vars['item']->value['MissionPeriod'];?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['MissionPeriodList'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item']->value['LastFinishTime'];?>
</td>
            <td align=center><?php echo $_smarty_tpl->tpl_vars['item']->value['MissionEndTime'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item']->value['FinishQuantity'];?>
</td><td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['MissionEndQuantity'];?>
</td>
            <td align=center>
                <button id="EditBt<?php echo $_smarty_tpl->tpl_vars['item']->value['RowID'];?>
" type="button" class="btn btn-success" onclick=EditMission(<?php echo $_smarty_tpl->tpl_vars['item']->value['RowID'];?>
)>完成</button>
                <button id="FinishBt<?php echo $_smarty_tpl->tpl_vars['item']->value['RowID'];?>
" type="button" class="btn btn-success" onclick=FinishMission(<?php echo $_smarty_tpl->tpl_vars['item']->value['RowID'];?>
)>完成</button>
                <button id="DelectBt<?php echo $_smarty_tpl->tpl_vars['item']->value['RowID'];?>
" type="button" class="btn btn-danger" onclick=DelectMission(<?php echo $_smarty_tpl->tpl_vars['item']->value['RowID'];?>
)>刪除</button>
            </td></tr>
        <?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
        <tr><td align=center colspan="10">當前沒有任務哦 請先建立任務</td></tr>
        <?php } ?>
        <!--</table>
        <table class="table table-hover" ID="FinishTable">-->
        <tr ><td colspan="2">已完成任務</td><td align=right colspan="8"><button type="button" class="btn btn-success disabled">已完成任務</button></td></tr>
        <tr><td align=center>任務ID</td><td align=center>專屬ID</td><td align=center>任務名稱</td><td align=center>分數</td><td align=center>循環週期</td><td align=center>上次完成時間</td><td align=center>任務結束時間</td><td align=center>任務完成次數</td><td align="center">任務目標次數</td><td align=center>功能鍵</td></tr>
        <?php  $_smarty_tpl->tpl_vars['item2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item2']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FinishMission']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item2']->key => $_smarty_tpl->tpl_vars['item2']->value) {
$_smarty_tpl->tpl_vars['item2']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item2']->key;
?>
        <tr ><td align=center ><?php echo $_smarty_tpl->tpl_vars['item2']->value['MissionID'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item2']->value['RowID'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item2']->value['MissionName'];?>
</td>
            <td align=center><?php echo $_smarty_tpl->tpl_vars['item2']->value['MissionPoint'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item2']->value['MissionPeriod'];?>
<?php echo $_smarty_tpl->tpl_vars['item2']->value['MissionPeriodList'];?>
</td>
            <td align=center><?php echo $_smarty_tpl->tpl_vars['item2']->value['LastFinishTime'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item2']->value['MissionEndTime'];?>
</td>
            <td align=center><?php echo $_smarty_tpl->tpl_vars['item2']->value['FinishQuantity'];?>
</td><td align="center"><?php echo $_smarty_tpl->tpl_vars['item2']->value['MissionEndQuantity'];?>
</td>
            <td align=center>
                <button id="UnfinishBt<?php echo $_smarty_tpl->tpl_vars['item2']->value['RowID'];?>
" type="button" class="btn btn-warning" onclick=UnfinishMission(<?php echo $_smarty_tpl->tpl_vars['item2']->value['RowID'];?>
)>取消</button>
                <button id="DelectBt<?php echo $_smarty_tpl->tpl_vars['item2']->value['RowID'];?>
" type="button" class="btn btn-danger" onclick=DelectMission(<?php echo $_smarty_tpl->tpl_vars['item2']->value['RowID'];?>
)>刪除</button>
            </td></tr>
        <?php }
if (!$_smarty_tpl->tpl_vars['item2']->_loop) {
?>
        <tr><td align=center colspan="10">當前沒有已完成任務哦</td></tr>
        <?php } ?>
        <tr ><td colspan="2">已結束任務</td><td align=right colspan="8"><button type="button" class="btn btn-success disabled">已結束任務</button></td></tr>

        <tr><td align=center>任務ID</td><td align=center>專屬ID</td><td align=center>任務名稱</td><td align=center>分數</td><td align=center>循環週期</td><td align=center>上次完成時間</td><td align=center>任務結束時間</td><td align=center>任務完成次數</td><td align="center">任務目標次數</td><td align=center>功能鍵</td></tr>
        <?php  $_smarty_tpl->tpl_vars['item3'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item3']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['EndMission']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item3']->key => $_smarty_tpl->tpl_vars['item3']->value) {
$_smarty_tpl->tpl_vars['item3']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item3']->key;
?>        
        <tr><td align=center ><?php echo $_smarty_tpl->tpl_vars['item3']->value['MissionID'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item3']->value['RowID'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item3']->value['MissionName'];?>
</td>
            <td align=center><?php echo $_smarty_tpl->tpl_vars['item3']->value['MissionPoint'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item3']->value['MissionPeriod'];?>
<?php echo $_smarty_tpl->tpl_vars['item3']->value['MissionPeriodList'];?>
</td>
            <td align=center><?php echo $_smarty_tpl->tpl_vars['item3']->value['LastFinishTime'];?>
</td><td align=center><?php echo $_smarty_tpl->tpl_vars['item3']->value['MissionEndTime'];?>
</td>
            <td align=center><?php echo $_smarty_tpl->tpl_vars['item3']->value['FinishQuantity'];?>
</td><td align="center"><?php echo $_smarty_tpl->tpl_vars['item3']->value['MissionEndQuantity'];?>
</td>
            <td align=center>
            </td></tr>
        <?php }
if (!$_smarty_tpl->tpl_vars['item3']->_loop) {
?>
        <tr><td align=center colspan="10">當前沒有已結束任務哦</td></tr>
        <?php } ?>

    </table>

    <!-- createMission Modal -->
    <div id="createMission" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Mission</h4>
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
</script><?php }} ?>
