		var inMail = false;
		var username = "recruiter";
		var boxname = "resume";
		var messageTime = 6;
		var shellStart = username + "@" + boxname + " ~> ";
		var shellInput = '<input type="text" id="terminalInputId" autocomplete="off"/>';
		var shellNew = shellStart + shellInput;
		
		function messageTimer()
		{
			document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
			addInput("</br></br>");
			addInput("You have new mail waiting for you in /var/spool/mail/recruiter </br>");
			addInput("</br>");
			setTerminal();
		}
		function resetVars()
		{
			shellStart = username + "@" + boxname + " ~> ";
			shellNew = shellStart + shellInput;
		}
		function returnKey(evt)
		{
			var evt  = (evt) ? evt : ((event) ? event : null);
		 
			if (evt.keyCode == 13)
			{
				if (inMail)
					printMail(document.getElementById('terminalInputId').value);
				else printOutput(document.getElementById('terminalInputId').value);
			}
		}
		function currentText() 
		{
			x = document.getElementById('terminalEmu').innerHTML;
			return x;
		}
		function addInput( x )
		{
			document.getElementById('terminalEmu').innerHTML = currentText() + x;
		}
		function setTerminal()
		{
			addInput(shellNew);
			document.getElementById('terminalInputId').focus();
		}
		function loadTerminal( x )
		{
			for (var i=0; i<x; i++) setTimeout("addInput('.')",i*500);
			setTimeout(function() { 
				addInput("</br>"); 
				addInput("Parsing File </br>");
				addInput("Moving file to /usr/bin </br>");
				addInput("File Status: [Loaded]</br></br>");
				addInput("Thomas Biddle's Resume is ready for use. Enter 'help' for a list of commands.</br>");
				setTerminal(); 
			}, x*510);
		}
		function startEmu()
		{
			addInput(shellStart);
			addInput("</br>");
			addInput("Loading Resume_Thomas_Biddle ..");
			loadTerminal(10);
			setTimeout(messageTimer,messageTime*1000);
		}
		function printOutput(terminalInput)
		{
			if (terminalInput == "about") 
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("about");
				addInput("</br></br>");
				addInput("Last Name: Biddle</br>");
				addInput("First Name: Thomas</br>");
				addInput("Major: Computer Science</br>");
				addInput("</br>");
				addInput("Computer Science & Software Development:</br>");
				addInput("</br>");
				addInput("I am currently a student at the University of Cincinnati working towards my BS in Computer Science. Software development is one of my greatest interests, and I always strive to not only increase my knowledge and experience in the field; but find new ways to apply it.</br>");
				addInput("</br>");
				addInput("Independent Ventures:</br>");
				addInput("</br>");
				addInput("In 2011 I was able to successfully found two web hosting companies centered around Virtual Private Servers. Between the two companies, I catered to over 500 individual monthly customers and held a reputation for outstanding customers service and going the extra mile in order to make sure my services were the best available.</br>");
				addInput("</br>");
				addInput("Specialties:</br>");
				addInput("Java, C++, Javascript, Linux, Android</br>");
				addInput("</br>");
				setTerminal();
			}
			else if (terminalInput == "education") 
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("education");
				addInput("</br></br>");
				addInput("University of Cincinnati</br>");
				addInput("BS, Computer Science</br>");
				addInput("2010-2015 (expected)</br>");
				addInput("</br>");
				addInput("Sycamore High School</br>");
				addInput("2006-2010");
				addInput("</br>");
				addInput("Enrolled in Honors and Advanced Placement (AP) courses. Entire senior year was deciated to the Post Secondary Enrollment Options Program (PSEOP)</br>");
				addInput("</br>");
				setTerminal();
			}
			else if (terminalInput == "workhistory")
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("workhistory");
				addInput("</br></br>");
				addInput("Seapine Software</br>");
				addInput("Software Development Co-op</br>");
				addInput("January 2012 - Present</br>");
				addInput("Worked as a part of the Surround SCM Development Team and was responsible for fixing submitted defects with the SCM software. Work was mainly done in C++; however while working with certain features knowledge of Java, Javascript, HTML, and CSS were needed.</br>");
				addInput("</br>");
				addInput("MinecraftLayer.com</br>");
				addInput("Co-Founder</br>");
				addInput("September 2011 - December 2011</br>");
				addInput("Company was built around being a hosting platform for the popular Indie game, 'Minecraft'. Even with dozens of competitors in this field, we were able to quickly grow a reputation for having fast and reliable solutions for our customers. With my familiarity of VPSs, and my partner's knowledge of the game and experience in web-hosting - we became a deadly duo to have the company gain a strong foothold in a tough market. While the company was, and still is, running very smoothly - I chose to leave MinecraftLayer in order to focus on other endeavors.</br>I officially left MinecraftLayer December 31, 2011.</br>");
				addInput("</br>");
				addInput("VPSInfinity.com</br>");
				addInput("Founder</br>");
				addInput("February 2011 - December 2011</br>");
				addInput("VPSInfinity was founded in early 2011 as a hosting company for the niche group in game macros. Over 300 individuals clients were served over the period of operation, many leaving our competitor's services to join us due to our superior customer support and feature advancement. The company turned a successful profit from day one and was experiencing incredible growth throughout the period of operation. Many lessons were learned; however unfortunately doors were closed due to the market taking a very swift downturn as our prime target user became unable to run macros as the 3rd party game had implemented a way to prevent this.</br>Officially shut down December 31, 2011.</br>");
				addInput("</br>");
				addInput("Boulder Landscaping</br>");
				addInput("Division Manager</br>");
				addInput("January 2008 - June 2011</br>");
				addInput("Duties included: Lawn-care, tree removal, mulching, and other landscaping necessities.</br>Was the company's first hire from their founding, helped with initial marketing and customer relations.</br>");
				addInput("</br>");
				addInput("Cold Stone Creamery</br>");
				addInput("Server</br>");
				addInput("November 2007 - April 2009</br>");
				addInput("Served a multitude of customers as this was the most profitable franchise in the company during peak seasons, practiced teamwork with fellow colleagues, and worked the cash register.</br>");
				addInput("</br>");
				setTerminal();
			}
			else if (terminalInput == "recommendations")
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("recommendations");
				addInput("</br></br>");
				addInput("Samual Stine, Web Engineer & Founder, SeerVirtual, LLC. says...</br>");
				addInput("</br>");
				addInput("“For the better part of 2011, Thomas Biddle and I competed with each other at our respective companies. While I oversaw operations at SeerHost (a service of SeerVirtual, LLC.) Thomas managed his company, VPSInfinity. There were several other competitors in our market but Thomas's company was the only one I had to worry about. His creative style and charismatic attitude helped him gain and retain clients.</br>On several occasions I had the pleasure to discuss our business approaches and market conditions with Thomas. Although we were competitors, we were happy to recommend clients to one another in times of full capacity. I always knew customers would be better off at Thomas's company than with one of the other competitors.</br>Thomas is a responsible and dedicated businessman so I hope that I have the pleasure of either working with or against him in the future. I'm sure he will carry these qualities to other establishments and I certainly would recommend him for other positions.”</br>");
				addInput("</br>");
				addInput("Zach LaGreca, Jr Web Designer, Vezign, LLC says...</br>");
				addInput("</br>");
				addInput("“Thomas J Biddle is a creative worker. He doesn't just do the job - he looks for ways to do things more efficiently. His ingenuity and professionalism are evident in his company VPSInfinity and all his ventures. I highly recommend him.”</br>");
				addInput("</br>");
				setTerminal();
			}
			else if (terminalInput == "portfolio")
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("portfolio");
				addInput("</br></br>");
				addInput("As my experience in Computer Science and programming continues to grow, I will be adding as much to my portfolio as possible. As a supporter of open source communities, I plan to release the source code for any personal projects I take on. The majority, if not all, of my independent projects can be found at: <span class='inLink'><a href='http://www.ThomasBiddle.com/#work'>http://www.ThomasBiddle.com/#work</a></span></br>");
				addInput("</br>");
				addInput("At the above address, you will find a collection of my independent projects, such as 'Project Euler' problems, as well as Android Applications. I also have a few small school assignments that I found to be interesting.</br>");
				addInput("</br>");
				setTerminal();
				
			}
			else if ( (terminalInput == "help") || (terminalInput == "?") )
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("help");
				addInput("</br></br>");
				addInput("The following commands are supported:");
				addInput("</br>");
				addInput("   ***********</br>");
				addInput("<pre>about\t\t-\tGeneral information about 'Thomas Biddle'.\neducation\t-\tPast and current education information.\nworkhistory\t-\tRetrieve an up-to-date history of employment.\nportfolio\t-\tProject portfolio and code snippets.\nrecommendations\t-\tRecommendations for Thomas from others.\nmail\t\t-\tRead the system's messages.</pre>");
				addInput("   ***********</br>");
				addInput("</br>");
				setTerminal();
			}
			
			/* Some extra easter egg goodies */
			else if (terminalInput == "mail")
			{
				inMail = true;
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("mail");
				addInput("</br></br>");
				addInput("Mail version 5.6 6/1/95. Type '?' or 'help' for a list of commands.</br>");
				addInput("/var/spool/mail/recruiter: 1 message</br>");
				addInput(">  1 ThomasBiddle@resume Sat 2/11/2011 20:54 Subj: 'Hello there!'</br>");
				shellNew = "& " + shellInput;
				addInput("</br>");
				setTerminal();
			}
			else if (terminalInput == "clear")
			{
				document.getElementById("terminalEmu").innerHTML = "";
				setTerminal();
			}
			else if ( terminalInput.substring(0,2) == "su" && (terminalInput.substring(0,4) != "sudo") )
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				if ( (terminalInput.substring(3,7) == "root") || (terminalInput.substring(3,8) == "admin") || (terminalInput.substring(3,16) == "administrator") ) addInput("Seriously, it's not that easy.</br>");
				else 
				{
					if (terminalInput.substring(3,terminalInput.length).length != 0)
						username = terminalInput.substring(3,terminalInput.length);
					else addInput(boxname + "</br>");
				}
				resetVars();
				setTerminal();
			}
			else if (terminalInput.substring(0,8) == "hostname")
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				if (terminalInput.substring(9,terminalInput.length).length != 0) {
						boxname = terminalInput.substring(9,terminalInput.length);
						addInput("Message from root@" + boxname + ": Hey, what's going on here!?</br>");
				}
				else addInput("Hostname cannot be empty.</br>");
				addInput("</br>");
				resetVars();
				setTerminal();
			}
			else if (terminalInput.substring(0,2) == "ls")
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("<pre>passw0rds.txt\nskynet.cpp\n</pre>");
				setTerminal();
			}
			else if ( (terminalInput.substring(0,4) == "sudo" ) )
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				addInput("Did you really think it was going to be that easy?</br>");
				setTerminal();
			}
			else if ( (terminalInput.substring(0,2) == "cp" ) || (terminalInput.substring(0,2) == "mv" ) || (terminalInput.substring(0,4) == "wget" ) || (terminalInput.substring(0,4) == "grep" ) || (terminalInput.substring(0,3) == "gcc") || (terminalInput.substring(0,3) == "c++") || (terminalInput.substring(0,3) == "tar") || (terminalInput.substring(0,4) == "gzip")|| (terminalInput.substring(0,3) == "ssh") || (terminalInput.substring(0,5) == "bzip2") || (terminalInput.substring(0,5) == "rsync") || (terminalInput.substring(0,3) == "sed") || (terminalInput.substring(0,3) == "rpm") || (terminalInput.substring(0,3) == "yum") || (terminalInput.substring(0,2) == "cd") )
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				addInput("Access denied.</br>");
				setTerminal();
			}
			else if ( (terminalInput.substring(0,4) == "nano") || (terminalInput.substring(0,3) == "vim") )
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				if (terminalInput.substring(0,4) == "nano")
				addInput(terminalInput.substring(0,4) + " is not installed on this machine. Try using 'cat' to read the contents of a file. </br>");
				if (terminalInput.substring(0,3) == "vim")
				addInput(terminalInput.substring(0,3) + " is not installed on this machine. Try using 'cat' to read the contents of a file. </br>");
				setTerminal();
			}
			else if ( terminalInput.substring(0,3) == "cat" )
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				if (terminalInput.substring(4,8) == "pass") 
				{
					addInput("<pre>benken0bi\nqwerty\npassword123</pre>");
				}
				else if (terminalInput.substring(4,7) == "sky") 
				{
					addInput("<pre>def getSolutionCosts(navigationCode):\n\tfuelStopCost=15\n\textraComputationCost=8\n\tthisAlgorithmBecomingSkynetCost=999999999\n\twaterCrossingCost=45</pre>");
				}
				else if (terminalInput.substring(4,5) == "/")
				{
					addInput(terminalInput.substring(4,terminalInput.length) + " is not a file.</br>");
				}
				else if (terminalInput.substring(4,terminalInput.length) == "")
				{
					addInput("Please enter a filename (e.g. cat MyFile.txt)</br>");
				}
				setTerminal();
			}
			else if ( (terminalInput == "passw0rds.txt") || (terminalInput == "skynet.cpp") ) 
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				addInput(terminalInput + " is a text file. Try opening it with another command. </br>");
				addInput("</br>");
				setTerminal();
			}
			else
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				addInput(terminalInput + ": command not found - Type 'help' for a list of commands.</br>");
				addInput("</br>");
				setTerminal();
			}
		}
		function printMail(terminalInput)
		{
			if ( (terminalInput == "quit") || (terminalInput == "home") || (terminalInput == "end") )
			{
				inMail = false;
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("quit");
				shellNew = shellStart + shellInput;
				addInput("</br>");
				setTerminal();
			}
			else if (terminalInput == "inbox")
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput("inbox");
				addInput("</br></br>");
				addInput("Mail version 5.6 6/1/95. Type '?' or 'help' for a list of commands.</br>");
				addInput("/var/spool/mail/recruiter: 1 message</br>");
				addInput(">  1 ThomasBiddle@resume Sat 2/11/2011 20:54 Subj: 'Hello there!'</br>");
				shellNew = "& " + shellInput;
				addInput("</br>");
				setTerminal();
			}
			else if (terminalInput == "read")
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				addInput("</br>");
				addInput("Date: Sat, 2/11/2011 22:16 -0500</br>");
				addInput("From: ThomasBiddle@resume</br>");
				addInput("To: recruiter@resume</br>");
				addInput("Subject: Hello there!</br>");
				addInput("Hello! I'm so glad to see you have found my message here. I hope you're having a fun time navigating through my resume; as I write the code for it now I am having an absolute blast thinking of new things to implement - if you play around a bit, I'm sure you'll find them (I think there's actually more easter eggs than there is information about myself, go figure).</br></br>I can only assume you've read through the information I've provided about myself earlier; so I won't bother repeating myself here - but what I will tell you is, you simply won't find someone more enthusiastic about this field. I'm not here to simply get a job and hack away at a desk; I <s>enjoy</s> love creating and developing new things; I keep a list of ideas for new projects that I would love to jump on, and needless to say - it's growing faster than I can cross things off.</br>");
				addInput("</br>");
				setTerminal();
			}
			else if (terminalInput == "?" || terminalInput == "help")
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br></br>");
				addInput("The mail application supports the following commands:");
				addInput("</br>");
				addInput("   ***********</br>");
				addInput("<pre>read\t-\tRead any unopened messages.\ninbox\t-\tList the system's messages.\nquit\t-\tQuit the mail application.</pre>");
				addInput("   ***********</br></br>");
				setTerminal();
			}
			else if (terminalInput == "clear")
			{
				document.getElementById("terminalEmu").innerHTML = "";
				setTerminal();
			}
			else
			{
				document.getElementById('terminalEmu').removeChild(document.getElementById('terminalInputId'));
				addInput(terminalInput);
				addInput("</br>");
				addInput(terminalInput + ": mail does not support that command - Type '?' or 'help' for a list of commands. Type 'quit' to quit.</br>");
				addInput("</br>");
				setTerminal();
			}
		}