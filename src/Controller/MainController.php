<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class MainController extends AbstractController
{
    private $em;
    private $logger;
    
    public function __construct(
        EntityManagerInterface $em,
        LoggerInterface $logger
    )
    {
        $this->em = $em;
        $this->logger = $logger;
    }
    
    #[Route(path: '/', name: 'main')]
    #[Route(path: '/{slug}', name: 'main_slug')]
    public function show(?string $slug): Response
    {
        if (!$slug) {
            $slug = '';
        }
        /** @var Article $article */
        $article = $this->em->getRepository(Article::class)->findOneBy(['slug'=>$slug]);
        if (!$article || !$article->isVisible()) {
        return $this->render('NotFound.html.twig');
        }
        $links = [];
        /** @var Article $curArticle */
        $curArticle = $article;
        $root = $article->getRoot();
        while ($curArticle != $root) {
            if ($curArticle->isVisible()) {
                $links[] = [
                    'title' => $curArticle->getTitle(),
                    'link' => $curArticle->getSlug() ?
                    $this->generateUrl('main_slug', ['slug' => $curArticle->getSlug()]) :
                    $this->generateUrl('main')
                ];
            }
            $curArticle = $curArticle->getParent();
        }
        return $this->render('article.html.twig',[
            'article'=>$article,
            'links'=>$links,
        ]);
    }
}
