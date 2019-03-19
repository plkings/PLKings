 $(document).ready(function()
{
	//Get the element with the id="defualtOpen" and click on it
	document.getElementById("defaultOpen").click();
    DisplaySpecial(GetCurrentDay());

    document.getElementById("main-container").style.display = "block";
    
});


//Send message to email server
$(function(){
    $('#send-message').click(function() {
        var name, email, subject, message;

        name = $('#sender-name').val();
        email = $('#sender-email').val();
        subject = $('#message-subject').val();
        message = $('#message-text').val();
        alert(name + email + subject + message);
    });
});


//Need make this more scalable
function OpenPage(location, elemnt)
{
	var i, text;

    //Display bar-cards with class the same as location
    $('.bar-card').each(function (){
        if($(this).hasClass(location)) {
            $(this).css("display", "block");
        }
        else {
            $(this).css("display", "none");
        }
    });

    text = $(elemnt).text();

    $('#dropdownMenuButton').html(text);
}

function DisplaySpecial(day){

    var dayClass, dayId;   

    $('.day-button').each(function (){
        $(this).css("transform", "");
        $(this).css("box-shadow", "");
        $(this).css("background-color", "");
        $(this).css("color", "");
    });

    $('.day-special-container').children().css("display", "none");
    

    if(day == 0)
    {
        dayClass = 'sunday-special';
        dayId = 'sunday';
    }
    else if(day == 1)
    {
        dayClass = 'monday-special';
        dayId = 'monday';
    }
    else if(day == 2)
    {
        dayClass = 'tuesday-special';
        dayId = 'tuesday';
    }
    else if(day == 3)
    {
        dayClass = 'wednesday-special';
        dayId = 'wednesday';
    }
    else if(day == 4)
    {
        dayClass = 'thursday-special';
        dayId = 'thursday';
    }
    else if(day == 5)
    {
        dayClass = 'friday-special';
        dayId = 'friday';
    }
    else if(day == 6)
    {
        dayClass = 'saturday-special';
        dayId = 'saturday';
    }

    $('.' + dayClass).each( function() {
        $(this).css("display" , "block");
    });
	DayButtonPress(dayId);

}

function DayButtonPress(id)
{
	document.getElementById(id).style.backgroundColor = "#007171";
	document.getElementById(id).style.color = "white";
	document.getElementById(id).style.borderColor = "black";
	document.getElementById(id).style.transform = "translateY(-0.25em)";
	document.getElementById(id).style.boxShadow = "0 0.5em 0.5em -0.3em #007171";
}

function GetCurrentDay()
{
    var d, day;

    d = new Date();
    day = d.getDay();

    return day;
}