window.onload = function ()
{
	//Get the element with the id="defualtOpen" and click on it
	document.getElementById("defaultOpen").click();
}

	function openPage(pageName,elemnt)
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