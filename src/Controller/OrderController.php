<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\ProductRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\Persistence\ObjectManager;

class OrderController extends AbstractController
{

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/order", name="order")
     */
    public function index(CartService $cartService, ProductRepository $productRepository): Response
    {
        return $this->render('order/index.html.twig', [
            "items" => $cartService->getFullCart(),
            "total" => $cartService->getTotal()
        ]);
    }

    /**
     * @Route("/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);

        return $this->redirectToRoute("order");
    }

    /**
     * @Route("/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute('order');
    }


    /**
     * @param CartService $cartService
     * @param ProductRepository $productRepository
     * @Route ("/buy", name="buy")
     */
    public function buy(CartService $cartService, ProductRepository $productRepository)
    {
        $user = $this->security->getUser();
        $total = $cartService->getTotal();
        $order = new Order();
        $order->setUser($user);
        $order->setDate(new \DateTimeImmutable());
        $order->setAmount($total);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($order);
        $manager->flush();

        $cartService->clearCart();

        return $this->render('order/confirm.html.twig', [
            "user"=>$user
        ]);

    }



}
