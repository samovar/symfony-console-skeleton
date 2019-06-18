.PHONY: all
all: build

.PHONY: cs
cs:
	vendor/bin/php-cs-fixer fix

.PHONY: build
build: tests clean cs
	composer install --no-dev
	box compile
	composer install

.PHONY: clean
clean:
	rm -f build/*.phar

.PHONY: tests
tests:
	phpunit

#.PHONY: release
#release: build
#	cp build/app.phar releases/app.phar
#	git add --all
#	git commit -m "New release"
#	git push origin master
