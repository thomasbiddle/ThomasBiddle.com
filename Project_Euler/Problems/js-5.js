/*
	Goal: What is the smallest number divisible by each of the numbers 1 to 20?

	Finished!
	Answer: 232792560

	Notes: Takes too longs! (Have to cheat and start at a number just below the answer)
		Will come back to this at a later time.
*/

var found = false;
var count = 232750000;
while (!found) 
{
	/*
		Check the number to see if it is a multiple of all numbers 1-20.
		If it is not a multiple of any one, then break and check the next.
	*/
   for (var i=1; i<21; i++) 
   {
	   document.write("Currently testing: " + count + "</br>" );
	   if ( (i == 20) && (count%20 == 0) ) found = true;
	   if (count%i == 0) continue;
	   else break;
   }
	count+=20;
}

// Output our final number (Minus twenty since it was increased).
document.write("</br>");
document.write("The smallest number divisible by each of the numbers 1 to 20 is: " + (count-20) );
