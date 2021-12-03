


/********************************about us testimonials *********************/
var imgperson =document.getElementsByClassName("img-person");
var aboutperson =document.getElementsByClassName("about-person");
var first =document.getElementById("f");
var mid =document.getElementById("m");
var last =document.getElementById("l");

var changeicon=document.getElementsByClassName("change-icon");
var p1=document.getElementById("p1");
var p2=document.getElementById("p2");
var p3=document.getElementById("p3");
l.addEventListener('click',function(){
    console.log("j");
   
    first.style.backgroundColor = 'grey';
    mid.style.backgroundColor = 'grey';
    last.style.backgroundColor = 'brown';
    p1.style.display='none';
    p2.style.display='none';
    p3.style.display='flex';
});
m.addEventListener('click',function(){
    console.log("jl");
    first.style.backgroundColor = 'grey';
    last.style.backgroundColor = 'grey';
    mid.style.backgroundColor = 'brown';
    p1.style.display='none';
    p3.style.display='none';
    p2.style.display='flex';
});
f.addEventListener('click',function(){
    console.log("jkk");
    last.style.backgroundColor = 'grey';
    mid.style.backgroundColor = 'grey';
    first.style.backgroundColor = 'brown';
    p3.style.display='none';
    p2.style.display='none';
    p1.style.display='flex';
});
