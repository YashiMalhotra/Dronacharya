## spe/01-Simple

**2015-10-15** -- _Copyright (C) 2015-2017 Mark Constable (AGPL-3.0)_

This is the first and simplest project example that demonstrates the
essential core structure for this project series.

We start off on line [5] with a PHP7 declaration of `stict_types` for this
file. Unlike previous versions of PHP, this forces strict type checking on
`int`, `float`, `string`, `bool` and class types for function and method
arguments as well as the return type. Line [7] starts the most important
part of the framework. It has 3 components...

- it contains the only `echo` statement for the entire framework. All output
  to the browser or command line is encapsulated in methods and returned
  as strings and amalgamated to the global `$out` array. There is no "raw"
  (outside of a method or function) code allowed let alone any line by line
  echo statements.

**TODO: complete documentation.**

[5]: https://github.com/markc/spe/blob/master/01-Simple/index.php#L5
[7]: https://github.com/markc/spe/blob/master/01-Simple/index.php#L7
