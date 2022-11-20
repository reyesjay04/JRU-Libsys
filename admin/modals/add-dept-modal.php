<div class="modal fade" id="modal-add-department">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="POST" action="actions/?adddept"  enctype="multipart/form-data">
        <div class="modal-body" id="departmentdetails">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="deptcode" class="form-control" autocomplete="off" placeholder="Department Code" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="deptname" class="form-control" autocomplete="off" placeholder="Department Name" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>