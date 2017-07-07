	<?php 
		if(isset($_GET['id'])){

			$id = $_GET['id'];
		}else{
			$id = $_POST['id'];
		}
       
	?>

<!DOCTYPE html>
<html>
<head>
	<link href="gridcss/bootstrap.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-latest.js"></script>

	<title> Edit Grid Number <?php echo $id?> </title>
	
</head>
<script type="text/javascript">
	function updateInfo(id){
		var file = document.getElementById("file");

		$.ajax({
            type: "POST",
            url: "functions.php",
            data: {action:"updateGrid",id:id},
            success: function(results){
               location.href = "admin.php";
            } 
            
        });
	}

	function updateImg(){
		var file = document.getElementById("uploaded_file");
		var id = document.getElementById("id");
		var link = document.getElementById("link");
			$.ajax({
            type: "POST",
            url: "functions.php",
            data: {action:"updateImage",id:id,link:link,file:file},
            success: function(results){
               location.href = "admin.php";
            } 
            
        });
	}

</script>
<body>
<?php echo '<form action="updateImg.php?pid='.$id.'" method="post" enctype="multipart/form-data">' ?>
   <div class="container centered">
	<h2 class="heading">Edit Masonry Grid <?php echo $id?></h2>

			 <label class="flabel">Change Link: </label> <input type ="text" id="link" name ="link" class="form-control" required autofocus/><br>		 
			 <label class="flabel">Change Image:&nbsp;&nbsp;&nbsp; </label><input type ="file" id="uploaded_file" name ="uploaded_file"  required autofocus/><br>		
			 <input type = "text" id = "pid" value = <?php echo $id?> hidden  />	 
			 <input type="submit" class="btn btn-lg btn-primary" value="Update"/>		
	</div>
</form>

<div class="test"></div>
</body>
</html>