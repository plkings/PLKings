window.onload = function ()
{
	//Get the element with the id="defualtOpen" and click on it
	document.getElementById("defaultOpen").click();

    DisplaySpecial(GetCurrentDay());
    
}

function OpenPage(pageName,elemnt)
{
	var i, tabContent, tabLinks;
	tabContent = document.getElementsByClassName("tabContent");
	
	//Hide all the tabContents
	for(i=0; i < tabContent.length; i++)
	{
		tabContent[i].style.display = "none";
	}
	tabLinks = document.getElementsByClassName("tablink");
	
	//Set all button color background to default
	for(i=0; i < tabLinks.length; i++)
	{
		tabLinks[i].style.backgroundColor = "";
	}
	
	document.getElementById(pageName).style.display = "block";
	elemnt.style.backgroundColor = "teal";
}

function DisplaySpecial(day){

    var i, j, hhContent, nodes;

    dayTabLink = document.getElementsByClassName("daytab");
    for(i=0; i<dayTabLink.length; i++)
    {
        dayTabLink[i].style.backgroundColor = "";
    }

    hhContent = document.getElementsByClassName("hhContainer");

    for (i=0; i<hhContent.length; i++)
    {
        nodes = hhContent[i].childNodes;

        for(j=0;j< nodes.length; j++)
        {
            if(nodes[j].nodeName.toLowerCase() == 'div')
            {
                nodes[j].style.display = "none"
            }
        }
    }

    var dayClass, dayId;    

    if(day == 0)
    {
        dayClass = 'sundaySpecial';
        dayId = 'sunday';
    }
    else if(day == 1)
    {
        dayClass = 'mondaySpecial';
        dayId = 'monday';
    }
    else if(day == 2)
    {
        dayClass = 'tuesdaySpecial';
        dayId = 'tuesday';
    }
    else if(day == 3)
    {
        dayClass = 'wednesdaySpecial';
        dayId = 'wednesday';
    }
    else if(day == 4)
    {
        dayClass = 'thursdaySpecial';
        dayId = 'thrusday';
    }
    else if(day == 5)
    {
        dayClass = 'fridaySpecial';
        dayId = 'friday';
    }
    else if(day == 6)
    {
        dayClass = 'saturdaySpecial';
        dayId = 'saturday';
    }

    
    for(i=0; i<document.getElementsByClassName(dayClass).length; i++)
    {
        document.getElementsByClassName(dayClass)[i].style.display = "block";
    }
    document.getElementById(dayId).style.backgroundColor = "teal";

}

function GetCurrentDay()
{
    var d, day;

    d = new Date();
    day = d.getDay();

    return day;
}
    