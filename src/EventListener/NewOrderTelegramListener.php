<?php

namespace App\EventListener;

use App\Event\NewOrderEvent;
use App\Service\TelegramService;
use Twig\Environment as Twig;

class NewOrderTelegramListener {
    
    public function __construct(
            private TelegramService $telegramService,
            private Twig $templating
    ) {
    }
    
    public function sendOrderTelegram(NewOrderEvent $event) {
        $message = $this->templating->render('telegram/order.html.twig',[
            'order' => $event->getOrder()
        ]);
        $this->telegramService->sendMessage($message);
    }
}
