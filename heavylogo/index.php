<?php 
/* 
list all the files with extension nn on a folder 
the first parameter of glob is a regex to match files.
you can do: 
    path_to_dir/*.html
to select all the .html files in the path_to_dir folder
*NOTE:* the regex on glob is case sensitive
*/

$images = glob("{*.jpg,*.jpeg,*.png,*.gif,*.JPG,*.JPEG,*.PNG,*.GIF,*.mov,*.mp4}", GLOB_BRACE);

/** 
* Converts bytes into human readable file size. 
* 
* @param string $bytes 
* @return string human readable file size (2,87 Мб)
* @author Mogilev Arseny 
*/ 
function fileSizeConvert($bytes){
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1),
        );
    foreach($arBytes as $arItem){
        if($bytes >= $arItem["VALUE"]){
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
?><!doctype html>
<html lang="en">

<style>
body 
{
background-position:top;
background-repeat:no-repeat;
background-color:#000712;
text-align:center;
color:#fbc72a;
font-family:arial;
font-size:150%;
}

a:link {
  color: #fbc72a;
}

/* visited link */
a:visited {
  color: blue;
}

/* mouse over link */
a:hover {
  color: red;
}

/* selected link */
a:active {
  color: blue;
}

</style>

<head>
	<!--<meta charset="utf-8"> -->
	<title> File list </title>
</head>
<body style="font-family: monospace, sans-serif;">
<a class="box" href="http://obs.xlnc.tv/">Home</a>
<ul>
	<?php foreach ($images as $img): ?>
	<li><?php echo filemtime($img).' &ndash; <a href="'.$img.'"target="_blank">'.$img."</a> &ndash; ". fileSizeConvert(filesize($img)) ."<br>\n"; ?></li>
	<?php endforeach ?>
</ul>

</body>
</html>