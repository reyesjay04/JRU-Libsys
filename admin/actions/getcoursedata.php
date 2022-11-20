<?php


include_once '../../res/functions.php';

$result = GetCourseDetails($_POST['id']);


?>
<input type="hidden" name="id" class="form-control" autocomplete="off" value="<?php echo $result['id']?>" required>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="text" name="code" class="form-control" autocomplete="off" placeholder="Course Code" value="<?php echo $result['code']?>" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="text" name="course" class="form-control" autocomplete="off" placeholder="Course Name" value="<?php echo $result['course']?>" required>
        </div>
    </div>
</div>