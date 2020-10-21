var header = document.getElementById("sidenav");
var btns = header.getElementsByClassName("dept_select");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementById("activedept");
  current.id = "";
  this.id = "activedept";
  });
}

document.querySelector("#login_page").addEventListener('click', function(){
  location.href="login_page.php";
});