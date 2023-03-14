$("#shelterform").on("submit", function (){
    let name = $("#name").val()
    if(name == ""){
        $("#err-name").css("display", "block")
        return false;
    }
    let age = $("#age").val()
    if(age == ""){
        $("#err-age").css("display", "block")
        return false;
    }
    let species = $("#species").val()
    if(species == ""){
        $("#err-species").css("display", "block")
        return false;
    }
    let sex = $("#sex").val()
    if(sex == ""){
        $("#err-sex").css("display", "block")
        return false;
    }
    let city = $("#city").val()
    if(city == ""){
        $("#err-city").css("display", "block")
        return false;
    }
    let state = $("#state").val()
    if(state == ""){
        $("#err-state").css("display", "block")
        return false;
    }
    let status = $("#status").val()
    if(status == ""){
        $("#err-status").css("display", "block")
        return false;
    }
    let kids = $("#kids").val()
    if(kids == ""){
        $("#err-kids").css("display", "block")
        return false;
    }
    let pets = $("#pets").val()
    if(pets == ""){
        $("#err-pets").css("display", "block")
        return false;
    }
    let health = $("#health").val()
    if(health == ""){
        $("#err-health").css("display", "block")
        return false;
    }

})