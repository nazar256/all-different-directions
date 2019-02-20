# All Different Directions
A solution for [kattis problem](PROBLEM.md).

Pure PHP implementation (no external dependencies used). 

It's not designed to be fast as much as possible, but to be easy to read, support and extend.

Tested with PHP 7.2.

[Original problem page][1]

## Test
To run tests execute file Tests/AllDifferentDirectionsTest.php. For example:
```
docker-compose run --rm php php Tests/AllDifferentDirectionsTest.php
```

## Run

You may run with docker like this:

```
docker-compose run --rm php php all-different-directions-cli.php < sample-input.txt
```


[1]: https://open.kattis.com/problems/alldifferentdirections