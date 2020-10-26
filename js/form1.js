document.addEventListener("DOMContentLoaded", () => {

    

    var date = new Date();
    var start = date.getFullYear();
    var dd = date.getDate();
    var mm = date.getMonth()+1; //January is 0

    var end = 1990;
    var options = "";

    if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    }
    var today = start+'-'+mm+'-'+dd;
    document.getElementById("sd").setAttribute("max", today);
    document.getElementById("ed").setAttribute("max", today);

    while(end <= start){
        if(preyear == start){
            options += "<option value='"+start+"' selected>"+ start +"</option>";
        }
        else{
            options += "<option value='"+start+"'>"+ start +"</option>";
        }
        start -= 1;
    }
    document.getElementById("year").innerHTML = options;

});