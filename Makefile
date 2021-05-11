.PHONY: install qa cs csf phpstan tests coverage-clover coverage-html

install:
	composer update

qa:
	vendor/bin/linter src tests

phpstan:
	vendor/bin/phpstan analyse -l 1 -c phpstan.neon src

tests:
	vendor/bin/tester -s -p php --colors 1 -C tests/cases

coverage-clover:
	vendor/bin/tester -s -p php --colors 1 -C -d extension=xdebug.so --coverage ./coverage.xml --coverage-src ./src tests/cases

coverage-html:
	vendor/bin/tester -s -p php --colors 1 -C -d extension=xdebug.so --coverage ./coverage.html --coverage-src ./src tests/cases
