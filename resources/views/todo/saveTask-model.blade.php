<!-- Modal -->
<div class="modal modal-danger fade" id="subtaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="myModalLabel">Complete Todo Timeline</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form id="subtaskForm" class='myform' action="" method="post">
            <div class="modal-body">
                <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item" id="subTaskList">
                          <a class="nav-link active" href="javascript:void(0);" id="subTaskListAnchor">Sub Task List</a>
                        </li>
                        <li class=  "nav-item disabled" id="finalTaskList">
                          <a class="nav-link " id="finalSubtaskAnchor" href="javascript:void(0)">Final Task</a>
                        </li>
                      </ul>
                <div id="sub_task_val">
                </div>
                <div id="final_task_content" style="display:none;">
                    <input type="hidden" id="task_main_id">
                    <div class="row">
                        <div class="col">
                            Task Name
                        </div>
                        <div class="col">
                            <p id="taskTitle"></p>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            Sub Task Time Line
                        </div>
                        <div class="col">
                            <p id="taskTimeLine"></p>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            Sub Task Completion Date
                        </div>
                        <div class="col">
                            <input type="datetime-local" class="form-control" id="taskCompleteTimeLine">
                        </div>
                        </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" id="saveTaskTimelineButton" onclick="saveSubTask()">Save and Complete Task</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
