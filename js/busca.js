function validateForm(){
    var x = documet.forms["myForm"]["busca"].value;
    if(x == ""){
        alert("Por favor, digite um termo de pesquisa");
        return false;
    }
}
