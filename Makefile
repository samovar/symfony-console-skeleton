.PHONY: all
all: build

.PHONY: build
build: tests clean
	composer install --no-dev
	box compile
	composer install

.PHONY: clean
clean:
	rm -f build/*.phar

.PHONY: tests
tests:
	phpunit

.PHONY: release
release: build
	cp build/kr-repository-tools.phar releases/kr-repository-tools.phar
	git add --all
	git commit -m "New release"
	git push origin master
