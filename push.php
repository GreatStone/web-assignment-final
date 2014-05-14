<?php
	$username = $_POST["username"];
	$password = $_POST["password"];
	$reg = 0;
	$flag=mysql_connect("localhost","guest");
	if ($flag == false)
	{
		$reg=-1;
	}
	else
	{
		$flag=mysql_select_db("logincheck");
		$query = "select * from users where (username = " . " \"$username\" )";
		if (!mysql_fetch_array((mysql_query($query))))
		{
			mysql_query("insert into users values (\"$username\",\"$password\",0)");
			$reg = 1;
		}
		else
		{
			$reg = 0;
		}
	}
?>

<html>
<head>
	<meta charset="utf-8"/>
	<title> register <? echo $tmp ?> </title>
	<link href="home.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<?php
	if ($reg == -1)
		{ ?>
	<div class="title"> Fail to access</div>
	<?php }
	elseif ($reg == 0) { ?>
		<div class="title"> Fail to register, this username is existed. </div>
	<?php }
	else { ?>
		<div class="title"> Welcome, <? echo $username ?> ,now return to home page. </div>
		<meta http-equiv="refresh" content="2;url=home.php"> 
	<?php
		}
	?>
</body>