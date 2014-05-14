<?php
	$username = $_POST["username"];
	$password = $_POST["password"];
	$log = 0;
	$flag=mysql_connect("localhost","guest");
	if ($flag == false)
	{
		$log=-1;
	}
	else
	{
		$flag=mysql_select_db("logincheck");
		$query = "select * from users where (username = " . " \"$username\" );";
		$id = mysql_query($query);
		$res = mysql_fetch_array($id);
		if ($res == false)
		{
			$log = 0;
		}
		elseif ($password == $res[1])
		{
			$log = 1;
			$count = mysql_query("select viscount from users where (username = " . " \"$username\" )");
			$rescount = mysql_fetch_array($count);
			mysql_query("update users SET viscount=$rescount[0]+1 where (username = " . " \"$username\" )");
			setcookie("gs_rss", $username);
			setcookie("viscount", $rescount[0]+1);
		}
	}
?>

<html>
<head>
	<meta charset="utf-8"/>
	<title>welcome, <? echo $username ?> </title>
	<link href="home.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<div align="center">
		<?php
		global $log;
		if ($log == 1)
			{ ?>
		<div align="center">
			<p class="title"> Welcome to GreatStone's Page , <? echo $username ?></p>
			<div align="center">
				<a class="turn" href="logout.php">logout</a>
			</div>
			<div align="center" margin-top="30px">
				<a class="turn" href="home.php">home</a>
			</div>
		</div>
		<?php }
		elseif ($log == 0)
			{ ?>
		<div>
			<p class="title">Fail to login</p>
			<div align="center">
				<a class="turn" href="home.php">home</a>
			</div>
			<div align="center">
				<a class="turn" href="register.php">register</a>
			</div>
		</div>
		<?php }
		else{ ?>
		<div class = "title">
			Fail to access
			<div align="center">
				<a class="turn" href="home.php">home</a>
			</div>
		</div>
		<?php }?>
	</div>
	<div class="feet">
      <p>
       by GreatStone 2014.04.09 12281054@bjtu.edu.cn
     </p>
   </div>
</body>