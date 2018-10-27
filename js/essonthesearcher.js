function searchfunc(userid,str)
{
	str=encodeURIComponent(str);
	window.open('search.php?userid='+userid+'&'+'squery='+str,'_blank');
}

function diffsearch(userid,str)
{
	str=encodeURIComponent(str);
	self.location = 'search.php?userid='+userid+'&'+'squery='+str;
}