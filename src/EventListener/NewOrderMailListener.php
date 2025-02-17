<?php

namespace App\EventListener;

use App\Event\NewOrderEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Psr\Log\LoggerInterface;

class NewOrderMailListener {
    
    private $mailer;
    private $logger;    
    
    public function __construct(
        MailerInterface $mailer,
        LoggerInterface $logger
    )
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }
    
    public function sendOrderEmail(NewOrderEvent $event)
    {
        $email = (new TemplatedEmail())
                ->from('Пудинг <murrel@yandex.ru>')
                ->to('murrel@yandex.ru')
                ->to('alestein@yandex.ru')
                ->to('arta-ksenia@yandex.ru')
                ->subject('Заявка на Пудинг с омелой')
                ->htmlTemplate('email/order.html.twig')
                ->context([
                    'order' => $event->getOrder()
                ])
        ;

        $this->mailer->send($email);
    }
    
}
