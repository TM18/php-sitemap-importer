## PHP sitemap importer 
[![Build Status](https://travis-ci.org/TM18/php-sitemap-importer.svg?branch=master)](https://travis-ci.org/TM18/php-sitemap-importer)
[![Coverage Status](https://coveralls.io/repos/github/TM18/php-sitemap-importer/badge.svg?branch=master)](https://coveralls.io/github/TM18/php-sitemap-importer?branch=master)

### Author
TM18  
tomasz.matuszewski-93@o2.pl

### How to use
1. Use TM\SitemapImporter:
```php
use TM\SitemapImporter
```
2. Create new SitemapImporter instance and load XML file:
```php
$importer = new SitemapImporter();
$importer->loadFile($pathToXmlFile);
```
3. Fetch websites:
```php
$websites = $importer->getWebsites();

foreach ($websites as $website) {
    echo $website->getName() . ' - ' . $website->getHost() . PHP_EOL;
    foreach ($website->getPages() as $page) {
        echo '--' . $page . PHP_EOL;
    }
}
```

### Tests
To run unit tests run this command from the main directory:
```bash
./vendor/bin/phpunit
```
It will generate a report in clover format in `build/logs/clover.xml`.  
In order to see the coverage in text form in command line pass `--coverage-text` flag:
```bash
./vendor/bin/phpunit --coverage-text
```
