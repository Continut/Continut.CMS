# Code Beautification #

These are some simple rules that I like to follow in order to make sure code looks the same everywhere.

1. Always use Tabs for indentation in the editor, not spaces.

	![PHPStorm Tab Settings](..\Images\ReadmeTabs.png)
	
2. Always start your namespace at the begining of the file, and end it at the end, like proper namespacing should look like. If you're used to C# then you know what I mean.

	**Bad example:**

	```php
		
		namespace Namespace\Test;

		class MyClass {
		...
		}

	```

	**Good example:**
	
	```php

		namespace Namespace\Test {
		
			class MyClass {
				...
			}
		}

	```