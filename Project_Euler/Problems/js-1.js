/*
	Goal: Add all the natural numbers below one thousand that are multiples of 3 or 5.
	Finished!
	Answer: 233168
*/

var count = 0; // Keep track of our number of multiples so far.

for (var i=1; i<1000; i++) 
{
	// If the number is divible by 3 and 5, increase our count.
	if ( (i%3 == 0) || (i%5 == 0) ) count += i;
}

// Output our final count.
document.write(count);

