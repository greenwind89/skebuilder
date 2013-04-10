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
<form method='POST' action='build.php' onsubmit='submitCheck();'>

	<input type="text" name="module_name" id='module_name'>
	<input type="submit" value='generate'>
</form>
