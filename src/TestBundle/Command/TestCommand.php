<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 26/03/16
 * Time: 19:40
 */

namespace TestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('test:bundle')
            ->setDescription('Command for my TestBundle')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Tem certeza disso manolo ?'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'Poe a parada em maisculo'
            )
            ->addOption(
                'number',
                null,
                InputOption::VALUE_NONE,
                'Coloca numeros no ffinal da string'
            )->addOption(
                'limit',
                null,
                InputOption::VALUE_NONE,
                'Impoe um limite'
            );

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name');

        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }

        if($input->getOption('number')){
            $text .= rand(1,100);
            //$text .= $this->listarNUmber(2000);
        }


/*        $io->progressStart();

        $io->text($text);

        for($x=0; $x <=100; $x++) {
            $io->progressAdvance($x);
            sleep(1);
        }
        $io->progressFinish();*/

/*        $io->comment('Comment');
        $io->error('Error');
        $io->success('Sucess');
        $io->note('Note');
        $io->warning('Warning');
        $io->section('Section');
        $io->block('Block');*/

        $io->block($text,'OK', 'fg=white;bg=blue', '*', true);


        //$output->writeln($text);

    }


    private function listarNUmber($limit)
    {
        $x = 0;
        for( ; ; ){
            echo $x,PHP_EOL;
            $x++;
            if($limit == $x){
                break;
            }
        }
    }

}