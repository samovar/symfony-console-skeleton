<?php

declare(strict_types=1);

namespace App\Console;

use App\DependencyInjection\AppExtension;
use Psr\Container\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application extends BaseApplication
{
    public const CONFIG_DIST_FILENAME = 'config.yaml';

    protected $logo = '
Console application
';

    /**
     * @var string
     */
    private $rootDir;

    /**
     * @var ContainerInterface|null
     */
    private $container;

    public function __construct(string $rootDir, string $name = 'UNKNOWN', string $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);
        $this->rootDir = $rootDir;
    }

    public function getVersion(): string
    {
        return '@git_commit_short@';
    }

    public function getName(): string
    {
        $name = parent::getName();

        return $name.PHP_EOL.$this->logo;
    }

    public function loadConfiguration(?string $configFile): void
    {
        if (null !== $this->container) {
            return;
        }

        $this->container = new ContainerBuilder();

        $loader = new DelegatingLoader(new LoaderResolver([
            new YamlFileLoader($this->container, new FileLocator(null === $configFile ? $this->rootDir : '.')),
        ]));

        $this->container->registerExtension(new AppExtension());

        if (null === $configFile) {
            $configFile = static::CONFIG_DIST_FILENAME;
        }

        try {
            $loader->load($configFile);
        } catch (\Exception $e) {
            throw new \LogicException(\sprintf('Load configuration failed "%s"', $e->getMessage()), $e->getCode(), $e);
        }

        $this->container->compile();
    }

    public function getContainer(): ContainerInterface
    {
        if (null === $this->container) {
            $this->loadConfiguration(null);
        }

        return $this->container;
    }

    /**
     * @return string
     */
    public function getRootDir(): string
    {
        return $this->rootDir;
    }

    protected function getDefaultCommands(): array
    {
        return \array_merge(parent::getDefaultCommands(), [
            new Command\InitCommand(),
            new Command\RunCommand(),
        ]);
    }
}
