$(document).ready(function(){
    data={
        fetchData:'fetchData'
    };
    var ajaxCall=callAjax('post',urlFetchAllTodos,data);
        ajaxCall.done(function(res){
            localStorage.setItem('todos',res);
            $(".loading").remove();
        });
        $("#taskAllLi").click(function(){
            $('#taskALLAnchor').addClass('active');
            if($('#CompletedTaskAnchor').hasClass('active')){
                $('#CompletedTaskAnchor').removeClass('active');
            }
            if($('#myTaskAnchor').hasClass('active')){
                $('#myTaskAnchor').removeClass('active');
            }
            $('#searchDivMain').show('slow');
            $('#completedTaskDiv').hide();
            $('#myTaskDiv').hide();
        });
        $("#taskAllLi").click(function(){
            $('#taskALLAnchor').addClass('active');
            if($('#CompletedTaskAnchor').hasClass('active')){
                $('#CompletedTaskAnchor').removeClass('active');
            }
            if($('#myTaskAnchor').hasClass('active')){
                $('#myTaskAnchor').removeClass('active');
            }
            $('#searchDivMain').show('slow');
            $('#completedTaskDiv').hide();
            $('#myTaskDiv').hide();
        });
        $("#CompletedTaskLi").click(function(){
            $('#CompletedTaskAnchor').addClass('active');
            if($('#taskALLAnchor').hasClass('active')){
                $('#taskALLAnchor').removeClass('active');
            }
            if($('#myTaskAnchor').hasClass('active')){
                $('#myTaskAnchor').removeClass('active');
            }
            $('#searchDivMain').hide();
            $('#completedTaskDiv').show('slow');
            $('#myTaskDiv').hide();
        });
        $("#myTaskLi").click(function(){
            $('#myTaskAnchor').addClass('active');
            if($('#taskALLAnchor').hasClass('active')){
                $('#taskALLAnchor').removeClass('active');
            }
            if($('#CompletedTaskAnchor').hasClass('active')){
                $('#CompletedTaskAnchor').removeClass('active');
            }
            $('#searchDivMain').hide();
            $('#completedTaskDiv').hide();
            $('#myTaskDiv').show('slow');
        });
});
var searchTodo=function(str){
    var searchBy=$("#searchBy").attr('search-val');
    var todos=localStorage.getItem('todos');
    todos=JSON.parse(todos);
    todoList='';
    $(todos).each(function (key,val) {
        if(searchBy.trim()=="all"){
            if( val.task_name.toLowerCase().trim().includes(str.toLowerCase().trim())||
                val.created_by.toLowerCase().trim().includes(str.toLowerCase().trim())||val.task_assignee.toLowerCase().trim().includes(str.toLowerCase().trim())||val.user_assigned.toLowerCase().trim().includes(str.toLowerCase().trim())
            ){
                todoList+=getTodoList(val.task_name,val.created_by,val.task_assignee,val.user_assigned,val.time_line,val.task_description,val.task_id,val.task_assignee_id,val.task_user_id,val.task_status,val.task_completed_at);
            }
        }else if(searchBy.trim()=='assigned_to'){
            if(val.user_assigned.toLowerCase().trim().includes(str.toLowerCase().trim())){
                todoList+=getTodoList(val.task_name,val.created_by,val.task_assignee,val.user_assigned,val.time_line,val.task_description,val.task_id,val.task_assignee_id,val.task_user_id,val.task_status,val.task_completed_at);
            }
        }else if(searchBy.trim()=='assigned_by'){
            if(val.task_assignee.toLowerCase().trim().includes(str.toLowerCase().trim())){
                todoList+=getTodoList(val.task_name,val.created_by,val.task_assignee,val.user_assigned,val.time_line,val.task_description,val.task_id,val.task_assignee_id,val.task_user_id,val.task_status,val.task_completed_at);
            }
        }else if(searchBy.trim()=='creator'){
            if(val.created_by.toLowerCase().trim().includes(str.toLowerCase().trim())){
                todoList+=getTodoList(val.task_name,val.created_by,val.task_assignee,val.user_assigned,val.time_line,val.task_description,val.task_id,val.task_assignee_id,val.task_user_id,val.task_status,val.task_completed_at);
            }
        }else if(searchBy.trim()=='task_name'){
            if(val.task_name.toLowerCase().trim().includes(str.toLowerCase().trim())){
                todoList+=getTodoList(val.task_name,val.created_by,val.task_assignee,val.user_assigned,val.time_line,val.task_description,val.task_id,val.task_assignee_id,val.task_user_id,val.task_status,val.task_completed_at);
            }
        }
    });
    $("#searchDivMain").html(todoList);
}
function showTask(task_completed_at,task_name,task_time_line,task_id,user_id){
    $("#taskTitle").html(task_name);
    $("#taskTimeLine").html(task_time_line);
    $("#task_main_id").val(task_id);
    $("#taskCompleteTimeLine").val(task_completed_at);
    $("#saveTaskTimelineButton").attr('onclick',"saveFinalTask('"+task_id+"','"+user_id+"')");
    var data={
        task_id:task_id
    };
    var ajaxCall=callAjax('post',urlFetchSubTask,data);
        ajaxCall.done(function(res){
            res=JSON.parse(res);
            var sub_task_string='';
            $(res).each(function(key,val){
                sub_task_string+=getSubTaskList(val.sub_task_name,val.sub_task_time_line,val.sub_task_completed_date,val.id);
            });
            $("#sub_task_val").html(sub_task_string);
            $("#subtaskModal").modal('show');
        });
}
var getSubTaskList=function(sub_task_name,sub_task_time_line,sub_task_completed_date,id){
    var sub_task=`
    <br>
    <input type="hidden" name="id[]" value="`+id+`">
    <div class="row">
    <div class="col">
        Sub Task Name
    </div>
    <div class="col">
        <p>`+sub_task_name+`</p>
    </div>
    </div>
    <div class="row">
    <div class="col">
        Sub Task Time Line
    </div>
    <div class="col">
        <p>`+sub_task_time_line+`</p>
    </div>
    </div>
    <div class="row">
    <div class="col">
        Sub Task Completion Date
    </div>
    <div class="col">
        <input type="datetime-local" class="form-control" name="subTaskTimeLine[]" value='`+sub_task_completed_date+`'>
    </div>
    </div>
    <hr>
    `;
    return sub_task;
}
var saveFinalTask=function(){
    var id = $("input[name='id[]']").map(function(){return $(this).val();}).get();
    var subTaskTimeLines = $("input[name='subTaskTimeLine[]']").map(function(){return $(this).val();}).get();
    var chkArr=checkArray(subTaskTimeLines);
    if(!chkArr){
        displayMsg('error','Please Fill All The Details');
    }else{
        $('#saveTaskTimelineButton').html('Saving....');
        $('#saveTaskTimelineButton').prop('disabled',true);
        var data={
            ids:id,
            subTaskTimeLines:subTaskTimeLines
        };
        var ajaxCall=callAjax('post',urlSaveSubTaskTimeLine,data);
            ajaxCall.done(function(res){
                $("#finalTaskList").removeClass('disabled');
                $("#finalSubtaskAnchor").addClass('active');
                $("#subTaskListAnchor").removeClass('active');
                $("#final_task_content").show();
                $("#sub_task_val").hide();
                $("#saveTaskTimelineButton").html('Save Final Task');
                $('#saveTaskTimelineButton').prop('disabled',false);
                $("#saveTaskTimelineButton").attr('onclick',"saveTask()");
            });
    }
}
function saveTask(){
    var taskCompleteTimeLine=$("#taskCompleteTimeLine").val();
    var task_main_id=$("#task_main_id").val();
    var data={
        task_main_id:task_main_id,
        task_time_line:taskCompleteTimeLine
    };
    var ajaxCall=callAjax('post',urlSaveTaskTimeLine,data);
        ajaxCall.done(function(res){
            location.reload();
        });
}
var deleteTask=function(task_id){
    var conf=confirm('Deleting task will simply delete all the related subtak assigned to it are you sure you wan to continue !!!');
    if(conf){
        var data={
            task_id:task_id
        };
        var ajaxCall=callAjax('post',urlDeleteTask,data);
            ajaxCall.done(function(res){
                location.reload();
            });
    }

}
function assignTask(task_id,user_type){
    $("#task_id_assignee").val(task_id);
    $("#assigneeModal").modal('show');
}
function assign_user_collegue(){
    var task_id=$("#task_id_assignee").val();
    var task_assignee_id=$("#task_assignee_id").val();
    var assign_to_user=$("#assign_to_user").val();
    if(assign_to_user==''){
        displayMsg('error','Please Fill All the Details');
    }else{
        var data={
            task_id:task_id,
            task_assignee_id:task_assignee_id,
            assign_to_user:assign_to_user
        };
        var ajaxCall=callAjax('post',urlAssignTask,data);
            ajaxCall.done(function(res){
                location.reload();
            });
    }
}
