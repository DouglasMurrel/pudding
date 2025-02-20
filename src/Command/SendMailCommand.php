<?php

namespace App\Command;

use App\Entity\CharacterOrder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

#[AsCommand(name: 'my:resend:orders')]
class SendMailCommand extends Command {
    private EntityManagerInterface $em;
    private MailerInterface $mailer;

    public function __construct(EntityManagerInterface $em, MailerInterface $mailer) 
    {
        $this->em = $em;
        $this->mailer = $mailer;
        parent::__construct();
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $orders = $this->em->createQueryBuilder()
                ->select('c')
                ->from(CharacterOrder::class, 'c')
                ->where('c.id<6')
                ->getQuery()
                ->getResult()
        ;
        foreach ($orders as $order) {
            $email = (new TemplatedEmail())
                    ->from('Пудинг <murrel@yandex.ru>')
                    ->to('murrel@yandex.ru')
                    ->subject('Заявка на Пудинг с омелой')
                    ->htmlTemplate('email/order.html.twig')
                    ->context([
                        'order' => $order
                    ])
            ;
            $this->mailer->send($email);
        }
        return Command::SUCCESS;
    }
}
