<html>
	<head>
		<title>YouTube Full Movies</title>
		<!--JS-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="js/script.js"></script>
		<!--Style-->
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<!--Google fonts-->
		<link href='http://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
	</head>
<?php
//Function to get Json content from reddit
function get_data($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

//Get data from reddit json
$raw = get_data('www.reddit.com/r/fullmoviesonyoutube/.json');
$json = json_decode($raw, true);

//Get parms from URL
$x = $_GET['page'];
$url = $_GET['v'];
$title = $_GET['t'];

//If no page number is set, assume 1
if($x == null || $x < 1)
	$x = 1;

//Get the title and YouTube ID
if($title == null){
	$title = $json["data"]["children"][$x]["data"]["title"];
}
if($url == null){
	$url_temp = $json["data"]["children"][$x]["data"]["url"];
	parse_str( parse_url( $url_temp, PHP_URL_QUERY ), $my_array_of_vars );
	$url = $my_array_of_vars['v']; 
} 

//Pagination
$a = $x - 1;
$b = $x + 1;
if($x != 1)
	$button[0] = '<a href="?page='.$a.'"><</a>';
else
	$button[0] = '<';
$button[1] = '<a href="?page='.$b.'">></a>';
?>
	<body>
		<div id="header">
			<a href="https://github.com/shahzeb1/full-youtube-movies"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png" alt="Fork me on GitHub"></a>
			<h1>YouTube Movies</h1>
			<h3>[<a href="#" onClick="listings();">Show all listings</a> | <a href="#" onClick="lights();">Hit the lights</a>]</h3>
			<h2><?=$title;?></h2>
		</div>
		<div id="on">[<a href="#" onClick="on();"?>Turn lights back on</a>]</div>
		<div id="listings">
			<ul>
			<?php
			// Loop through 25 JSON objects to show link
			$x = 0;
			while($x != 25){
				$t = $json["data"]["children"][$x]["data"]["title"];
				$url_t = $json["data"]["children"][$x]["data"]["url"];
			  	parse_str( parse_url( $url_t, PHP_URL_QUERY ), $my_array_of_vars );
			  	$v = $my_array_of_vars['v'];  
				echo '<li><a href="?v='.$v.'&t='.$t.'">'.$t.'</a></li>';
				$x++;
			}
			?>
			</ul>
		</div>
		<table>
			<tr>
				<td class="button"><?=$button[0];?></td>
				<td class="youtube">
					<iframe width="853" height="480" src="http://www.youtube.com/embed/<?=$url?>?autoplay=1" frameborder="0" allowfullscreen autoplay></iframe>
				</td>
				<td class="button"><?=$button[1];?></td>
			</tr>
		</table>
		<div id="footer">
			<?=date('Y');?> Made by <a href="https://github.com/shahzeb1" target="_blank">Shahzeb</a>. Powered by <a href="http://reddit.com/r/fullmoviesonyoutube" target="_blank">/r/fullmoviesonyoutube</a>
		</div>	
	</body>
</html>