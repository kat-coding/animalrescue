/**
 * Authors Dee Brecke, Katherine Watkins, Alex Brenna
 * 3/14/23
 * This is the client-side validation for the shelter pet form
 * It shows error message if the data is missing, but keeps the
 * entered data on the page
 */
$("#shelterform").on("submit", function (){
    //put value of name field in variable
    let name = $("#name").val()
    //check if the name is missing
    if(name == ""){
        //if so, show the error message on the page
        $("#err-name").css("display", "block")
        //and don't submit the form
        return false;
    }
    //continue check as above for all other required fields
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