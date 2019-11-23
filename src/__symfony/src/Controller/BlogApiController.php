<?php

// src/Controller/BlogApiController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogApiController extends AbstractController
{
    /**
     * @Route("/api/posts/{id}", methods={"GET","HEAD"})
     */
    public function show(int $id)
    {
        // ... return a JSON response with the post
        return $this->render('lucky/number.html.twig', ['number' => __FILE__ . '(' . __LINE__ . '):' . __FUNCTION__ . ':id=' . $id]);
    }

    /**
     * @Route("/api/posts/{id}", methods={"PUT"})
     */
    public function edit(int $id)
    {
        // ... edit a post
        return $this->render('lucky/number.html.twig', ['number' => __FILE__ . '(' . __LINE__ . '):' . __FUNCTION__ . ':id=' . $id]);
    }
}
