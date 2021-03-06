<?php

namespace Spatie\EventServer\Console\Commands;

use Spatie\EventServer\Container;
use Spatie\EventServer\Server\Server;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServerCommand extends Command
{
    private Server $server;

    public function __construct(Server $server)
    {
        parent::__construct('server');

        $this->server = $server;

        $this->addOption('clean');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('clean')) {
            Container::make()->eventStore()->clean();

            $output->writeln('<error>Event log cleaned</error>');
        }

        $this->server->run();

        return 0;
    }
}
