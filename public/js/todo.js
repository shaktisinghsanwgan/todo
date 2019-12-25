var changeAssignto=function(str){
    $(".assignee").hide();
    $(".collegue_id").hide( );
    $("#assignee").val('');
    $("#collegue_id").val('');
    if(str!=''){
        if(str=="assignee"){
            $(".assignee").css('display','flex');
        }else{
            $(".collegue_id").css('display','flex');
        }
    }
}

var saveTodo=function(str,status){
var task_name=$("#task_name").val();
var task_id=$("#task_id").val();
var task_assignee=$("#assignee").val();
var collegue_id=$("#collegue_id").val();
var time_line=$("#timeline").val();
var task_description=CKEDITOR.instances.task_description.getData();
if(task_name=="" || task_description==''||time_line==''){
    displayMsg('error','Please Fill All the Details 1');
}else{
    if(task_assignee=="" && collegue_id==''){
        displayMsg('error','Please Fill All the Details 2');
    }else{
        if(str=="save"){
            $('#saveTodoMain').prop('disabled',true);
            $('#saveTodoMain').html('Saving...');
        }else{
            $('#saveAndEditTodo').prop('disabled',true);
            $('#saveAndEditTodo').html('Saving...');
        }
        var data={
            task_id:task_id,
            task_name:task_name,
            task_description:task_description,
            task_assignee:task_assignee,
            collegue_id:collegue_id,
            time_line:time_line,
            status:status
        };
        var ajaxCall=callAjax('post',urlsaveTask,data);
        ajaxCall.done(function(res){
            displayMsg('success',"Status Updated Successfully :)");
            if(str=="save"){
                $('#saveTodoMain').prop('disabled',false);
                $('#saveTodoMain').html('Save Todo');
                location.href="/todo";
            }else{
                $("#task_id").val(res.trim());
                $("#saveTodoMain").attr('onclick',"saveTodo('save','update')");
                $("#saveTodoMain").html('Update Todo');
                $("#saveAndEditTodo").attr('onclick',"saveTodo('save_and_next','update')");
                $('#saveAndEditTodo').prop('disabled',false);
                $("#saveAndEditTodo").html('Update and Add Sub Task');
                $('#taskMainLi').removeClass('active');
                $('#SubtaskLi').removeClass('disabled');
                $('#SubtaskAnchor').addClass('active');
                $('#taskMainDiv').hide();
                $('#subTaskDiv').show('slow');
            }
        });
        ajaxCall.fail(function(){
                displayMsg('error','Something Went Wrong');
        });
    }
}
}

$(document).ready(function(){
$("#taskMainLi").click(function(){
    $('#taskMainLi').addClass('active');
    $('#SubtaskAnchor').removeClass('active');
    $('#taskMainDiv').show('slow');
    $('#subTaskDiv').hide();
});
$("#SubtaskLi").click(function(){
    if(!$('#SubtaskLi').hasClass('disabled')){
        $('#taskMainLi').removeClass('active');
        $('#SubtaskAnchor').removeClass('disabled');
        $('#SubtaskAnchor').addClass('active');
        $('#taskMainDiv').hide();
        $('#subTaskDiv').show('slow');
    }
});
});
var saveSubtask=function(str){
    var task_id=$("#task_id").val();
    var subtask_id=$("#subtask_id").val();
    var sub_task_name=$("#sub_task_name").val();
    var sub_task_description=CKEDITOR.instances.sub_task_description.getData();
    var subtask_timeline=$("#subtask_timeline").val();
    if(task_name=="" || task_description==''||subtask_timeline==''){
        displayMsg('error','Please Fill All the Details 1');
    }else{
        $("#subTaskButton").prop('disabled','true');
        if(str=='save'){
            $("#subTaskButton").html('saving...');
        }else{
            $("#subTaskButton").html('updating...');
        }
        var data={
            task_id:task_id,
            subtask_id:subtask_id,
            sub_task_name:sub_task_name,
            sub_task_description:sub_task_description,
            sub_task_timeline:subtask_timeline,
            data_type:'save',
        };
        var ajaxCall=callAjax('post',urlSaveSubTask,data);
        ajaxCall.done(function(res){
                $("#subTaskButton").prop('disabled',false);
                displayMsg('success',"Sub Task Updated Successfully :)");
                if(subtask_id!='no'){
                    $("#sub_task_name_"+res).html(sub_task_name);
                    $("#subtask_timeline_"+res).html(subtask_timeline);
                }else{
                    $("#sub_task_tbody").append(`
                    <tr id="sub_task_tr_`+res+`">
                    <td id="sub_task_name_`+res+`">`+sub_task_name+`</td>
                    <td id="subtask_timeline_`+res+`">`+subtask_timeline.replace('T'," ")+`</td>
                    <td>
                    <a href="javascript:void(0)" onclick="edit_subtask_details('`+res.trim()+`')"><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0)" onclick="delete_subtask('`+res.trim()+`')"><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                    `);
                }
                    $("#subtaskModal").modal('hide');
        });
        ajaxCall.fail(function(){
                displayMsg('error','Something Went Wrong');
        });
    }
}
var showSubtaskModal=function(){
    CKEDITOR.instances.sub_task_description.setData('');
    $("#subtask_id").val('no');
    $("#subTaskButton").prop('disabled',false);
    $("#sub_task_name").val('');
    $("#subtask_timeline").val('');
    $("#subTaskButton").attr('onclick',"saveSubtask('save')");
    $("#subTaskButton").html('Save Sub Task');
    $("#subtaskModal").modal('show');
}
var edit_subtask_details=function(id){
    $("#subtask_id").val(id);
    var data={
        subtask_id:id
    };
    var ajaxCall=callAjax('post',urlFetchSubTask,data);
    ajaxCall.done(function(res){
        var rasData=JSON.parse(res);
        $("#sub_task_name").val(rasData.sub_task_name);
        $("#subtask_timeline").val(rasData.sub_task_timeline);
        CKEDITOR.instances.sub_task_description.setData(rasData.sub_task_description);
        $("#subTaskButton").attr('onclick',"saveSubtask('update')");
        $("#subTaskButton").prop('disabled',false);
        $("#subTaskButton").html('Update Sub Task');
        $("#subtaskModal").modal('show');
    });
}
var delete_subtask=function(str){
    var conf=confirm('Once Deleted Cannot Be Undone. Are You Sure You want to Delete this Sub Task !!!');
    if(conf){
        var data={
            subtask_id:str
        };
        var ajaxCall=callAjax('post',urlDeleteSubTask,data);
        ajaxCall.done(function(res){
            displayMsg('error','Sub Task Deleted Successfully');
            $("#sub_task_tr_"+str).remove();
        });

    }
}
