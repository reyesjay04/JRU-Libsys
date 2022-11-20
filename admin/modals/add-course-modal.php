<div class="modal fade" id="modal-add-course">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Course</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="POST" action="actions/?addcourse"  enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <select class="form-control" name="dept" id="dept">
                </select>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <input type="text" name="code" class="form-control" autocomplete="off" placeholder="Course Code" required>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <input type="text" name="course" class="form-control" autocomplete="off" placeholder="Course Name" required>
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