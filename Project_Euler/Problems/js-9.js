/*
	Goal: There exists exactly one Pythagorean triplet for which a + b + c = 1000. Find the product abc.

	Finished!
	Answer: 31875000
*/

// Find all Pythagorean triples with a max a or b values of x.

function findPythTrip( x )
{
	for (var i=1; i<=x; i++) // Iterate throught a's
	{
		for (var j=i+1; j<=x; j++) // Iterate through b's
		{
			var k = ( (i*i) + (j*j) );	// k = i^2 + j^2
			if ( Math.sqrt(k) == Math.floor(Math.sqrt(k)) ) // Is this number a square?
			{
				// Found a triplet!
				document.write("Found Pythagorean Triple: " + i + "," + j + "," + Math.sqrt(k) + "</br>");
				if (i+j+(Math.sqrt(k)) == 1000) // Is a+b+c = 1000?
				{
					// We have our solution! Find what the product of abc and print it!
					document.write("Found when where a+b+c = 1000: " + i + "," + j + "," + Math.sqrt(k) + "</br>");
					document.write("Product abc = " + (i*j*(Math.sqrt(k))) + "</br>");
					return;
				}
			}
		}
	}
}

findPythTrip(1000);