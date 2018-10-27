function openusercard(){
	if(screen.width>600)
	{
	    document.getElementById("mySidenav").style.width = "250px";
	}
	else
	{
		document.getElementById("mySidenav").style.width = "100%";
	}
}

function closeusercard() {
    document.getElementById("mySidenav").style.width = "0";
}