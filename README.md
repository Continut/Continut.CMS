# README #

Getting started with Conţinut CMS

### What is Conţinut CMS? ###

Conţinut CMS aims to be an easy to use and easy to extend low to midlevel CMS system with builtin multidomain, multilanguage and responsive support. Different Backend and Frontend layouts as well as different containers can be created and inserted recursively on any page allowing you to create that ultimate design you always wanted to.
Elements in the backend can be moved using drag and drop and the entire backend is responsive, so you can start modifying your website wherever you are and whatever device you are using.
Every part of the system has been created in such a way as to ease development and to make it easy to extend almost any part of the system. Plugin support is added for any content element and all the parts of the CMS use MVC to show content and bind things together. Lookup our extended documentation pages and you will not regret your choice.

I hope you will have as much fun using Conţinut CMS as I had developing it.

### How do I get set up? ###

1. Git clone the project: `git clone https://pixelplant@bitbucket.org/pixelplant/continut-cms.git`
2. Import the database schema using your favourite MySql client. The sql file is located inside `Sql/schema.sql`
3. Configure the database connection using the MySql username, password and host that you have setup.
4. Access the frontend by calling the file index.php
5. Access the backend by calling the file admin.php

This should be it. **You're good to go** :)

### Contribution guidelines ###

* Code Beautification (for PHPStorm users)
* Other guidelines

### How and with who do I get in touch? ###

* Radu Mogoş (cms@pixelplant.ch)

#### Code Beautification ####

These are some simple rules that I like to follow in order to make sure code looks the same everywhere.

1. Always use Tabs for indentation in the editor, not spaces.
	
2. Always start your namespace at the begining of the file, and end it at the end, like proper namespacing should look like. If you're used to C# then you know what I mean.

	**Bad example:**
			
		namespace Namespace\Test;

		class MyClass {
		...
		}

	

	**Good example:**
	
		namespace Namespace\Test {
		
			class MyClass {
				...
			}
		}
		
#### Other guidelines ####

//TODO