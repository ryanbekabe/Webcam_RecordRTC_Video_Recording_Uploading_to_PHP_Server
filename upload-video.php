<?php
 
if(isset($_FILES["video"])){
    // Define a name for the file
    $fileName = "myvideo.webm";

    // In this case the current directory of the PHP script
    $uploadDirectory = './'. $fileName;
    
    // Move the file to your server
    if (!move_uploaded_file($_FILES["video"]["tmp_name"], $uploadDirectory)) {
        echo("Couldn't upload video !");
    }
}else{
    echo "No file uploaded";
}
 
?>