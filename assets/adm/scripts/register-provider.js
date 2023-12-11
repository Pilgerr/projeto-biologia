function phone(i) {
    var v = i.value; 

    i.setAttribute("maxlength", "19"); 
    if (v.length == 8) i.value += " "; 
    if (v.length == 14) i.value += "-";
}