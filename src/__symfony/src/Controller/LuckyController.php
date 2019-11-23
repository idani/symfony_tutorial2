<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LuckyController extends AbstractController
{

    public function index()
    {
        // redirects to the "homepage" route
        return $this->redirectToRoute('homepage');

        // redirectToRoute is a shortcut for:
        // return new RedirectResponse($this->generateUrl('homepage'));

        // does a permanent - 301 redirect
        return $this->redirectToRoute('homepage', [], 301);

        // redirect to a route with parameters
        return $this->redirectToRoute('app_lucky_number', ['max' => 10]);

        // redirects to a route and maintains the original query string parameters
        return $this->redirectToRoute('blog_show', $request->query->all());

        // redirects externally
        return $this->redirect('http://symfony.com/doc');
    }

    /**
     * @Route("/lucky/number/{max}", name="app_luck_number", requirements={"max"="\d+"})
     *
     * @return void
     */
    public function number(int $max = 100, LoggerInterface $logger)
    {
        $logger->info('We are logging!!');
        $number = random_int(0, $max);

        return $this->render('lucky/number.html.twig', ['number' => $number]);
    }
}
