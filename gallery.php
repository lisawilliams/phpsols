<?php include('./includes/title.inc.php'); ?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Japan Journey<?php echo "&#8212;{$title}"; ?></title>
<link href="styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('./includes/menu.inc.php'); ?>
    <div id="maincontent">
        <h2>Images of Japan</h2>
      <p id="picCount">Displaying 1 to 6 of 8</p>
        <div id="gallery">
            <table id="thumbs">
                <tr>
					<!--This row needs to be repeated-->
                    <td><a href="gallery.php"><img src="images/thumbs/basin.jpg" alt="" width="80" height="54"></a></td>
                </tr>
				<!-- Navigation link needs to go here -->
            </table>
            <div id="main_image">
                <p><img src="images/basin.jpg" alt="" width="350" height="237"></p>
                <p>Water basin at Ryoanji temple, Kyoto</p>
                
                <?php 
$badge  = 'http://www.flickr.com/badge_code_v2.gne?count=1&display=random&size=m&layout=x&source=user&user=57551232@N00';
$width  = 400;
$height = 240;


/**
 *  if you want the Class to try to guess the best source size 
 *  (should work for all near-standard uses) you don't have to add
 *  anything at all. Should you need to force the script to
 *  auto-detect, the following line will do:
*/
$size = "auto";

/**
 *  if you want to manually define the size to use add the following
 *  line and use one of these size-constants:
 *  "xxs" (75x75), "xs" (100x?), "s" (240x?), 
 *  "m" (500x?), "l" (1024x?), "xl" (original)
*/
$size = "m";

include("flickpic.php"); 
?>
            </div>
        </div>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>