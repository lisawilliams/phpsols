<!DOCTYPE HTML><!DOCTYPE HTML>
<html>
<head>
<style type="text/css" media="screen">
		@import url('../styles/newsfeed.css')
		</style>

<meta charset="utf-8">
<title>The Black Leather Belt</title>
</head>

	<body>
	<h1>The Black Leather Belt</h1>
	
	<?php	
			$url = 'http://theblackleatherbelt.com/feed/';
			$feed = simplexml_load_file($url, 'SimpleXMLIterator');
			$filtered = new LimitIterator($feed->channel->item, 0 , 9);
			
		foreach ($filtered as $item) { ?>
		<H2><a href ="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h2>
		<p class ="datetime"><?php $date= new DateTime($item->pubDate);
		$date->setTimezone(new DateTimeZone('America/New_York'));
		$offset = $date->getOffset();
		$timezone = ($offset == -14400) ? ' EDT' : ' EST';
		echo $date->format('M m, Y, g:ia'); ?></p>
		<p><?php echo $item->description; ?></p>
		<?php } ?>
			
			}
	?>
	
	</body>
	</html>