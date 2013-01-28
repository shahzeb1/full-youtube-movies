<?php
//Require MYSQL settings
require('mysql.php');
//Function to get Json content from reddit
function get_data($url) {
  $ch = curl_init();
  $timeout = 2000000;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
//Get data from reddit json
$raw = get_data('http://www.reddit.com/r/fullmoviesonyoutube/.json');
$json = json_decode($raw, true);
$x = 0;

//Funcetion to get director/rating/poster from IMDB API
function getIMDB($type, $movie){
				$raw = get_data('http://imdbapi.org/?title='.$movie.'&type=json&plot=simple');
				$json = json_decode($raw, true);
				$rating = $json[0]['rating'];
				$poster = $json[0]['poster'];
				$director = $json[0]['directors'][0];
				$title = $json[0]['title'];
				$plot = $json[0]['plot_simple'];
				if($type == 'director')
					return $director;
				if($type == 'rating')
					return $rating;
				if($type == 'poster')
					return $poster;
				if($type == 'title')
					return $title;
				if($type == 'plot')
					return $plot;
}

//Insert items into MYSQL DB
echo '<ul>';
while($x != 25){
				$movie = $json["data"]["children"][$x]["data"]["title"];
				$url_t = $json["data"]["children"][$x]["data"]["url"];
			  	parse_str( parse_url( $url_t, PHP_URL_QUERY ), $my_array_of_vars );
			  	$v = $my_array_of_vars['v']; 
				$hash = md5($movie);
				$q = mysql_query("SELECT * FROM `imdb` WHERE `hash` = '".$hash."'");
				$count = mysql_num_rows($q);
				if($count == 0 && $v != '' && $title != ''){
					$director = getIMDB('director', $movie);
					$rating = getIMDB('rating', $movie);
					$poster = getIMDB('poster', $movie);
					$tim = addslashes(getIMDB('title', $movie));
					$plot = htmlspecialchars(getIMDB('plot', $movie), ENT_QUOTES);

					// MYSQL if added
					mysql_query("INSERT INTO `imdb`(hash, title, director, video, rating, poster, plot)
						VALUES ('".$hash."', '".$tim."', '".$director."', '".$v."', '".$rating."', '".$poster."', '".$plot."')")
					or die(mysql_error());

					echo '<li><b>Added '.$movie.'</b></li>';
				}else{
					echo '<li>'.$movie.' was already there</li>';
				}
				$x++;
			}

echo '</ul>';

?>