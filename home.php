<html>
<head>
	<meta charset = "utf-8"/>
	<link href="home.css" type="text/css" rel="stylesheet"/>
	<title>GreatStone's RSS Page</title>
</head>
<body>
	<div align = "right" width="100%" class="label">
		<a align= "right" width="100%" class="label" href="about.html"> About Me </a>
	</div>
	<div align="center">
		<?php
		if (!$_COOKIE["gs_rss"]){ ?>
		<div class="title">
			Welcome to GreatStone's RSS site!
		</div>
		<form action="login.php" method="post">
			<div class="info">
				<p class="label"> username </p>
				<input  type="text" name="username"/>
			</div>
			<div class="info">
				<p class="label"> password </p>
				<input type="password" name="password"/>
			</div>
		</div>
		<div align="center">
			<input class="button" type="submit" value="login" width="60px">
		</form>
	</div>
	<div class="line">
	</div>
	<div align="center">
		<a class="turn" href="register.php">register</a>
	</div>
	<?php }
	else{
		?>
		<div class="title">
			Welcome to have a fun reading time, <? echo $_COOKIE["gs_rss"] ?>
		</div>
		<?php
			$username = $_COOKIE["gs_rss"];
			$flag = mysql_connect("localhost","guest");
			if ($flag)
			{
				$flag = mysql_select_db("userrss");
				if ($flag)
				{
					$query = "select rss from rss where(username = \"$username\")";
					$res = mysql_query($query);
					$rsss = mysql_fetch_array($res);
					$query = "select label from rss where (username =\"$username\")";
					$res = mysql_query($query);
					$labels = mysql_fetch_array($res);
					$len = sizeof($rsss);
					for ($i = 0; $i < $len-1; $i++)
					{
					 	print "<form action=\"catch.php\" method=\"post\">\n";
					 	print "<div> <input type=\"hidden\" value = \"$rsss[$i]\" name= \"urlrss\" /> <div>\n";
						print "<div class=\"contents\">\n";
						print "$i.  <input class=\"button\" type=\"submit\" value=\"$labels[$i]\"/>\n";
						print "</div>";
						print "</form>\n";
					}
				}
			}
			if (!$flag)
			{
				print "<div class=\"title\">\n";
				print "An error occured when connet to database";
				print "</div>\n";
			}
		?>
		<div height="10%"> <br/> <br/> <br/> <br/></div>
		<form action="rssadd.php" method="post">
			<div class="info">
				<p class="label">RSS</p>
				<input type="text" name="urlrss"/>
			</div>
			<div class="info">
				<input class="button" type="submit" value="Add" width= "60px">
			</div>
		</form>
		<a class="turn" href="logout.php"> logout </a>
	<?php } ?>
	<div class="feet">
		by GreatStone	12281054@bjtu.edu.cn
	</div>
	</body>
</html>