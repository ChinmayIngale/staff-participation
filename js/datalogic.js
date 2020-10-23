document.addEventListener("DOMContentLoaded", () => {

//select active button


var tabs = document.querySelectorAll(".add_button");
const tabContents = document.querySelectorAll('.form');
tabs.forEach(tab=> {
    tab.addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
    var target = tab.dataset.form;
    console.log(target);
    //document.querySelector(target).style.display = "none";
    $('.form:not('+target+')').hide();
    
    $(target).fadeIn(600);
    });
});


//redirect
document.querySelector("#index").addEventListener('click', function(){
    location.href="logout.php";
});



//validation
//form 2

var date = new Date();
var start = date.getFullYear();
var date = new Date();
var dd = date.getDate();
var mm = date.getMonth()+1;

 //January is 0
var yyyy = date.getFullYear();
var today = yyyy+'-'+mm+'-'+dd;

document.getElementById("dob").setAttribute("max", today);
document.getElementById("doji").setAttribute("max", today);

const img = document.querySelector("#preview");
const select = document.querySelector("#image");
img.addEventListener('click', function() {
    select.click();
});
select.addEventListener("change",function(event){
    var reader = new FileReader();
    reader.onload = function(){
        if(reader.readyState == 2){
            img.src = reader.result;
        }
    }
    reader.readAsDataURL(event.target.files[0]);

});


// backend connection for staff info



    var dept = document.querySelector("#select_dept");
    dname = dept.value;
    if(dname ==""){
        dname = "all";
    }
    displaystaffcontent(dname);
    
    dept.addEventListener("change", function(){
        dname = dept.value;
        loadstaffcontent(dname);
        
    });
    function displaystaffcontent(dname){
        if(dname != 'all'){ 
        var cnodes = document.querySelector("#select_staff").children;
        for(var i = 1; i < Object.keys(cnodes).length; i++){
            cnodes[i].style.display = 'none';
        }
    }
        var options = document.getElementsByClassName(dname);
        for(var i = 0; i < Object.keys(options).length; i++){
            options[i].style.display = 'block';
        }
        
    }
    
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
            document.querySelector("#information").innerHTML= "";
            document.querySelector("#try").innerHTML= "";
        })
    }


    function FindByAttributeValue(attribute, value, element_type)    {
        element_type = element_type || "*";
        var All = document.getElementsByTagName(element_type);
        for (var i = 0; i < All.length; i++){
          if (All[i].getAttribute(attribute) == value) { return All[i]; }
        }
      }

    function getInfo(){
        var ssn = staff.value;
        var e = FindByAttributeValue("value", ssn, "option");
        var deptname = e.className;
        console.log(deptname);
        const dos = document.getElementsByClassName("do");
        for(var i = 0; i < dos.length; i++){
            dos[i].selected = false;
        };
        console.log("ssn is:"+ssn);
        if(!ssn == ""){
            document.getElementById(deptname).selected = true;
        
            $.ajax({
                url:"getbackenddata.php",
                method:"post",
                data:"ssn=" + ssn
            }).done(function(sname){
                document.querySelector("#information").innerHTML= sname;
            });
        }else{
            document.querySelector("#information").innerHTML= '';
        }
    }
    
    var staff = document.querySelector("#select_staff");
    staff.addEventListener("change", getInfo);
    
	getInfo();
    deleteInfo = function(dept,sr){
        console.log(dept);
        $.ajax({
            url:"delete.php",
            method:"post",
            data:{"table":dept,"row": sr}
        }).done(function(data){
            document.querySelector("#try").innerHTML= data;
            getInfo();
        })
    }

    modifyInfo = function(dept,sr){
        document.querySelector("#tsr").value=sr;
    }
    
  }); 