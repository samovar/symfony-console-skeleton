<?php

declare(strict_types=1);

namespace App\Console\Command;

use App\Console\Application;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class BaseCommand extends Command
{
    /**
     * @var SymfonyStyle
     */
    protected $io;

    /**
     * @var ContainerInterface
     */
    protected $container;

    protected function configure(): void
    {
        $this->addOption('config', 'c', InputOption::VALUE_OPTIONAL, 'Configuration file');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);

        $configFile = null;
        if ($input->hasOption('config')) {
            $configFile = $input->getOption('config');
        }

        /** @var Application $application */
        $application = $this->getApplication();

        $application->loadConfiguration($configFile);

        $this->container = $application->getContainer();
    }

    protected function getService(string $id)
    {
        return $this->container->get($id);
    }

    protected function getParameter(string $id)
    {
        return $this->getService(ParameterBagInterface::class)->get($id);
    }
}
