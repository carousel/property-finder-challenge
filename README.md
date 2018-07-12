# Cardboards (trip formatter) application (property finder challenge)
miroslav.trninic@gmail.com

## Technology stack
* PHP7.2 (CLI)
* Composer package manager/autoloader
* monolog PHP library (for error loggins)

## Run
* from the CLI run php index.php main front controller for the scripts

## Overview
Starting point is randomizer (Trip\Tools\Randomizer) class which will take random set of data (src/data.php). This set of data will be shuffled and 
combined after every call. Set is made of cities list, transport, gates, ports, baggage, overseas properties. There is limit fields that limits number of possible paths. 
Since number of paths is increased rapidly after every call (graph traversal) it is recommended to limit trip to max 5 cities. Distance calculator class (Trip\Tools\DistanceCalculator) is used to calcualate distance between pairs of destination. Is is commented in build method. If not commented, it will call external distance api and display result int the form of: 

    `departure -> distance -> arrival`

Next, after data is prepared it is combined and displayed on CLI (basic formatting). index.php is used as front-controller and contains calls to all classes needed to display output. There is also basic PHPUnit test,for the proof of concept

Note that this is not optimized in any way and there are lots of loops and nested conditionals that are heavy in algorithmic sense. All code is just for the purpose of code challenge. Also, in reald world application, procedural code should be replaced with more OO and domain specific implementation.
Multiple things can be improved (from tests, optimization, dockerization, better code structure ...)
