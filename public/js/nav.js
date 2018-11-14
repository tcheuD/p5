var pathArray = window.location.pathname.split('/');
var secondLevelLocation = pathArray[2];
$('#' + secondLevelLocation).addClass("current");