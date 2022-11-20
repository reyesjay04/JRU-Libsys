<?php


include_once '../../res/functions.php';

$result = GetDepartmentDetails($_POST['id']);


?>
<input type="hidden" name="dept_id" class="form-control" autocomplete="off" value="<?php echo $result['id']?>" required>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="text" name="deptcode" class="form-control" autocomplete="off" placeholder="Department Code" value="<?php echo $result['code']?>" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="text" name="deptname" class="form-control" autocomplete="off" placeholder="Department Name" value="<?php echo $result['name']?>" required>
        </div>
    </div>
</div>