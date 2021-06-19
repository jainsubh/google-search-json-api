# Google Custom Search Engine
Laravel package provide Google Custom Search JSON and Restricted JSON API lets you develop websites and applications to retrieve and display search results from Programmable Search Engine programmatically.

## Package Installation

Add `jainsubh/google-search-json-api` to `composer.json`.
```
"jainsubh/google-search-json-api": "~1.0.1"
```

Run `composer update` to pull down the latest version.

Or run
```
composer require jainsubh/google-search-json-api
```

Now open up `/config/app.php` and add the service provider to your `providers` array.
```php
'providers' => [
    jainsubh\GoogleSearchApi\GoogleSearchApiProvider::class,
]
```

Now add the alias.
```php
'aliases' => [
    'GoogleSearchApi' => jainsubh\GoogleSearchApi\Facades\GoogleSearchApi::class,
]
```

## Configuration 

Run `php artisan vendor:publish --provider="jainsubh\GoogleSearchApi\GoogleSearchApiProvider"` and modify the config file with your own information.
```
/config/googlesearchapi.php
```
With Laravel 5, it's simple to edit the config.php file - in fact you don't even need to touch it! Just add the following to your .env file and you'll be on your way:
```
GOOGLE_SEARCH_ENGINE_ID=
GOOGLE_SEARCH_API_KEY=
```

### How to get Search Engine ID
1. If you create your engine at https://cse.google.com/cse/ you will find the ID after you click at Settings
2. Just check the URL you have like https://cse.google.com/cse/setup/basic?cx=search_engine_id and the string after cx= is your search engine ID
     
!! Attention !! If you change style of your Custom search engine, the ID can be changed

### Get your Google API key
1. go to https://console.developers.google.com, than
2. click on the menu on the right side of the GoogleAPI logo and click on 'Create project'
3. enter the name of the new project - it is up to you, you can use 'Google CSE'
4. wait until project is created - the indicator is color circle on the top right corner around the bell icon
5. API list is shown - search for 'Google Custom Search API' and click on it
6. click on 'Enable' icone on the right side of Custom Search API headline
7. click on the 'Credentials' on the left menu under the 'Library' section
8. click on the 'Create credentials' and choose 'API key'
9. your API key is shown, so copy and paste it here

## Usage

### Simple usage
Create an object and call the function getResults to get first 10 results
```php
$googleSearch = new GoogleSearchApi(); // initialize

$results = $googleSearch->getResults('some phrase'); // get first 10 results for query 'some phrase' 
```

#### Do not forget to map namespace with, so sample controller will look like this (in min. way)
It is only example controller name, you can use whatever you want, this is notice mainly for novices in Laravel
```php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use jainsubh\GoogleSearchApi\GoogleSearchApi;

class GoogleSearchController extends Controller {
    
    public function index() {
        $googleSearch = new GoogleSearchApi(); // initialize

        $results = $googleSearch->getResults('some phrase'); // get first 10 results for query 'some phrase'// 
    }
}
```

You can also get information about the search like total records and search time
```php
$googleSearch = new GoogleSearchApi(); // initialize

$results = $googleSearch->getResults('some phrase'); // get first 10 results for query 'some phrase' 
$info = $googleSearch->getSearchInformation(); // get search information
```

### Advanced usage
You can use any parameter supported at Google. List of parameters is here:
https://developers.google.com/custom-search/json-api/v1/reference/cse/list#parameters

E.g. you want to get next 10 results
```php
$parameters = array(
    'start' => 10, // start from the 10th results,
    'num' => 10 // number of results to get, 10 is maximum and also default value
);

$search_type = 'site_restrict'// if empty by default Google Custom Search JSON API would work

$googleSearch = new GoogleSearchApi(); // initialize

$results = $googleSearch->getResults('some phrase', $parameters, $search_type); // get second 10 results for query 'some phrase'
```

You can also get the raw result from Google including other information
Full list of response variables is available here:
https://developers.google.com/custom-search/json-api/v1/reference/cse/list#response
```php
$googleSearch = new GoogleSearchApi(); // initialize

$results = $googleSearch->getResults('some phrase'); // get first 10 results for query 'some phrase'
$rawResults = $googleSearch->getRawResults(); // get complete response from Google
```

For getting the number of results only use
```php
$googleSearch = new GoogleSearchApi(); // initialize

$results =  $googleSearch->getResults('some phrase'); // get first 10 results for query 'some phrase'
$noOfResults = $googleSearch->getTotalNumberOfResults(); // get total number of results (it can be less than 10)
```

If you have more engines / more api keys, you can override the config variables with following functions

```php
$googleSearch = new GoogleSearchApi(); // initialize

$googleSearch->setEngineId('someEngineId'); // sets the engine ID
$googleSearch->setApiKey('someApiId'); // sets the API key

$results =  $googleSearch->getResults('some phrase'); // get first 10 results for query 'some phrase'
```
