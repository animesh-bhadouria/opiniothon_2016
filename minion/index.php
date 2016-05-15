<html>
<head>
	<title>Minion Application</title>

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>


<body>

	<div class = "header">
		<div class = 'container'>
			<h1><center> Minion Application </center></h1>
		</div>
	</div>

	<center>
	<div class='row'>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="comment">SEND THE JSON REQUEST HERE:</label>
				<textarea class="form-control" rows="20" column="40" id="request"></textarea>
			</div>
			<button type="button" class="btn btn-default">Send Request</button>



		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="comment">VIEW THE JSON RESPONSE HERE:</label>
				<textarea class="form-control" rows="30" column="40" id="response" ></textarea>
			</div>
		</div>

	</div>
	</center>
</body>
</html>




<?php

// follow("./minion.log");



// function follow($file)
// {
//     $size = 0;
//     while (true) 
//     {
//         clearstatcache();
//         $currentSize = filesize($file);
//         if ($size == $currentSize) {
//             usleep(1000);
//             continue;
//         }

//         $fh = fopen($file, "r");
//         fseek($fh, $size);

//         while ($d = fgets($fh)) {
            

//             echo '<script type="text/javascript">

// 					$(document).ready(function() {
// 						("#response").innerHTML(".print_r($d).");
// 					});
// 					</script>';


//         }

//         fclose($fh);
//         $size = $currentSize;
//     }
// }


?>
