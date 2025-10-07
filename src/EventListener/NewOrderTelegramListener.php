<?php

namespace App\EventListener;

use App\Event\NewOrderEvent;
use App\Service\TelegramService;
use Twig\Environment as Twig;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class NewOrderTelegramListener {
    
    public function __construct(
            private TelegramService $telegramService,
            private Twig $templating,
            private ParameterBagInterface $parameterBag
    ) {
    }
    
    public function sendOrderTelegram(NewOrderEvent $event) {
        $message = $this->templating->render('telegram/order.html.twig',[
            'order' => $event->getOrder()
        ]);
        $chatIds = $this->parameterBag->get('telegram_chat_id');
        $chatIdArray = explode(',', $chatIds);
        foreach ($chatIdArray as $chatId) {
            $this->telegramService->sendMessage($message, $chatId);
        }
    }
}
