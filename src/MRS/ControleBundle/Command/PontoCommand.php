<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 26/03/16
 * Time: 19:40
 */

namespace MRS\ControleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PontoCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('ponto:register')
            ->setDescription('Command for Register Ponto')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Registrar Ponto ?'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'Poe a parada em maisculo'
            );

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $text = $this->getContainer()
             ->get('horario.register')
             ->registerHorario();

        $io->block($text,'OK', 'fg=white;bg=blue', '*', true);


        //$output->writeln($text);

    }

}