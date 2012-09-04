/* 
	Goal: By considering the terms in the Fibonacci sequence whose values do not exceed four million, find the sum of the even-valued terms.

	Finished!
	Answer: 4613732
	
	Notes: Looks like our original variables names are in Javascripts restricted list. I had to add "1" to the end of all of them to make sure I wasn't running into any issues.

*/

var bottom1 = 1; // The bottom value in the Fibonacci Sequence.
var top1 = 2; // The top value in the Fibonacci Sequence
var temp1; // A temporary variable to hold the answer that the fib() function returns.
var total1 = 0; // The sum of even Fibonnaci values.

/*
	While the top value is less than 4,000,000 , Find the Fib value of the two previous values.
	Save the answer to a temporary value. The previous bottom becomes the top, the previous top becomes
	the new Fib value we just found.
*/

while (top1 < 4000000)
{
	if (top1%2 == 0) total1 += top1; // If the value is even, add it to our total sum.
	temp1= bottom1+top1;
	document.write(temp1);
	document.write(bottom1 + " + " + top1 + " = " + temp1 + "</br>");
	bottom1 = top1;
	top1 = temp1;
}

// Output the total sum of even Fibonacci values below 4,000,000
document.write("</br>Sum of even Fibonacci values below 4,000,000: " + total1);

