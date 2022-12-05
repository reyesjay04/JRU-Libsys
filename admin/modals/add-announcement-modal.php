<div class="modal fade" id="modal-add-annoucement">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Announcement</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="POST" action="actions/?addannouncement"  enctype="multipart/form-data">
        <div class="modal-body" id="annoucement">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" autocomplete="off" placeholder="Title" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea type="text" name="desc" class="form-control" autocomplete="off" placeholder="Description" required></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="attachment" name="attachment" required>
                  <label class="custom-file-label" for="attachment">Choose Attachment</label>
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