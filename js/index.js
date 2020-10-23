
var btns =  document.querySelectorAll(".dept_select");
btns.forEach(btn => {
  btn.addEventListener('click', () => {
    var target = document.querySelector(".activedept")
    if(target){
      target.className = target.className.replace(" activedept", "");
    }
    btn.className += " activedept";
    console.log(btn.dataset.dept);
    stafflist(btn.dataset.dept);
  });
});

function stafflist(dept){

  $.ajax({
    url:"stafflist.php",
    method:"post",
    data:"dept=" + dept
  }).done(function(data){
      document.querySelector("#stafflist").innerHTML = data;
  });
}


document.querySelector("#login_page").addEventListener('click', function(){
  location.href="login_page.php";
});