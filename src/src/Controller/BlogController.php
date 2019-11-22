<?php

// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_list")
     */
    public function list()
    {
        // ...
    }

    /**
     * @Route("/api/posts/{id}", methods={"GET", "HeAD"})
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    { }

    /**
     * @Route("/api/posts/{id}", methods={"PUT"})
     *
     * @param integer $id
     * @return void
     */

    public function edit(int $id)
    { }
}
