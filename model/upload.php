<?php
class Upload{
    static function uploadImage($con)
    {
        $targetDir = "upload-img/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $_SESSION['file']= $_FILES["file"]["name"];
        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
            //allow certain file formats
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($fileType, $allowTypes)){
                //upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    $statusMsg = "The file ".$fileName. " has been uploaded.";
//                    $_SESSION['imgURL'] = $targetFilePath;


                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                    $con->set('errors["imgUpload"]', $statusMsg);
                }
            }else{
                $statusMsg = 'Sorry, only JPG, JPEG, PNG files are allowed to upload.';
                $con->set('errors["imgUpload"]', $statusMsg);
            }
        }else{
            //Picture not required so if no file, we will not set an error
            $targetFilePath = "none";
        }
        return $targetFilePath;
    }
}