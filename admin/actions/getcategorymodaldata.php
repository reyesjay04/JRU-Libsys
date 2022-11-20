<?php


include_once '../../res/functions.php';

$result = GetCategoryDetails($_POST['id']);


?>
<input type="hidden" name="cat_id" class="form-control" autocomplete="off" value="<?php echo $result['cat_id']?>" required>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="text" name="cat_code" class="form-control" autocomplete="off" placeholder="Category Code" value="<?php echo $result['cat_code']?>" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="text" name="categoryname" class="form-control" autocomplete="off" placeholder="Category Name" value="<?php echo $result['cat_name']?>" required>
        </div>
    </div>
</div>