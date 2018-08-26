<?php

declare(strict_types=1);

namespace App\Console;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    protected $logo = '
Console application
';

    public function getName()
    {
        $name = parent::getName();

        return $name.PHP_EOL.$this->logo;
    }

    protected function getDefaultCommands()
    {
        return \array_merge(parent::getDefaultCommands(), [
            new Command\RunCommand(),
        ]);
    }
}
