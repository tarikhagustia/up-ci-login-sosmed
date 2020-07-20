// JavaScript Document

/***********************************************
* Cross browser Marquee II- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var delayb4scroll2=3000 //Specify initial delay before marquee starts to scroll on page (1000=1 seconds)
var marqueespeed2=1 //Specify marquee scroll speed (larger is faster 1-10)
var pauseit2=1 //Pause marquee onMousever (0=no. 1=yes)?

////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed2=marqueespeed2
var pausespeed2=(pauseit2==0)? copyspeed2: 0
var actualheight2=''

function scrollmarquee2(){
if (parseInt(cross_marquee2.style.top)>(actualheight2*(-1)+8))
cross_marquee2.style.top=parseInt(cross_marquee2.style.top)-copyspeed2+"px"
else
cross_marquee2.style.top=parseInt(marqueeheight2)+8+"px"
}

function initializemarquee2(){
cross_marquee2=document.getElementById("vmarquee2")
cross_marquee2.style.top=0
marqueeheight2=document.getElementById("marqueecontainer2").offsetHeight
actualheight2=cross_marquee2.offsetHeight
if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
cross_marquee2.style.height=marqueeheight2+"px"
cross_marquee2.style.overflow="scroll"
return
}
setTimeout('lefttime=setInterval("scrollmarquee2()",30)', delayb4scroll2)
}

if (window.addEventListener)
window.addEventListener("load", initializemarquee2, false)
else if (window.attachEvent)
window.attachEvent("onload", initializemarquee2)
else if (document.getElementById)
window.onload=initializemarquee2