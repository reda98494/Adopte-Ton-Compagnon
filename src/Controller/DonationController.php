<?php

namespace App\Controller;

use App\Entity\Donation;
use App\Form\DonationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DonationController extends AbstractController
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
     * @Route("/donations", name="donations")
     */
    public function index(Request $request): Response
    {
        $donations = $this->getDoctrine()->getRepository(Donation::class)->findAll();
        return $this->render('donation/index.html.twig', [
            'donations' => $donations
        ]);
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/makeDonation", name="makeDonation")
     */
    public function makeDonation(Request $request)
    {

        $don=new Donation();

        $form = $this->createForm(DonationType::class, $don);
        $form->handleRequest($request);

        $user = $this->security->getUser();

        if($form->isSubmitted() && $form->isValid()){
            $don = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $don->setDate(new \DateTimeImmutable());
            $don->setUser($user);

            $manager->persist($don);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre article a bien été créé'
            );
            return $this->redirectToRoute("donations");
        }
        return  $this->render('donation/make_donation.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
