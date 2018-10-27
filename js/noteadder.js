var addnote=function(userid,title,content)
{
	var noteadd=new XMLHttpRequest();

	title=title.toString();

	content=content.toString();

	content=encodeURIComponent(content);

	noteadd.open('GET','addnote.php?userid='+userid+'&content='+content+'&title='+title);

	noteadd.onload=function()
	{
		console.log();
	}

	noteadd.send();

	location.reload(true);
}