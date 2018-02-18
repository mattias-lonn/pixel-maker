<?php
$html = $_POST['html'];

$rows = explode('id="r',$html);
$c = 0;
foreach ($rows as $row) {
	$c++;
	$rowid = 0 + $row;
	
	if ($c != 1) {
	$tds = explode('id="t',$row);
	
		foreach ($tds as $td) {
			$tdid = 0 + $td;
					$width = $tdid * 20;
			$height = $rowid * 20;	
			$color = explode('style="background-color: rgb(',$td);
			$color = explode(');',$color[1]);
			if ($color[0]) {
				$image['"'.$rowid.'-'.$tdid.'"'] = 'w='.$width.'h='.$height.'c='.$color[0];
			} else {
				$image['"'.$rowid.'-'.$tdid.'"'] = 'w='.$width.'h='.$height.'';
					
			}
		}
	}
}

$h = 1 + $rowid;
$h = $h * 20;
$w = 1 + $tdid;
$w = $w * 20;

if ($rowid >= 50 || $tdid >= 50) 
	die("Maximum width/height is 50 beads");

$im = imagecreatetruecolor($w, $h);

imagealphablending($im, true);

$white = 0x00ffffff;


$icon1 = imagecreatefrompng('/var/www/developerhelp.org/htdocs/udacity/projects/pixellabdone.png');
$icon2 = imagecreatefrompng('/var/www/developerhelp.org/htdocs/udacity/projects/pixellabwhite.png');
imagefill($im, 0, 0);

foreach ($image as $img) {
	$w = explode("w=",$img);
	$h = explode("h=",$img);
	$c = explode("c=",$img);
	$colors = explode(",",$c[1]);
	$red = imagecolorallocate($im, $colors[0], $colors[1], $colors[2]);
	if ($c[1]) { 
		$isimg = true;
	imagefill($im, $w[1], $h[1], $red);
	imagecopy($im, $icon1, $w[1], $h[1], 0, 0, 20, 20);
	} else
	imagecopy($im, $icon2, $w[1], $h[1], 0, 0, 20, 20);	
}


if ($isimg) {
$name = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);

imagepng($im,"/var/www/developerhelp.org/htdocs/img/uploads/bead_".$name.".png");
imagedestroy($im);

die("<br><strong>Your Image File: http://developerhelp.org/img/uploads/bead_".$name.".png</strong>");
} else die('<br><strong>You can do better than that! :)</strong>');
?>