changeinnercontent();
// Overflow boolean checker
function isOverflown(element){
  return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
function changeinnercontent(){
  var cur =document.querySelector(".active");
  document.querySelector("#col2").innerHTML="<h1>"+cur.innerText+"</h1>";
}


changeinnercontent();
const parent = document.querySelector('.img');
// Show if overflowed
if(isOverflown(parent)){
  document.querySelector('.img').className+= " overflow"
}

var header = document.querySelector("#col1");
var btns = header.querySelectorAll('.btn');//getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  changeinnercontent();
  });
}
