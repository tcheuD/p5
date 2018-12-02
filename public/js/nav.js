var pathArray = window.location.pathname.split('/');
var secondLevelLocation = pathArray[1];
$('#' + secondLevelLocation).addClass("current");