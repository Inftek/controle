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

class JogoCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('number:generate')
            ->setDescription('Generate Number')
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

        $x = 0;
        for( ; ; ) {
            $text = $this->getContainer()->get('number.generate')->generateNumber();

            $io->block($x .' | '. $text, 'OK', 'fg=white;bg=blue', '*', true);

            $x++;
        }

    }



}