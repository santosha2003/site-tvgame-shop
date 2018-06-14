Array.prototype.isArray=true;
Function.prototype.isFunction=true;

var GNM_MenuPrefix="GNM";
var GNM_MenuSeparator="_";
var GNM_MenuHideDelay=500;
var GNM_MenuVisible=[];
var GNM_MenuHidden=[];
var GNM_TimerID=null;
var GNM_ChildOffsetX=1;
var GNM_ChildOffsetY=0;
var GNM_MenuWidth=200; //need for Opera 5

var GNM_TopOffsetX=0;

var GNM_UA=navigator.userAgent;
var GNM_BW_DOM=(document.getElementById) ? true : false;
var GNM_BW_NS4=(document.layers) ? true : false;
var GNM_BW_IE=(document.all) ? true : false;
var GNM_BW_IE4=GNM_BW_IE && !GNM_BW_DOM;
var GNM_BW_Mac=(navigator.appVersion.indexOf("Mac") != -1);
var GNM_BW_IE4M=GNM_BW_IE4 && GNM_BW_Mac;
var GNM_BW_Opera=(window.opera) ? true : false;
var GNM_BW_Opera5=(GNM_UA.indexOf('Opera 5')!=-1) ? true : false;
var GNM_LastOver=null;


Array.prototype.insert=function(item)
{
	this[this.length]=item;
}

Array.prototype.remove=function(arg) //remove items from array
{
	var returnArray=[];
	var found;
	if(arg.isArray==true)
	{
		for(var j=0; j<this.length; j++)
		{
			for(var i=0; i<arg.length; i++)
			{
				found=false;
				if(this[j]==arg[i])
				{
					found=true;
					break;
				}
			}
			
			if(!found) returnArray.insert(this[j]);
		}
	}
	else
	{
		for(var j=0; j<this.length; j++)
		{
			if(this[j]!=arg)
			{
				returnArray.insert(this[j]);
			}
		}
	}
	
	return returnArray;
}

Array.prototype.in_array=function(val)
{
	for(var i=0; i<this.length; i++)
	{
		//alert(this[i] + " == "+val);
		if(String(this[i])==String(val)) return true;
	}
	return false;
}

Array.prototype.unique=function(argArray) //returns unique element from current and arg's array
{
	//flip current array
	var tmpArray=[];
	var returnArray=[];
	for(var i=0; i<this.length; i++)
	{
		returnArray.insert(this[i]);
	}
	
	//insert arg's array
	for(var i=0; i<argArray.length; i++)
	{
		if(!returnArray.in_array(argArray[i])) returnArray.insert(argArray[i]);
	}
	return returnArray;
}

Array.prototype.make_copy=function()
{
	var newArray=[];
	for(var i=0; i<this.length; i++)
	{
		newArray.insert(this[i]);
	}
	return newArray;
}

function GNM_fnExtractIndex(strElementID)
{
	var numPrefixLength=GNM_MenuPrefix.length;
	if(strElementID.substr(0,numPrefixLength) != GNM_MenuPrefix)
	{
		return -1;
	}
	
	return strElementID.substr(numPrefixLength);
}

function GNM_fnPushInVisible(strElementID)
{
	var strMenu=GNM_fnExtractIndex(strElementID);
	if(strMenu==-1) return;
	var arMenuLevels=strMenu.split(GNM_MenuSeparator);
	var arRealIDs=[];
	var numIterations=arMenuLevels.length;
	for(var i=0; i<numIterations; i++)
	{
		arRealIDs.insert(arMenuLevels.join(GNM_MenuSeparator));
		arMenuLevels.pop();
	}
	
	GNM_MenuVisible=arRealIDs;
}

function GNM_fnPushInHidden(strElementID)
{
	var strMenu=GNM_fnExtractIndex(strElementID);
	if(strMenu==-1) return;
	var arMenuLevels=strMenu.split(GNM_MenuSeparator);
	var arRealIDs=[];
	var numIterations=arMenuLevels.length;
	for(var i=0; i<numIterations; i++)
	{
		arRealIDs.insert(arMenuLevels.join(GNM_MenuSeparator));
		arMenuLevels.pop();
	}
	GNM_MenuHidden=GNM_MenuHidden.unique(arRealIDs);
}

function GNM_fnMakeVisible()
{
	var strElementID="";
	var objRef;
	for(var i=0; i<GNM_MenuVisible.length; i++)
	{
		strElementID=GNM_MenuPrefix+GNM_MenuVisible[i];
		if(objRef=document.getElementById(strElementID))
			objRef.style.visibility="visible";
	}
}

function GNM_fnMakeHidden(boolSkip)
{
	var strElementID="";
	var objRef;
	if(!GNM_MenuHidden.length) return;
	for(var i=0; i<GNM_MenuHidden.length; i++)
	{
		strElementID=GNM_MenuPrefix+GNM_MenuHidden[i];
		if(objRef=document.getElementById(strElementID))
			objRef.style.visibility="hidden";
	}
	GNM_MenuHidden=[];
}

function GNM_fnShowMenu(strElementID,objCaller)
{
	var objTmp, newX, newY;
	if(GNM_BW_IE)
	{
		window.event.cancelBubble=true;
	}
	
	clearTimeout(GNM_TimerID);
	GNM_fnPushInVisible(strElementID);
	GNM_MenuHidden=GNM_MenuHidden.remove(GNM_MenuVisible);
	//recalc menu position
	if(objTmp=document.getElementById(strElementID))
	{
		if(objCaller!=null && objTmp.style.visibility!="visible")
		{
			var wndDims=GNM_fnGetWindowDims();
			
			if(typeof(objCaller)=="object")
			{
				var pos=GNM_fnFindElementLoc(objCaller);
				
				newX=pos[0]+GNM_ChildOffsetX+((GNM_BW_Opera5) ? GNM_MenuWidth : objCaller.offsetWidth);
				newY=pos[1]+GNM_ChildOffsetY;
					
				if((objTmp.offsetWidth+newX)>wndDims[0]) newX=pos[0]-objTmp.offsetWidth-GNM_ChildOffsetX;
				if((objTmp.offsetHeight+newY)>wndDims[1]) newY=Math.max(0,wndDims[1]-objTmp.offsetHeight);
					
				objTmp.style.top=newY+"px";
				objTmp.style.left=newX+"px";

			}
			else
			{
				objCaller=document.getElementById(objCaller);
				var pos=GNM_fnFindElementLoc(objCaller);
				newX=pos[0]+GNM_TopOffsetX;
				if(objTmp.offsetWidth+newX>wndDims[0]) newX=wndDims[0]-objTmp.offsetWidth-GNM_TopOffsetX-2;
				objTmp.style.left=newX+"px";
			}
		}
	}
	
	GNM_fnMakeHidden();
	GNM_fnMakeVisible();
}


function GNM_fnHideMenu(strElementID)
{
	GNM_fnPushInHidden(strElementID);
	GNM_MenuHidden=GNM_MenuHidden.unique(GNM_MenuVisible);
	GNM_MenuVisible=GNM_MenuVisible.remove(GNM_MenuHidden);
	GNM_TimerID=setTimeout("GNM_fnMakeHidden()",GNM_MenuHideDelay);
}

function GNM_fnFindElementLoc(objRef)
{
	var x=0, y=0;
	
	obj=objRef;
	
	while(obj.offsetParent != null)
	{
		x+=obj.offsetLeft;
		y+=obj.offsetTop;
		obj=obj.offsetParent;
	}
	x+=obj.offsetLeft;
	y+=obj.offsetTop;
	
	return [x,y];
}

function GNM_fnDebug(str)
{
	if(str=='') return;
	var obj;
	if(obj=document.getElementById('debug'))
		obj.innerHTML+=str+"<br />";
}

function GNM_fnGetWindowDims()
{
	if(GNM_BW_IE)
	{
		return [document.body.clientWidth,document.body.clientHeight]
	}
	else
	{
		return [window.innerWidth,window.innerHeight];
	}
}

//short-hand functions
var GNMOV=GNM_fnShowMenu;
var GNMOU=GNM_fnHideMenu;