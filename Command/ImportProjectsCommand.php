<?php

namespace Developtech\AgilityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportProjectsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('developtech:agility:import-projects')
            ->setDescription('Import projects from an external source')
            ->addOption(
                'source',
                's',
                InputOption::VALUE_REQUIRED,
                'The imported projects source'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = $input->getOption('source');
        if (!in_array($source, $this->container->getParameter('developtech_agility.available_api'))) {
            throw new \InvalidArgumentException('The given source is not available');
        }

        $gateway = $this->container->get("developtech_agility.{$source}_gateway");

        $gateway->authenticate();
    }
}
