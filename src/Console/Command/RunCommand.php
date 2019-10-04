<?php

declare(strict_types=1);

namespace App\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends BaseCommand
{
    protected function configure(): void
    {
        parent::configure();

        $this
            ->setName('run')
            ->setDescription('Run command')
            ->setHelp(<<<'EOF'
<info>php %command.full_name%</info>
EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $this->getParameter('name');

        $this->io->writeln(\sprintf('Hello "%s"!', $name));

        return 0;
    }
}
