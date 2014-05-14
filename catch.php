<?php
	$rssadd = $_POST["urlrss"];
	$page = simplexml_load_file ($rssadd);
	$load = true;
	if ($page == false)
	{
		$load = false;
	}
	$title = $page->channel->title;
	$item = $page->channel->item;
	?>

<html>
<head>
	<meta charset = "utf-8"/>
	<link href="home.css" type="text/css" rel="stylesheet"/>
	<?php
	if ($load==false)
		{ ?>
	<title>Error</title> <?php }
	else {?>
	<title> <? echo $title ?> </title>
	<?php }?>
</head>
<body>
<?php
	if (!$load)
		{?>
	<div class="title">
		An error occured when extract from feed
	</div>
	<?php	}
	else ?>
	<div>
		<? echo $page ?>
	</div>
	<div class="title">
		<? echo $title?>
	</div>
	<div class="contents">
		<?php
		$i = 1;
		foreach ($item as $e)
		{
			print "<div> <a class=\"label\" href=\"$e->link\">";
			print "$i. ".$e->title;
			print "</a> </div>\n";
			$i++;
		}?>
	</div>

	<div class="feet">
		by GreatStone	12281054@bjtu.edu.cn
	</div>
</body>
</html>
