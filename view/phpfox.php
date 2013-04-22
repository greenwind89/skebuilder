<?php
$skeleton_collection = new SkeletonCollection(SKEBUILDER_SKELETON_DIR);
$skeleton_list = $skeleton_collection->getSkeletonList();
?>

<head>

<script src='./static/jquery-1.9.1.js'></script>
<script src='./static/jquery.validate.js'></script>

<script type="text/javascript">
    $().ready(function() {
        $('#skebuilder_phpfox_form').validate();
    });
</script>

</head>

<body>
    <title>Phpfox Skeleton Builder</title>
    <h1>Phpfox Skeleton Builder</h1>
    <form method='POST' action='#' id='skebuilder_phpfox_form' style='margin-left: 150px; margin-top: 100px'>
        <input type='hidden' name='package_type' value='phpfox' />

        <label>Module name * (For ex: fundraising, contest, advancedphoto)</label>
        <br>
    	<input type="text" name="module_name" id='module_name' class='required'>

        <br>
        <br>
        <label>Package Id * (For ex: younet_fundraising, younet_advancedphoto, younet_contest) </label>
        <br>
        <input type="text" name="package_id" id='package_id' class='required'>

        <br>
        <br>
        <label>Author * (For ex: MinhTA, VuDP) </label>
        <br>
        <input type="text" name="author_name" id='author_name' class='required'>

        <br>
        <br>
        <label>Basic Item Name* (For ex: Campaign, Contest, Entry, Blog) <br>
            I put it here because some module may have item name different from module name</label>
        <br>
        <input type="text" name="item_name" id='item_name' class='required'>

        <br>
        <br>
        <label>Skeleton template *  <br>
            (Template will be used to generate skeleton, temporarily you need to manual upload skeleton file in to /lib/skeleton/phpfox foler)</label>
         <br>
        <select  name ='skeleton_name' id='skeleton_name'>
            <?php foreach($skeleton_list as $value) { ?>
                <option value="<?php echo($value);?>"> <?php echo($value);?> </option>
            <?php } ?>
        </select>

        <br>
        <br>
        <br>
    	<input type="submit" name ='generate' value='generate'>

        <input type="submit" name ='print' value='print'>
    </form>

</body>

