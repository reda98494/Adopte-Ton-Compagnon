<?php

namespace App\Controller;

use App\Entity\Adoption;
use App\Entity\Animal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\Persistence\ObjectManager;

class AnimalController extends AbstractController
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
   * @Route("/animals", name="animals")
   */
  public function index(): Response
  {
    $animals = $this->getDoctrine()->getRepository(Animal::class)->findAll();
    return $this->render('animal/index.html.twig', [
      'animals' => $animals
    ]);
  }

  /**
   * @Route("/adopt/{id}", name="adopt")
   */
  public function adopt($id): Response
  {
    $animal = $this->getDoctrine()->getRepository(Animal::class)->find($id);
    $adoption= new Adoption();
    $adoption->setAnimal($animal);
    $user = $this->security->getUser();
    $adoption->setUser($user);
    $adoption->getAnimal()->setAdoptedStatus(true);
    $adoption->setDate(new \DateTimeImmutable());
    $manager = $this->getDoctrine()->getManager();
    $manager->persist($adoption);
    $manager->flush();
    return $this->render("animal/adopt.html.twig", [
      "animal" => $animal,
      "user" => $user
    ]);
  }
}
