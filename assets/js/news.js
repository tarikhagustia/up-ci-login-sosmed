// JavaScript Document

/***********************************************
* Cross browser Marquee II- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var delayb4scroll1=3000 //Specify initial delay before marquee starts to scroll on page (1000=1 seconds)
var marqueespeed1=1 //Specify marquee scroll speed (larger is faster 1-10)
var pauseit1=1 //Pause marquee onMousever (0=no. 1=yes)?

////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed1=marqueespeed1
var pausespeed1=(pauseit1==0)? copyspeed1: 0
var actualheight1=''

function scrollmarquee1(){
if (parseInt(cross_marquee1.style.top)>(actualheight1*(-1)+8))
cross_marquee1.style.top=parseInt(cross_marquee1.style.top)-copyspeed1+"px"
else
cross_marquee1.style.top=parseInt(marqueeheight1)+8+"px"
}

function initializemarquee1(){
cross_marquee1=document.getElementById("vmarquee1")
cross_marquee1.style.top=0
marqueeheight1=document.getElementById("marqueecontainer1").offsetHeight
actualheight1=cross_marquee1.offsetHeight
if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
cross_marquee1.style.height=marqueeheight1+"px"
cross_marquee1.style.overflow="scroll"
return
}
setTimeout('lefttime=setInterval("scrollmarquee1()",30)', delayb4scroll1)
}

if (window.addEventListener)
window.addEventListener("load", initializemarquee1, false)
else if (window.attachEvent)
window.attachEvent("onload", initializemarquee1)
else if (document.getElementById)
window.onload=initializemarquee1