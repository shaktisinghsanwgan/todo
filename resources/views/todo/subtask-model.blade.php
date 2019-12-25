<!-- Modal -->
<div class="modal modal-danger fade" id="subtaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form id="subtaskForm" class='myform' action="" method="post">
            <div class="modal-body">
                <div class="form-group row">
                    <input type="hidden" id="subtask_id" value="no">
                    <label for="task_name" class="col-md-4 col-form-label text-md-right">Sub Task Name</label>
                    <div class="col-md-6">
                        <input id="sub_task_name" name="sub_task_name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sub_task_description" class="col-md-4 col-form-label text-md-right">Sub Task Description</label>
                    <div class="col-md-6">
                        <textarea id="sub_task_description" name="sub_task_description" class="form-control sub_task_description"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="timeline" class="col-md-4 col-form-label text-md-right">Enter Deadline</label>
                    <div class="col-md-6">
                        <input type="datetime-local" class="form-control datetimepicker" name="subtask_timeline" id="subtask_timeline">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
              <button type="button" id="subTaskButton" onclick="saveSubtask('save')" class="btn btn-warning">Yes, Save Sub Task</button>
            </div>
        </form>
      </div>
    </div>
  </div>
