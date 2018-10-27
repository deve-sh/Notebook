function titlechange(noteid,userid,title)
{
	var titlerequest=new XMLHttpRequest();

	title=title.toString();

	title=escape(title);

	titlerequest.open('GET',"titlechange.php?noteid="+noteid+"&userid="+userid+"&title="+title+"");

	titlerequest.onload=function()
	{
		console.log('');
	}

	titlerequest.send();
}