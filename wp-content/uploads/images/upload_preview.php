  <?php
	if(count($_POST)>0)
	{
	$target_path = "images/".$_GET['folder']."/";

	$target_path = $target_path.$_GET['item_id'].'.jpg';
				
	$table = $types_tables[$_GET['folder']];
	
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
	echo '<h3>Here is a preview of the uploaded file </h3><img src="'.$target_path.'" />';
	}
	else
	{
	?>
	<form enctype="multipart/form-data" method="POST" id="preview_frm">
<input type="file" name="uploadedfile" onchange="alert('oops');document.getElementById('preview_frm').submit()" />
				
				<input type="hidden" id="item_id" name="item_id" value="100000" />
				
				<input type="hidden" id="item_name" name="item_name"  />
				
				<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
						
	</form>
	<?php
	}
	?>			