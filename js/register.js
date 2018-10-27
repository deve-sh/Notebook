function checker(str)
{
	if(str.includes('@'))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function check(str)
{
	if(checker(str))
	{
		document.getElementById('email').style.border='1px solid green';
	}
	else
	{
		document.getElementById('email').style.border='1px solid red';	
	}
}