<?php

declare(strict_types=1);

namespace App\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunCommand extends Command
{
    protected function configure(): void
    {
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
        $io = new SymfonyStyle($input, $output);
        $io->text('Hello!');

        return 0;
    }
}
