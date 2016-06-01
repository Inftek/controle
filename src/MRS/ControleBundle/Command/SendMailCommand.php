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

class SendMailCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('swiftmailer:sendmail')
            ->setDescription('Command to send mail test')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'A new Email to receive'
            );

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $Message = \Swift_Message::newInstance();
        $Message->setFrom('marcio.santos@ceadis.org.br')
                ->setTo('marcio.santos@ceadis.org.br')
                ->setSubject('Titulo do Email')
                ->setBody('Teste de email sendo enviado');

        $name = $input->getArgument('name');

        if($name){
            $Message->addTo($name);
        }


        $result = $this->getContainer()->get('send.message')->send($Message);

        if($result){
            $io->block('E-mail enviado com sucesso!','', 'fg=white;bg=blue', '*', true);
            $io->block('De: ' . $Message->getFrom() .' Para' . $Message->getTo(),'*', 'fg=white;bg=blue', '*', true);
        }else{
            $io->block('Houve um erro ao tentar enviar!','', 'fg=white;bg=blue', '*', true);
        }


        //$output->writeln($text);

    }



}