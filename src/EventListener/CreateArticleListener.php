<?php

namespace App\EventListener;

use App\Entity\Article;
use Sonata\AdminBundle\Event\PersistenceEvent;
use Psr\Log\LoggerInterface;

class CreateArticleListener {
    
    private LoggerInterface $logger;
    
    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }
    
    public function setDateTime(PersistenceEvent $event): void
    {
        /** @var Article $article */
        $article = $event->getObject();
        if (get_class($article) == Article::class) {
            if (!$article->getDt()) {
                $article->setDt(new \DateTime());
            }
        }
    }
}
