<?php

namespace App\Controller;

use App\Entity\CharacterOrder;
use App\Form\Type\CharacterOrderType;
use App\Event\NewOrderEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class OrderController extends AbstractController
{
    private $em;
    private $logger;
    private $dispatcher;
    
    public function __construct(
        EntityManagerInterface $em,
        LoggerInterface $logger,
        EventDispatcherInterface $dispatcher
    )
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->dispatcher = $dispatcher;
    }
    
    #[Route(path: '/order', name: 'order', priority: 1)]
    public function order(Request $request): Response
    {
        $characterOrder = new CharacterOrder();
        $form = $this->createForm(CharacterOrderType::class, $characterOrder);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $characterOrder = $form->getData();
            $this->em->persist($characterOrder);
            $this->em->flush();
            
            $event = new NewOrderEvent($characterOrder);
            $this->dispatcher->dispatch($event);
            
            return $this->render('order_sent.html.twig');
        }
        return $this->render('order.html.twig', [
            'form' => $form,
        ]);
    }
}
