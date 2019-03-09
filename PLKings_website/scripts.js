 $(document).ready(function()
{
	//Get the element with the id="defualtOpen" and click on it
	document.getElementById("main-container").style.display = "block";
	//document.getElementById("defaultOpen").click();
	
    DisplaySpecial(GetCurrentDay());
    
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

    var i, j, hhContent, nodes;

	//Reset all day buttons
    dayTabLink = document.getElementsByClassName("day-button");
    for(i=0; i<dayTabLink.length; i++)
    {	
		dayTabLink[i].style.transform = "";
		dayTabLink[i].style.boxShadow = "";
        dayTabLink[i].style.backgroundColor = "";
		dayTabLink[i].style.color = "";
    }

	//Grab each bars "day's specials"
    hhContent = document.getElementsByClassName("day-special-container");

    for (i=0; i<hhContent.length; i++)
    {
        nodes = hhContent[i].childNodes;

        for(j=0;j< nodes.length; j++)
        {
            if(nodes[j].nodeName.toLowerCase() == 'p')
            {
                nodes[j].style.display = "none"
            }
        }
    }

    var dayClass, dayId;    

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

    
    for(i=0; i<document.getElementsByClassName(dayClass).length; i++)
    {
        document.getElementsByClassName(dayClass)[i].style.display = "block";
    }
	
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