function postchange(noteid,userid,string)
{
	var postrequest=new XMLHttpRequest();

	string=string.toString();

	string=escape(string);

	postrequest.open('GET',"postchange.php?noteid="+noteid+"&userid="+userid+"&string="+string+"");

	postrequest.onload=function()
	{
		console.log('');
	}

	postrequest.send();
}