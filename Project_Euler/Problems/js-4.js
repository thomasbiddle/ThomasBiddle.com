/*
	Goal: Find the largest palindrome made from the product of two 3-digit numbers.

	Finished!
	Answer: 906609
*/

function isPalindrome( x )
{
	var z = new String(x);
	while( z.length > 0 )
	{
		if (z.length == 1) break;
		if ( z.substr(0,1) == z.substr(z.length-1,1) ) z = z.substr(1,z.length-2);
		else return false;
	}
	return true;
}

var highest = 0;
for (var i=100;i<1000;i++)
{
	for (var j=100;j<1000;j++)
	{
		var k = (i*j);
		if (isPalindrome(k) == true) if ( k > highest ) highest = k;
	}
}

document.write("The highest palindrome that is a product of two 3-digit numbers is: " + highest);

