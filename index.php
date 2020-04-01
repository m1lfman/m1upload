<?php

require('includes/config.php');

if(isset($_POST['image'])){

	$bytes = random_bytes(8);
	$convert = bin2hex($bytes);

	foreach ($_FILES['fileUpload']['name'] as $key => $data) {


		$fileName = $_FILES['fileUpload']['name'][$key];
		$fileDir = $_FILES['fileUpload']['tmp_name'][$key];
		$fileSize = $_FILES['fileUpload']['size'][$key];

		if(empty($fileName)){
		 $error2[] = "Izaberi sliku!";
		}
		else
		{

		 $imgExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension

		 // valid image extensions
		 $valid_extensions = array('png', 'jpg', 'jpeg'); // valid extensions

		 $image = rand(1000,1000000).".". $imgExt;

		 // allow valid image file formats
		 if(in_array($imgExt, $valid_extensions)){
			// Check file size '5MB'
			if($fileSize < 5000000)    {
			 move_uploaded_file($fileDir,$define['uploadFolder'].$image);
			}
			else{
			 $error2[] = "Slika je previse velika! Max 5MB";
			}
		 }
		 else{
			$error2[] = "Dozvoljeni formati su PNG, JPG i JPEG!";
		 }
		}
		if(!isset($error2)){
			$user->insertImage($image, $convert);
		}
	}

}



//include header template
include($define['header']);
?>
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">Upload</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Contact</a>
      </nav>
    </div>
  </header>

<?php
if(isset($error2)){
	foreach ($error2 as $err) {
		echo '<div class="alert alert-danger" role="alert">
		  '. $err .'
		</div>';
	}
} ?>

  <main role="main" class="inner cover">
    <div class="form-horizontal">
  		<div class="form-group">
  			<form method="POST" enctype="multipart/form-data">
  			<div class="col-md-10">
  				<div class="row">
  					<div id="coba">
            </div>
  				</div>
  			</div>
  		</div>
  		<div class="form-group">
  			<div class="col-md-8">
  				<div></div>
  				<button type="submit" name="image" class="btn btn-primary btn-lg btn-block">Dodaj</button>
  			</div>
  		</div>
  		</form>
  	</div>
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p style="color:black">Created with <i class="fas fa-heart" style="color: red"></i> ! by <kbd>m1lfman</kbd></p>
    </div>
  </footer>
</div>

<script type="text/javascript">
	$(function(){

		$("#coba").spartanMultiImagePicker({
			fieldName:        'fileUpload[]',
			maxCount:         20,
			rowHeight:        '200px',
			groupClassName:   'col-md-3 col-sm-3 col-xs-6',
			allowedExt:       'png|jpg|jpeg',
			maxFileSize:      '',
			placeholderImage: {
					image: 'placeholder.png',
								width : '100%'
			},
			dropFileLabel : "Drop Here",
			onAddRow:       function(index){
				console.log(index);
				console.log('add new row');
			},
			onRenderedPreview : function(index){
				console.log(index);
				console.log('preview rendered');
			},
			onRemoveRow : function(index){
				console.log(index);
			},
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
	});
</script>


<?php
//include header template
include($define['footer']);
?>
