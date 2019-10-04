<?php

declare(strict_types=1);

namespace Tests\App\Console\Command;

use App\Console\Application;
use App\Console\Command\RunCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class RunCommandTest extends TestCase
{
    public function testRunCommand(): void
    {
        $application = new Application(\dirname(__DIR__, 3));

        $application->add(new RunCommand());

        $command = $application->find('run');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('Hello "%username%"!', $output);
    }
}
