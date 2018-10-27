var deletefunction=function(noteid,userid)
{
    var deleterequest=new XMLHttpRequest();

    deleterequest.open('GET','delete.php?noteid='+noteid+'&userid='+userid);	

    deleterequest.onload=function()
    {
    	console.log('');
    }

    deleterequest.send();

    location.reload(true);
}