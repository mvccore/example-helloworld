# MvcCore - Example - Hello World
Basic MVC application and packaging demonstration.

## Features
- all packing ways are possible to use:
	- PHAR
	- PHP
		- strict package (currently used for packed app in result dir)
		- strict hdd
		- preserve package
		- preserve hdd

## Instalation
```shell
# load project
composer require mvccore/example-helloworld

# update dependencies for packing
composer update

# go to development directory
cd development

# update dependencies for application sources
composer update
```

## Build
```shell
sh make.sh
# or Windows:
make.cmd
```

