<?php

	function uploadFile ($theFile, $type, $ID) {
		global $fileUploadErrorMessage;
		$fileUploadErrorMessage = "";
		   
		$target_dir = "photos/";
		date_default_timezone_set('America/New_York');
		$dayte = date("Y-m-d-h-i-sa"); // get a unique timestamp to save with the image

		$target_file = $target_dir . $type . "_" . $ID . "_" . basename($theFile["name"]);
		$anyExistingFiles = $target_dir . $personType . "_" . $ID . "*";
		
		$target_file = str_replace(' ', '', $target_file); // remove any spaces in the fiel name

		
		$uploadOk = 1;
		
		$check = getimagesize($theFile["tmp_name"]);
		if($check !== false) {
			// echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$fileUploadErrorMessage .= "File is not an image. ";
			$uploadOk = 0;
		}
		
		if (file_exists($target_file)) {
			$fileUploadErrorMessage .=  "Sorry, file already exists. ";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 1000000) {
			$fileUploadErrorMessage .=  "Sorry, your file is too large. ";
			$uploadOk = 0;
		}
		
		// Allow certain file formats
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$imageFileType = strtolower($imageFileType); // needed to check against the file type in case stored in uppercase
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$fileUploadErrorMessage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$fileUploadErrorMessage .= "Sorry, your file was not uploaded. ";
			return false;
		} else { // if everything is ok, try to upload file


				foreach(glob($anyExistingFiles) as $f) {
					unlink($f); // remove any files for this user
				}
				if (move_uploaded_file($theFile["tmp_name"], $target_file)) {
					return $target_file;
				} else {
					$fileUploadErrorMessage .= "Unknown error saving image file";
					return false; 
				}
		}
		
	} // end uploadFile function


	function timeAgo($time_ago)
    {
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "just now";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "one minute ago";
            }
            else{
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an hour ago";
            }else{
                return "$hours hrs ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "yesterday";
            }else{
                return "$days days ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "a week ago";
            }else{
                return "$weeks weeks ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a month ago";
            }else{
                return "$months months ago";
            }
        }
        //Years
        else{
            if($years==1){
                return "one year ago";
            }else{
                return "$years years ago";
            }
        }
    }

?>