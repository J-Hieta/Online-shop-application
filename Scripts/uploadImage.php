<?php
    if(!isset($_SESSION)) {
        session_start();
    } 
    // Since php.ini normally only allows to upload 20 files, make personal folder for each user
    include_once 'sanitization.php';                                                // Can't even trust images in this world...
    include_once 'getUserInfo.php';                                                 // For creating personal directory
    include_once '../Scripts/connection.php';
    
    $parent_dir     = dirname(getcwd(), 1);                                         // Returns parent directory where this script is.
    $images_dir     = "/Resources/UserImages/";                                     // Path to where images get stored
    $personal_dir   = $parent_dir.$images_dir.$user_id;
    
    // If personal directory doesn't exists..
    if (!file_exists($personal_dir)) {
        mkdir($personal_dir);
    }
    
    $file_types      = ['jpeg', 'jpg', 'png'];                                      // Acceptable file types
    $safe_file       = test_input(basename($_FILES["profilePicture"]["name"]));     // Sanitizate the file name
    $target_file     = $personal_dir.'/'.$safe_file;                                // Path where the file will be uploaded
    $image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));       // Uploaded file's type
    $image_size      = $_FILES["profilePicture"]["size"];
    $image_temp_name = $_FILES['profilePicture']['tmp_name'];
    $db_path         = '..'.$images_dir.$user_id.'/'.$safe_file;                    // ../Resources/rest/path/to/image.jpg
    $upload_ok       = 1;
    
    if(isset($_POST["submit"])) {
        
        // Allow image file formats
        if (!in_array($image_file_type, $file_types)) {
            echo "Sorry, only JPG, JPEG & PNG files are allowed.";
            $upload_ok = 0;
        }

//         // If file exists, remove it
//         if (file_exists($target_file)) {
//             unlink($target_file);
//         }
        
        // Check file size
        if ($image_size > 500000) {
            echo "Sorry, your file is too large.";
            $upload_ok = 0;
        }
        
        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        }
        else {
            // Empty folder, restricting personal pictures to 1, and add new picture
            // Get a list of all of the file names in the folder.
            $files = glob($personal_dir.'/*');
            
            // Loop through the file list.
            foreach($files as $file){
                // Make sure that this is a file and not a directory.
                if(is_file($file)){
                    // Delete file
                    unlink($file);
                }
            }
            
            if (move_uploaded_file($image_temp_name, $target_file)) {
                echo "The file ". basename( $_FILES["profilePicture"]["name"]). " has been uploaded.";
                
                // Update db user image path
                $insert_image = $conn->prepare("UPDATE users SET user_image_path = :path WHERE email = '".$_SESSION['email']."'");
                $insert_image->bindParam(':path', $db_path);
                $insert_image->execute();
                // Redirect user back to profile page
                header('Location: ../Layouts/profile.php');
            } 
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>