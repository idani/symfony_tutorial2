<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    // public function index()
    // {
    //     return $this->render('product/index.html.twig', [
    //         'controller_name' => 'ProductController',
    //     ]);
    // }

    /**
     * @Route("/product", name="create_product")
     *
     * @return Response
     */
    public function createProduct(ValidatorInterface $validator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setName('javas');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $entityManager->persist($product);
        $entityManager->flush();

        return new Response('Saved new product with id ' . $product->getId());
    }

    /**
     * @Route("/product/{id}", name="product_show")
     *
     * @param integer $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $this->addFlash('notice', 'テストフラッシュ');
        // return new Response('Check out this great product: ' . $product->getName());
        return $this->render('lucky/number.html.twig', ['number' => $product->getName()]);
    }


    /**
     * @Route("/product/edit/{id}")
     *
     * @param integer $id
     * @return void
     */
    public function update(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $product->setName('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }

    /**
     * @Route("/product/delete/{id}")
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return new Response('delete this great product: ' . $product->getName());
    }
}
