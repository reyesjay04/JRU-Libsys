<div class="modal fade" id="modal-add-category">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="POST" action="actions/?addcat"  enctype="multipart/form-data">
        <div class="modal-body" id="outletdetail">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="catcode" class="form-control" autocomplete="off" placeholder="Category Code" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="categoryname" class="form-control" autocomplete="off" placeholder="Category Name" required>
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