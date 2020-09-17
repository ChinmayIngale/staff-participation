var tabs = document.querySelectorAll(".add_button");
const tabContents = document.querySelectorAll('.form');
tabs.forEach(tab=> {
    tab.addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
    });
})
var date = new Date();

var start = date.getFullYear();
var end = 1990;
var options = "";
while(end <= start){
    options += "<option value='"+start+"'>"+ start +"</option>";
    start -= 1;
}
document.getElementById("year").innerHTML = options;

var date = new Date();
var dd = date.getDate();
var mm = date.getMonth()+1; //January is 0
var yyyy = date.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

var today = yyyy+'-'+mm+'-'+dd;
document.getElementById("sd").setAttribute("max", today);
document.getElementById("ed").setAttribute("max", today);

function scrollWin(x, y) {
    document.getElementById("data_in").scrollBy(x, y);
    
}

  document.addEventListener("DOMContentLoaded", () => {
    dname = "all";
    var dept = document.querySelector("#select_dept");
    dept.addEventListener("change", function(){
        var dname = dept.value;
        loadstaffcontent(dname);
        
    });
    loadstaffcontent(dname)
    function loadstaffcontent(dname){
        if(dname ==""){
            dname = "all";
        }
        $.ajax({
            url:"getbackenddata.php",
            method:"post",
            data:"dname=" + dname
        }).done(function(sname){
            document.querySelector("#select_staff").innerHTML= sname;
            document.querySelector("#infoo").innerHTML= "";
        })
    }


    function FindByAttributeValue(attribute, value, element_type)    {
        element_type = element_type || "*";
        var All = document.getElementsByTagName(element_type);
        for (var i = 0; i < All.length; i++){
          if (All[i].getAttribute(attribute) == value) { return All[i]; }
        }
      }


    var staff = document.querySelector("#select_staff");
    staff.addEventListener("change", function(){
        var ssn = staff.value;
        var e = FindByAttributeValue("value", ssn, "option");
        var deptname = e.getAttribute("title");
        const dos = document.getElementsByClassName("do");
        for(var i = 0; i < dos.length; i++){
            dos[i].selected = false;
        };
        if(!ssn == ""){
        document.getElementById(deptname).selected = true;
        }
        $.ajax({
            url:"getbackenddata.php",
            method:"post",
            data:"ssn=" + ssn
        }).done(function(sname){
            document.querySelector("#infoo").innerHTML= sname;
        })

    });
  }); 