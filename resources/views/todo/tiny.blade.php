<script src="{{asset('ckeditor/ckeditor.js')}}" referrerpolicy="origin"></script>
  <script>
    var urlsaveTask='{{route('todo.save')}}';
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

    var saveTodo=function(str){
        var task_name=$("#task_name").val();
        var task_assignee=$("#assignee").val();
        var collegue_id=$("#collegue_id").val();
        var time_line=$("#timeline").val();
        var task_description=CKEDITOR.instances.task-description.getData();;
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
                    task_name:task_name,
                    task_description:task_description,
                    task_assignee:task_assignee,
                    collegue_id:collegue_id,
                    time_line:time_line

                };
                var ajaxCall=callAjax('post',urlsaveTask,data);
                ajaxCall.done(function(res){
                    displayMsg('success',"Status Updated Successfully :)");
                    if(str=="save"){
                        $('#saveTodoMain').prop('disabled',false);
                        $('#saveTodoMain').html('Save Todo');
                        location.reload();
                    }else{
                        $('#saveAndEditTodo').prop('disabled',false);
                        $('#saveAndEditTodo').html('Submit and Add Sub Task');
                        $('#taskMainLi').removeClass('active');
                        $('#SubtaskLi').removeClass('disabled');
                        $('#SubtaskLi').addClass('active');
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
        CKEDITOR.replace('task-description');
        $("#taskMainLi").click(function(){
            $('#taskMainLi').addClass('active');
            $('#SubtaskLi').removeClass('active');
            $('#taskMainDiv').show('slow');
            $('#subTaskDiv').hide();
        });
        $("#SubtaskLi").click(function(){
            if(!$('#SubtaskLi').hasClass('disabled')){
                $('#taskMainLi').removeClass('active');
                $('#SubtaskLi').removeClass('disabled');
                $('#SubtaskLi').addClass('active');
                $('#taskMainDiv').hide();
                $('#subTaskDiv').show('slow');
            }
        });
    });
    </script>
