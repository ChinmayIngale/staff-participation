changeinnercontent();
var header = document.getElementById("col1");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  changeinnercontent();
  });
}
function changeinnercontent(){
    var cur =document.querySelector(".active");
    document.querySelector("#col2").innerHTML="<h1>"+cur.innerText+"</h1>";
}