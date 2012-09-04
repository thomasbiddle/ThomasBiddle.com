/*
	Goal: What is the largest prime factor of the number 600851475143 ?

	Finished! 	
	Answer: 6857
	
	Notes: Awesome! Javascript handles large numbers easily!
*/
	
/*
	Checks if x is a prime number.
*/
function checkIsPrime(x)
{
	if (x==1) return false;  
	if ( (x==2) || (x==3) ) return true;
	for(var i=3; i<=x; i+=2)
	{
		if (i == x) return true;
		if (x%i == 0) return false;
	}
}	

/*
	Returns the highest prime factor of the number given.
	ie: 
	The prime factors of 13195 are 5, 7, 13 and 29.
	Return 29.
*/	
function findHighestFactorOf( x )
{
	var i = 2;
	var highestPrime = 0;
	while (x != 1) // Once x == 1, we are finished.
	{
		if ( checkIsPrime(i) ) // Check if the number is prime.
		{
			if ( x%i == 0 ) // If x%i == 0 then we have a divisor.
			{
				x /= i; // Divide our number by i, the prime number that x is divisble by.
				highestPrime = i; // i is our new highest prime.
			}
		}
	i++; // Increase i to check the next number.
	}
	return highestPrime;
}	
	
var input = 600851475143;
document.write("The highest prime factor of 600851475143 is : " + findHighestFactorOf(input) );

