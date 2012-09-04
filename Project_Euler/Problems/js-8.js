/*
	Goal: Find the greatest product of five consecutive digits in the 1000-digit number.
	Finished!
	Answer: 40824
	
	Notes: Wow - this one had me for a little while in c++ since I wasn't sure how to handle the
			char* datatype; however in Javascript since every variable is saved the same, this was easy!
*/


// Our 1000 digit number. Declare as a string since no other data type can hold it.
var numbers = "7316717653133062491922511967442657474235534919493496983520312774506326239578318016984801869478851843858615607891129494954595017379583319528532088055111254069874715852386305071569329096329522744304355766896648950445244523161731856403098711121722383113622298934233803081353362766142828064444866452387493035890729629049156044077239071381051585930796086670172427121883998797908792274921901699720888093776657273330010533678812202354218097512545405947522435258490771167055601360483958644670632441572215539753697817977846174064955149290862569321978468622482839722413756570560574902614079729686524145351004748216637048440319989000889524345065854122758866688116427171479924442928230863465674813919123162824586178664583591245665294765456828489128831426076900422421902267105562632111110937054421750694165896040807198403850962455444362981230987879927244284909188845801561660979191338754992005240636899125607176060588611646710940507754100225698315520005593572972571636269561882670428252483600823257530420752963450";

var start = 0; // Iterator for first digit of consecutive 5 digits.
var highestProd = 0; // The current highest product of 5 consecutive primes.
while ( start+5 < 1001 ) // Do this until we have checked all possible 5 consecutive digits.
{
	/* 
		Extract 5 consecutive integers from the "numbers" variable above, and multiply them together.
		If it is higher than an earlier found product, then store it as the new highest product.
	*/
	var highestProdTemp = numbers.substr(start,1) * numbers.substr(start+1,1) * numbers.substr(start+2,1) * numbers.substr(start+3,1) * numbers.substr(start+4,1);
	document.write("Number: ");
	document.write(numbers.substr(start,1)); 
	document.write(numbers.substr(start+1,1));
	document.write(numbers.substr(start+2,1));
	document.write(numbers.substr(start+3,1));
	document.write(numbers.substr(start+4,1));
	document.write(" Temp vs. Highest: " + highestProdTemp + " vs. " + highestProd + "</br>");
	if (highestProdTemp > highestProd ) highestProd = highestProdTemp;
	start += 1;
}

// Output the final largest product of 5 consecutive integers.
document.write("The largest product of 5 consecutive integers is: " + highestProd + "</br>");
