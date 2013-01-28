// Turns off the lights, makes video iframe bigger
function lights(){
	$('#header').hide();
	$('#footer').hide();
	$('body').css('background', 'black');
	$('.button').css('background', 'black');
	$('iframe').css('margin-bottom', '50px');
	$('#on').show();
}

// Undoes the damage done by the lights()
function on(){
	$('#header').show();
	$('#footer').show();
	$('body').css('background', 'white');
	$('.button').css('background', 'E8E8E8');
	$('iframe').css('margin-bottom', '0px');
	$('#on').hide();
}

// Shows the IMDB div
function imdbShow(x){
	var id = x;
	$('.pcon'+id).fadeIn();
}

// Hides the IMDB div
function imdbHide(x){
	var id = x;
	$('.pcon'+id).fadeOut();
}

// Takes you to the watch URL
function watch(x){
	window.location = "watch.php?id="+x;
}