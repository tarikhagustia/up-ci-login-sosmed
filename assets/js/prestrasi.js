// JavaScript Document

/***********************************************
* Cross browser Marquee II- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var delayb4scroll3=3000 //Specify initial delay before marquee starts to scroll on page (1000=1 seconds)
var marqueespeed3=1 //Specify marquee scroll speed (larger is faster 1-10)
var pauseit3=1 //Pause marquee onMousever (0=no. 1=yes)?

////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed3=marqueespeed3
var pausespeed3=(pauseit3==0)? copyspeed3: 0
var actualheight3=''

function scrollmarquee3(){
if (parseInt(cross_marquee3.style.top)>(actualheight3*(-1)+8))
cross_marquee3.style.top=parseInt(cross_marquee3.style.top)-copyspeed3+"px"
else
cross_marquee3.style.top=parseInt(marqueeheight3)+8+"px"
}

function initializemarquee3(){
cross_marquee3=document.getElementById("vmarquee3")
cross_marquee3.style.top=0
marqueeheight3=document.getElementById("marqueecontainer3").offsetHeight
actualheight3=cross_marquee3.offsetHeight
if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
cross_marquee3.style.height=marqueeheight3+"px"
cross_marquee3.style.overflow="scroll"
return
}
setTimeout('lefttime=setInterval("scrollmarquee3()",30)', delayb4scroll3)
}

if (window.addEventListener)
window.addEventListener("load", initializemarquee3, false)
else if (window.attachEvent)
window.attachEvent("onload", initializemarquee3)
else if (document.getElementById)
window.onload=initializemarquee3