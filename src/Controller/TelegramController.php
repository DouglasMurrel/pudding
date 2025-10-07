<?php

namespace App\Controller;

use App\Service\TelegramService;
use App\Entity\CharacterOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

#[Route('/telegram', name: 'telegram_')]
class TelegramController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private LoggerInterface $logger,
        private TelegramService $telegramSerice
    )
    {
    }
    
    #[Route(path: '/webhook', name: 'webhook')]
    public function webhook(Request $request): Response
    {
        $message = json_decode($request->getContent());
        $chatId = $message->message->chat->id;
        $text = $message->message->text;
        if ($text == "/list") {
            $orders = $this->em->getRepository(CharacterOrder::class)->findBy([], ['id'=>'DESC']);
            $text = $this->render('telegram/order_list.html.twig', [
                'orders' => $orders
            ]);
        }
        
        $this->telegramSerice->sendMessage($text, $chatId);

        return new Response('OK');
    }
}
