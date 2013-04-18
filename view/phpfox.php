<?php
$skeleton_collection = new SkeletonCollection(SKEBUILDER_SKELETON_DIR);
$skeleton_list = $skeleton_collection->getSkeletonList();
?>
<script type="text/javascript">
    function submitCheck() {
        var p = document.getElementById('module_name').value;
            if (p == '') {
                alert("Invalid module name");
                return false;
            }
        return true;
    }
</script>

<script type="text/javascipt" src='jquery.validate.min.js'></script>
<form method='POST' action='#' onsubmit='submitCheck();'>
    <input type='hidden' name='package_type' value='phpfox'/>

    <label>module name *</label>
    <br>
	<input type="text" name="module_name" id='module_name'>

    <br>
    <label>Package Id *</label>
    <br>
    <input type="text" name="package_id" id='package_id'>

    <br>
    <label>Author *</label>
    <br>
    <input type="text" name="author_name" id='author_name'>

    <br>
    <label>Basic Item Name*</label>
    <br>
    <input type="text" name="item_name" id='item_name'>

    <br>
    <label>Skeleton template *</label>
     <br>
    <select  name ='skeleton_name' id='skeleton_name'>
        <?php foreach($skeleton_list as $value) { ?>
            <option value="<?php echo($value);?>"> <?php echo($value);?> </option>
        <?php } ?>
    </select>

    <br>
    <br>
    <br>
	<input type="submit" value='generate'>
</form>
