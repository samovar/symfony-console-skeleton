<?php

declare(strict_types=1);

namespace App\Console\Command;

use App\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class InitCommand extends BaseCommand
{
    protected static $defaultName = 'init';

    protected function configure(): void
    {
        // no call parent

        $this
            ->addOption('filename', 'f', InputOption::VALUE_OPTIONAL, \sprintf('Configuration filename. Default "%s"', Application::CONFIG_DIST_FILENAME))
            ->setDescription('Initialize configuration')
            ->setHelp(<<<'EOF'
<info>php %command.full_name%</info>
EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var Application $app */
        $app = $this->getApplication();

        $filename = \sprintf('%s/%s', $app->getRootDir(), Application::CONFIG_DIST_FILENAME);

        if (null === $targetFile = $input->getOption('filename')) {
            $targetFile = Application::CONFIG_DIST_FILENAME;
        }

        $filesystem = new Filesystem();
        $filesystem->copy($filename, $targetFile);

        $this->io->success(\sprintf('Configuration created "%s"', $targetFile));

        return 0;
    }
}
