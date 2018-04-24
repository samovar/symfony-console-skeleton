.PHONY: all
all: build

.PHONY: build
build: tests clean
	composer install --no-dev
	box build
	composer install

.PHONY: clean
clean:
	rm -f build/*.phar

.PHONY: tests
tests:
	phpunit
