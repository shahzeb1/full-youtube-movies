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
//Require MYSQL
require('mysql.php');
//this could use some work
$show = $_GET['show'];
if($show != 'top'){
	$d = '';
}else{
	$d = 'ORDER BY id DESC';
}
?>
	<body>
		<div id="header">
			<a href="https://github.com/shahzeb1/full-youtube-movies"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png" alt="Fork me on GitHub"></a>
			<h1>YouTube Movies</h1>
			<h3>[<a href="?show=top">Show top</a> | <a href="?show=new">Show Newest</a>]</h3>
		</div>
		<div id="on">[<a href="#" onClick="on();"?>Turn lights back on</a>]</div>
		
		<table id="listingTable">
			<tr>
		<?php
				$q = mysql_query("SELECT * FROM imdb WHERE reported = '0' ".$d." LIMIT 24");
				$x = 0;
				while($r = mysql_fetch_array($q)){
				$num = mysql_num_rows($q);
				//Director / Rating / Poster / Title
				if(!$r['director'])
					$director = 'Unknown';
				else
					$director = $r['director'];
				if(!$r['rating'])
					$rating = '?';
				else
					$rating = $r['rating'];
				if(!$r['poster'] || $r['poster'] == 'http://img3.douban.com/pics/movie-default-small.gif')
					$poster = 'http://placehold.it/297x400/FF6600/FFFFFF&text='.$r['title'];
				else
					$poster = $r['poster'];
					$title = $title = $r['title'];
				
				//Get YouTube ID
			  	parse_str( parse_url( $url_t, PHP_URL_QUERY ), $my_array_of_vars );
			  	$v = $my_array_of_vars['v'];  


			  	$normal = '<td>
			  	<div style="background-image:url(\''.$poster.'\')" id="posterimg" onMouseOver="imdbShow('.$x.')" onMouseOut="imdbHide('.$x.')" onClick="watch('.$r['id'].')">
			  		<div id="posterContent" class="pcon'.$x.'">
			  			<div class="title"> '.$title.' </div>
			  			<div class="rating">'.$rating.' / 10</div>
			  			<div class="director">By '.$director.'</div>
			  		</div>
			  	</div>
			  	</td>';

			  	//Loop through rows of 3
				if($x == 0 || ($x % 3) == 0){
					echo '</tr>';
					echo '<tr>';
					echo $normal;
				}else{
					echo $normal;
				}
				$x++;
				}
			?>
		</table>

		<div id="footer">
			<?=date('Y');?> Made by <a href="https://github.com/shahzeb1" target="_blank">Shahzeb</a>. Powered by <a href="http://reddit.com/r/fullmoviesonyoutube" target="_blank">/r/fullmoviesonyoutube</a>
		</div>	
	</body>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20444682-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>