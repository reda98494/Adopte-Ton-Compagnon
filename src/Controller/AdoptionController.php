<?php

namespace App\Controller;

use App\Entity\Adoption;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdoptionController extends AbstractController
{
  /**
   * @Route("/adoptions", name="adoptions")
   */
  public function index(): Response
  {
    $adoptions = $this->getDoctrine()->getRepository(Adoption::class)->findAll();
    return $this->render('adoption/index.html.twig', [
      'adoptions' => $adoptions
    ]);
  }
}
