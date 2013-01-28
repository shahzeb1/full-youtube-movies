// Show/hide the #listing div
function listings(){
	$('#listings').toggle('slow');
}

// Turns off the lights, makes video iframe bigger
function lights(){
	$('#header').hide();
	$('#footer').hide();
	$('body').css('background', 'black');
	$('.button').css('background', 'black');
	$('iframe').css('width', '1280');
	$('iframe').css('height', '720');
	$('iframe').css('margin-bottom', '50px');
	$('#on').show();
}

// Undoes the damage done by the lights()
function on(){
	$('#header').show();
	$('#footer').show();
	$('body').css('background', 'white');
	$('.button').css('background', 'E8E8E8');
	$('iframe').css('width', '853');
	$('iframe').css('height', '480');
	$('iframe').css('margin-bottom', '0px');
	$('#on').hide();
}