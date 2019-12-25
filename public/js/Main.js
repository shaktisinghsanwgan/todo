function displayMsg(msg,data){
    clearMsg();
    if(msg=='error'){
        return  toastr["error"](data)
                    toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "500",
                    "hideDuration": "500",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
              }
    }else if(msg=='success'){
            return  toastr["success"](data)
                    toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "500",
                    "hideDuration": "500",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
              }
    }else if(msg=='info'){
            return  toastr["info"](data)
                    toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "1000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
              }
    }
}
// for Clearing Data
function clearData(){
    for (i = 0; i < arguments.length; i++) {
       $("#"+arguments[i]).val('');
  }
}
// for comparing Dates
function checkDates(fromdate,toDate){
     // converting from date dd/mm/yyyy to mm/dd/yyyy
     var fromDate_ar=fromdate.split("/");
     var fromDate=fromDate_ar[1]+"/"+fromDate_ar[0]+"/"+fromDate_ar[2];
     fromDate=new Date(fromDate);
     // converting to date dd/mm/yyyy to mm/dd/yyyy
     var toDate_ar=toDate.split("/");
     var toDate=toDate_ar[1]+"/"+toDate_ar[0]+"/"+toDate_ar[2];
     toDate=new Date(toDate);

     // now checking the condition
     if(toDate<fromDate){
         return false;
     }else{
         return true;
     }
}
// for showing elements
function showElements(){
    for (i = 0; i < arguments.length; i++) {
       $("#"+arguments[i]).show('slow');
  }
}
// for hiding elements
function hideElements(){
    for (i = 0; i < arguments.length; i++) {
       $("#"+arguments[i]).hide('slow');
  }
}
// for ajax calling
function callAjax(method,url,data){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    data._token=CSRF_TOKEN;
    var mainData='';
    var hasError='no';
    var request = $.ajax({
                      url: url,
                      method:method,
                      data:data,
                      dataType: "html"
                    });
    return request;
}
function clearMsg(){
    if($(".toast-info").length != 0) {
        $(".toast-info").remove();
    }
    if($(".toast-success").length != 0) {
        $(".toast-success").remove();
    }
    if($(".toast-error").length != 0) {
        $(".toast-error").remove();
    }
  }
function getTodoList(task_name,created_by,task_assignee,user_assigned,time_line,task_description,task_id,task_assignee_id,task_user_id,task_status,task_completed_at){
    var user_id=$("#log_user_id").val();
    var user_type=$("#log_user_type").val();
    var searchDiv=`
            <div class="card">
            <div class="card-body">
            <h5 class="card-title">`+task_name+`</h5>
            <hr>
            <h6 class="card-subtitle mb-2 text-muted">
                <div class="row">
                    <div class="col-12 col-md-7">
                            <strong>Created By:</strong>
                            `+created_by+`
                    </div>
                    <div class="col-6 col-md-5">
                        <strong>Assigned By:</strong>`;
            if(task_assignee==''){
                searchDiv+=`<em>This task Is not assigned to anyone yet !!!</em>`;
            }
            else{
                searchDiv+=task_assignee;
            }
            searchDiv+=`
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <strong>Assigned To:</strong>`;
                if(user_assigned==''||user_assigned=='0'){
                    searchDiv+=`<em>This task has yet to be assigned to collegue !!!</em>`;
                }else{
                    searchDiv+=user_assigned;
                }
                searchDiv+=`
                    </div>
                    <div class="col-6 col-md-5">
                        <strong>TimeLine:</strong>
                        `+time_line+`
                    </div>
                </div>
                <div class="row">
                <div class="col-12 col-md-7">
                <strong>Task Status:</strong>`;
                if(task_status=='incomplete'){
                    searchDiv+=`
                    <span style="color:red;">
                    `+task_status+`
                    </span>`;
                }else{
                    searchDiv+=`
                        <span style="color:green;">
                        `+task_status+`
                            </span>`;
                }
                searchDiv+=`
                </div>`;
                if(task_completed_at!=''){
                    searchDiv+=`<div class="col-6 col-md-5">
                                                    <strong>Completed At:</strong>
                                                    `+task_completed_at+`
                                                </div>`;
                }
                searchDiv+=`
              </div>
            </h6>
            <p class="card-text">
                `+task_description+`
            </p>

            <a href="/todo/view/`+task_id+`" class="card-link">View Task</a>`;
            if(user_type.trim()=='admin'){
                searchDiv+=`<a href="/todo/edit/`+task_id+`" class="card-link">Edit Task</a>
                <a href="javascript:void(0);" onclick='deleteTask("`+task_id+`")' class="card-link">Delete Task</a>`;
            }
            if(user_assigned==''){
                if(user_type.trim()=='admin'||(user_type.trim()=='assignee' && user_id==task_assignee_id)){
                    searchDiv+=`<a href="javascript:void(0);" onclick="assignTask('`+task_id+`','`+user_type+`')" class="card-link">Assign Task</a>`;
                }
            }
            if(user_type.trim()=='colleagues' && user_id.trim()==task_user_id && task_completed_at==''){
                searchDiv+=`<a href="javascript:void(0);" onclick="completeTask('`+task_id+`','`+user_type+`')" class="card-link">Complete Task</a>`;
            }
            if(user_id=='no'){
                searchDiv+=`
                <a href="/login" class="card-link">Assign Task</a>
                <a href="/login" class="card-link">Complete Task</a>
                `;
            }
        searchDiv+=`
            </div>
        </div>
        <br>
    `;
    return searchDiv;
}
function checkArray(my_arr){
    for(var i=0;i<my_arr.length;i++){
        if(my_arr[i] === "")
           return false;
    }
    return true;
 }
