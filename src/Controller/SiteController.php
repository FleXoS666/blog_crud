<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route(name="site_")
 */
class SiteController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index() : Response
    {
        return $this->render('site/index.html.twig');
    }

     /**
     * @Route("/a-propos", name="about")
     */
    public function about() : Response
    {
        return $this->render('site/about.html.twig');
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog(ArticleRepository $articleRepository,PaginatorInterface $paginator, Request $request) : Response
    {

        $articles= $paginator->paginate(
            $articleRepository->findAllPublished(),
            $request->query->get('page', 1),
            5
        );

        // $articles= $paginator->paginate(
        //     $articleRepository->findby(['isActive'=>true], ['createdAt'=> 'DESC']),
        //     $request->query->get('page', 1),
        //     5
        // );
        // $articles = $articleRepository->findAll();

        return $this->render('site/blog/blog.html.twig',[
            'articles' => $articles
        ]);
    }
}
