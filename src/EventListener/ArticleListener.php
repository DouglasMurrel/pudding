<?php

namespace App\EventListener;

use App\Entity\Article;
use Sonata\AdminBundle\Event\PersistenceEvent;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\UnitOfWork;
use Doctrine\ORM\Event\OnFlushEventArgs;

class ArticleListener {
    
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
            $this->logger->info($article->getParent());
        }
    }
    
    public function onFlush(OnFlushEventArgs $eventArgs): void
    {
        $em = $eventArgs->getObjectManager();
        /** @var UnitOfWork $uow */
        $uow = $em->getUnitOfWork();

        $updates = $uow->getScheduledEntityUpdates();

        foreach ($updates as $article) {
            if (
                $article instanceof Article
            ) {
                $changes = $uow->getEntityChangeSet($article);
                if (isset($changes['parent']) && $changes['parent'][1]) {
                    $oldParent = $changes['parent'][0];
                    $newParent = $changes['parent'][1];
                    if ($newParent) {
                        $root = $article->getRoot();
                        $left = $article->getLft();
                        $right = $article->getRgt();
                        $parentRoot = $newParent->getRoot();
                        $parentLeft = $newParent->getLft();
                        $parentRight = $newParent->getRgt();
                        if ($root === $parentRoot && $parentLeft >= $left && $parentRight <= $right) {
                            $article->setParent($oldParent);
                            $uow->recomputeSingleEntityChangeSet($em->getClassMetadata(Article::class), $article);
                        }
                    }
                }
                /*
                if (isset($changes['isDeleted']) && !$changes['isDeleted'][0] && $changes['isDeleted'][1]) {
                    $this->removeBookmarkForModel($model->getId());
                    if (is_object($user = $this->security->getUser())) {
                        $conn = $this->em->getConnection();
                        $stmt_model = $conn->prepare("update models set who_deleted=:userId where id=:id");
                        $stmt_model->execute(['userId' => $user->getId(), 'id' => $model->getId()]);
                    }
                }
                if (isset($changes['isVisible']) && $changes['isVisible'][0] && !$changes['isVisible'][1]) {
                    $this->removeBookmarkForModel($model->getId());
                }
                if (isset($changes['isModerated']) && $changes['isModerated'][0] && !$changes['isModerated'][1]) {
                    $this->removeBookmarkForModel($model->getId());
                }
                 */
            }
        }
    }
}
