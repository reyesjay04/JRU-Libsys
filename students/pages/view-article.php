<?php include '../templates/user-header.php'?>
<?php 

if($_GET['avl'] == "PRIV") {
  if(CheckUserAccess($_GET['viewarticle']) == 0) {
    header("Location: ?dashboard");
  }
}

?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?php include '../templates/user-nav.php'?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> View Article</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="#">View Article</a></li>
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
                <h3 class="card-title">Article Details</h3>
              </div>
                <div class="tab-content">
                  <div class="active tab-pane" id="articles">            
                    
                  </div>
                </div>       
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
  GetArticle();
  $( "#target" ).select();
  $("#star5").click(function(){
    alert(1);
  });

  $(document).on('keypress',function(e) {
    if(e.which == 13) {
      var userComment = $( "#entercomment" ).val();
      if(userComment.length > 0) {
        $.ajax({
          url:"actions/?postcomment",
          method:"POST",
          data:{art_id:<?php echo $_GET['viewarticle']?>, comment:$("#entercomment").val()},
          success:function(data){
             $("#entercomment").val('');
             $("#comments").empty();
             $("#comments").append(data);
             GetCommentCount();
          }
        });      
      }
    }
  });
});

function GetCommentCount() {
  $.ajax({
    url:"actions/?countcomments",
    method:"POST",
    data:{art_id:<?php echo $_GET['viewarticle']?>},
    success:function(data){
        $("#commentscount").text(data);
    }
  });  
}

function GetArticle() {
  $.ajax({
      url:"actions/?viewarticles",
      method:"POST",
      data:{art_id:<?php echo $_GET['viewarticle']?>},
      success:function(data){
        $("#articles").empty();
        $("#articles").append(data);
      }
  });
}


function downloadFile(id) {
  window.open("actions/?dlfile="+id, '_blank');
}

function LikeArticle() {      

    var isLike = "Yes";
    if($("#btnlike").hasClass("btn btn-default btn-sm")) {
      if($("#btndislike").hasClass("btn btn-primary btn-sm")) {
        $("#btndislike").removeClass("btn btn-primary btn-sm").addClass("btn btn-default btn-sm");  
      }
      $("#btnlike").removeClass("btn btn-default btn-sm").addClass("btn btn-primary btn-sm");  
    } else {
      isLike = "No";
      $("#btnlike").removeClass("btn btn-primary btn-sm").addClass("btn btn-default btn-sm");  
    } 

    $.ajax({
      url:"actions/?likearticle",
      method:"POST",
      dataType: 'json',
      data:{art_id:<?php echo $_GET['viewarticle']?>, action:isLike},
      success:function(response){
        
        $("#likescount").text(response[0]['likes']);
        $("#dislikescount").text(response[0]['dislikes']);
  
      }
    });             
}

function DislikeArticle() {
  var isDislike = "Yes";
    if($("#btndislike").hasClass("btn btn-default btn-sm")) {
        if($("#btnlike").hasClass("btn btn-primary btn-sm")) {
           $("#btnlike").removeClass("btn btn-primary btn-sm").addClass("btn btn-default btn-sm");  
        }
        $("#btndislike").removeClass("btn btn-default btn-sm").addClass("btn btn-primary btn-sm");  
    } else {
      isDislike =  "No";
      $("#btndislike").removeClass("btn btn-primary btn-sm").addClass("btn btn-default btn-sm");  
    }          
    
    $.ajax({
      url:"actions/?dislikearticle",
      method:"POST",
      dataType: 'json',
      data:{art_id:<?php echo $_GET['viewarticle']?>, action:isDislike},
      success:function(response){
      
        $("#likescount").text(response[0]['likes']);
        $("#dislikescount").text(response[0]['dislikes']);

      }
    });  
}

function rate(id) {
  $.ajax({
      url:"actions/?ratearticle",
      method:"POST",
      data:{art_id:<?php echo $_GET['viewarticle']?>, id:id},
      success:function(response){    
        $("#ratingsratio").text(response);    
      }
  }); 
}
</script>
</body>
</html>
