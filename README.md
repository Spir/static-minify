# Static-Minify

Add a CodeIgniter minify controller to handle your static content.

This script is using Minify (currently 2.1.3)
Minify is a PHP5 app that helps you follow several of Yahoo!'s Rules for High Performance Web Sites.
Read more : http://code.google.com/p/minify/

Features:
* compress css/js (or other if wanted) files using Minify script
* cache the compressed file (using Minify cache or Phil's CodeIgniter cache lib, see http://philsturgeon.co.uk/code/codeigniter-cache)
* compress a group of js/css files into one (declare your group of file in config/minify.php


## Installation

1. copy and paste the files : 

Copy and paste config/minify.php to your config directory
Copy and paste controllers/min.php to your controller directory (could be in module if you are using CodeIgniter MX).

Note: you could rename min to whatever you wanted.


2. Set the proper route to handle your static content.

In your config/route.php :

$route['js/(:any)'] = "min/$1";
$route['css/(:any)'] = "min/$1";

3. configure the static-minify config

Open config/minify.php and change the settings to your convenience.

## Improvements

This piece of code could be really improved and is a working draft.
For instance call the propper minify script depending on the file type.
For now I let Minify doing this job.
Also some more config could be set if users want to minify static html, json or some other static content.
One could edit controller/config for that purpose.
