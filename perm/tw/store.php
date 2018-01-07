<?php
/*
 * store.php - upload a file in this directory
 * version : 1.1 - 23/12/2005 - BidiX
 * 
 * see : http://tiddlywiki.bidi.info/#UploadPlugin for usage
 * see : http://www.php.net/manual/en/features.file-upload.php for d	tails on uploading files
 * usage : POST UploadPlugin[backupDir=<backupdir>] userfile <file>
 *
 * Revision history
 * v 1.0 - 12/12/2005 : POST userfile <file>
 * v 1.1 - 23/12/2005 : POST UploadPlugin[backupDir=<backupdir>] userfile <file>
 *
 * Copyright (c) BidiX@BidiX.info 2005
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
 <title>BidiX.info - TiddlyWiki UploadPlugin - Store script</title>
 </head>
 <body>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p align="center">This page is designed to upload a <a href="http://www.tiddlywiki.com/">TiddlyWiki<a>.</p>
 <p align="center">for details see : <a href="http://www.bidix.info/TiddlyWiki/BidiXTW.html#HowToUpload">www.bidix.info/TiddlyWiki/BidiXTW.html#HowToUpload<a>.</p> 
 </body>
</html>
<?php
}
else {
 $uploaddir = './';
 $backuperror = false;
 $optionStr = $_POST['UploadPlugin'];
 $optionArr=explode(';',$optionStr);
 $options = array();
 $backupFilename = '';
 foreach($optionArr as $o) {
 list($key, $value) = split('=', $o);
 $options[$key] = $value;
 }
 if (file_exists($uploaddir . $_FILES['userfile']['name']) && ($options['backupDir'] != '')) {
 if (! file_exists($options['backupDir'])) {
 mkdir($options['backupDir']) or ($backuperror = "mkdir error");
 }
 $filename = $_FILES['userfile']['name'];
 $backupFilename = $options['backupDir'].'/'.substr($filename, 0, strpos($filename, '.')).date('.Ymd.His').substr($filename,strpos($filename,'.'));
 copy($filename,$backupFilename) or ($backuperror = "rename error");
 }
 if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $_FILES['userfile']['name'])) {
 if (!$backuperror) {
 echo "0 - File successfully loaded in " .$uploaddir . $_FILES['userfile']['name']. "\n";
 if ($backupFilename)
 echo "backupFile=$backupFilename;\n";
 } else {
 echo "BackupError : $backuperror - File successfully loaded in " .$uploaddir . $_FILES['userfile']['name']. "\n";
 }
 } 
 else {
 echo "Error : " . $_FILES['error']." - File NOT uploaded !\n";
 }
 echo 'Here is some more debugging info : ';
 echo "<pre>";
 print ("\$_FILES : \n");
 print_r($_FILES);
 print ("\$options : \n");
 print_r($options);
 echo "</pre>";
}

?>
