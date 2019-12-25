<!-- Modal -->
<div class="modal modal-danger fade" id="assigneeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="myModalLabel">Assign Collegue</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form class='myform' action="" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                <label>Assign Collegue</label>
                <input type='hidden' id="task_id_assignee">
                <input type='hidden' id="task_assignee_id" value='{{Session::get('id')}}'>
                <select class="form-control" id="assign_to_user">
                <option value=''>Select Collegue</option>
                    @foreach($collegues_details as $collegues_detail)
                    <option value="{{$collegues_detail->id}}">{{ucfirst($collegues_detail->name)}}</option>
                    @endforeach
                </select>
                </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
              <button type="button" class="btn btn-warning" onclick="assign_user_collegue()">Assign Collegue</button>
            </div>
        </form>
      </div>
    </div>
  </div>
