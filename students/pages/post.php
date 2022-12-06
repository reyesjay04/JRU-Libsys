<?php include '../templates/user-header.php'?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?php include '../templates/user-nav.php'?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="#">Post</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Post Details</h3>
              </div>
              <form id="quickForm" method="post" enctype="multipart/form-data" >
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="dept">Department</label>
                        <select class="form-control" name="dept" id="dept">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <select class="form-control" id="course" name="course" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="authors">Authors</label>
                        <select class="form-control" style="width: 100%" id="authors" name="authors">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter Content"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileupload" name="fileupload">
                            <label class="custom-file-label" for="fileupload">Choose file</label>
                        </div>
                    </div>
                    <label for="inlineRadioOptions">Availability</label>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="availability" id="inlineRadio1" value="PUB" checked>
                            <label class="form-check-label" for="inlineRadio1">Public</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="availability" id="inlineRadio2" value="PRIV">
                            <label class="form-check-label" for="inlineRadio2">Private</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="availability" id="inlineRadio3" value="BOTH">
                            <label class="form-check-label" for="inlineRadio3">Both Public and Private</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keywords">Keywords</label>
                        <textarea class="form-control" id="keywords" name="keywords" rows="2" placeholder="Enter Keywords"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
    </div>
  </footer>
</div>
<?php include '../templates/user-footer.php'?>
<script>
$( document ).ready(function() {
    bsCustomFileInput.init();
    LoadDepartments();
    authors();
    $("#dept").change(function() {
        var dept_code = $("#dept").val();
        LoadCourse(dept_code)
    });
});

function LoadDepartments() {
    $.ajax({
      url: 'actions/?getdept',
      dataType: 'json',
      success:function(response){     
        $("#dept").empty();
        $("#dept").append("<option value=''>Select Department</option>")
        var len = response.length;
        for( var i = 0; i<len; i++){
            var code = response[i]['Code'];
            var name = response[i]['Name']; 
            $("#dept").append("<option value='"+code+"'>"+name+"</option>");           
        }
      }
    });
}
function LoadCourse(dept_code) {
    $.ajax({
      url: 'actions/?getcourse',
      dataType: 'json',
      method:"POST",
      data: {dept_code:dept_code},
      success:function(response){     
        $("#course").empty();
        $("#course").append("<option value=''>All</option>")
        var len = response.length;
        for( var i = 0; i<len; i++){
            var code = response[i]['Code'];
            var name = response[i]['Name']; 
            $("#course").append("<option value='"+code+"'>"+name+"</option>");           
        }
      }
    });
}

function authors() {
  $("#authors").select2({
      multiple: true,
      minimumInputLength: 2,
      placeholder: "Select Authors",
      ajax: {
          url: "actions/?searchauthors",
          type: "post",
          dataType: 'json',
          delay: 250,
          
          data: function (params) {
              return {
                  searchTerm: params.term,
              };
          },
          processResults: function (response) {
              return {
                  results: response
              };
          },
          cache: true
      }
  });
}

$(function () {
  $('#quickForm').validate({
    rules: {
      title: {
        required: true,
      },
      dept: {
        required: true,
      },
      content: {
        required: true,
      },
      customFile: {
        required: true,
      },
      authors: {
        required: true
      },
      availability: {
        required: true
      },
      keywords: {
        required: true
      },   
      fileupload: {
        required: true
      },
      
    },

    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },

    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },

    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
  });
  $('#quickForm').submit(function (e) {
    e.preventDefault();

    if(!$(this).valid()) {
      return false;
    }
    var formData = new FormData(this); 
    formData.append('tags', JSON.stringify($("#authors").select2('data')))
    $.ajax({
        type: 'POST',
        url: 'actions/?addpost',
        contentType: false,
        cache: false,
        processData:false,
        data: formData,
        success: function (response) {
          alert("Success");
          location.reload();

        },
    });
  });
});
</script>
</body>
</html>
