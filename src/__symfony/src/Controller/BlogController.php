<?php

// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="blog_index")
     *
     * @return void
     */
    public function index()
    {}

    /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     */
    public function list(int $page)
    {
        // return $this->render('lucky/number.html.twig', ['number' => __FILE__ . '(' . __LINE__ . '):' . __FUNCTION__ . ' page:' . $page]);
        return $this->render('blog/list.html.twig', ['blog_posts' => [], 'articles' => []]);
    }


    /**
     * @Route("/blog/{slug}", name="blog_show")
     *
     * @param string $slug
     * @return void
     */
    public function show(string $slug)
    {
        return $this->render('lucky/number.html.twig', ['number' => __FILE__ . '(' . __LINE__ . '):' . __FUNCTION__ . ':slug=' . $slug]);
    }
}
