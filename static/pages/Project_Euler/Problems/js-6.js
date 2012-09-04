/*
	Goal: Find the difference between the sum of the squares of the first one hundred natural numbers and the square of the sum.

	Finished!
	Answer: 25164150
*/


/*
	Calculates the sum of squares up to x.
	ie: x = 10
	1^2 + 2^2 + ... + 10^2 = 385
*/
function sumOfSquares( x )
{
	var total = 0;
	for (var i=1; i<=x; i++)
	{
		total += (i*i);
	}
	return total;
}

/*
	Calculates the square of sums up to x.
	ie: x = 10
	(1 + 2 + ... + 10)^2 = 552 = 3025
*/
function squareOfSums( x )
{
	var total = 0;
	for (var i=1; i<=x; i++) 
	{
		total += i;
	}
	return (total*total);
}


var difference = squareOfSums(100) - sumOfSquares(100);
document.write("The difference is: " + difference);
