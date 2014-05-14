<?php
	$username = $_COOKIE["gs_rss"];
	$rss = $_POST["urlrss"];
	$flag = mysql_connect("localhost","guest");
	$exist = false;
	$suc = false;
	if ($flag)
	{
		$flag = mysql_select_db("userrss");
		if ($flag)
		{
			$query = "select username from rss where (rss=\"$rss\")";
			$res = mysql_query($query);
			$names = mysql_fetch_array($res);
			foreach ($names as $e)
			{
				if ($e == $username)
				{
					$exist = true;
					break;
				}
			}
		}
		if (!$exist)
		{
			$page = simplexml_load_file($rss);
			$label = $page->channel->title;
			$query = "insert into rss values (\"$username\",\"$rss\",\"$label\")";
			$suc = mysql_query($query);
		}
	}
?>
<html>
<head>
	<meta charset="utf-8"/>
	<link href="home.css" type="text/css" rel="stylesheet"/>
	<?php
	if ($exist)
	{ ?>
		<title>Error</title>
	<?php }
	else { ?>
		<title>Add RSS for <? echo $username ?> </title>
	<?php } ?>
</head>
<body>
	<div class = "title">
	<?php 
	if (!$flag){?>
		An error occured when try to access database.
	<?php }elseif ($exist) {?>
		This RSS have exist in your list(<? echo $rss ?>).
	<?php } elseif (!$suc) {?>
		Fail to add RSS to your list.
	<?php } else{ ?>
		Success to add RSS to your list.
		<br/>
		<p class="subtitle">
			Turn to home page after 5 seconds
		</p>
		<meta http-equiv="refresh" content="5;url=home.php">
	<?php } ?>
	</div>
</body>
</html>