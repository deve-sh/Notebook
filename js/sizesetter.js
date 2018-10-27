function sizesetter()
{
	var menuheight=document.getElementById('menu').clientHeight;
	
	document.getElementById('noteset').style.marginTop=menuheight+"px";

}

window.addEventListener('load',sizesetter);
window.addEventListener('resize',sizesetter);