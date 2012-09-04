/*
	Goal: What is the 10,001st prime number?

	Finished!
	Answer: 104743
*/	
	
/*
	Check if the number is prime by seeing if it is divisble my any numbers other than itself.
	Note: There are much better algorithms than this; for instance, check it against all previous
	primes and squares of primes. Improve it later.
*/
function checkIsPrime( x )
{
	if (x==1) return false;  
	if ( (x==2) || (x==3) ) return true;
	for(var i=3; i<=x; i+=2)
	{
		if (i == x) return true;
		if (x%i == 0) return false;
	}
}

var checking = 3;
var count = 2;

// Keep track of how many prime numbers we have found so far, when we hit the 10,0001st break out and tell us.
while (count < 10002)
{
	document.write("Currently checking: " + checking + "</br>");
	if (checkIsPrime(checking)) 
	{
		document.write("Found prime number " + count + ": " + checking + "</br>");
		count++; 
		checking+=2;
	}
	else checking+=2;
}

// Output the 10,000st prime - It must have 2 subtracted from it since it was added at the end.
document.write("The 10,001st prime number is: " + (checking-2));

