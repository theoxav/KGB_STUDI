<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/country')]
#[IsGranted("ROLE_ADMIN")]
class CountryController extends AbstractController
{
    #[Route('/', name: 'app_country')]
    public function index(CountryRepository $countryRepo): Response
    {
        $countries = $countryRepo->findBy([],['name' => 'ASC']);

        return $this->render('country/index.html.twig',[
            'countries' => $countries
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_country_show', methods:'GET')]
    public function show(Country $country): Response
    {    
    
        return $this->render('country/show.html.twig',[
            'country' => $country
        ]);
    }

    #[Route('/create', name: 'app_country_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $country = new Country;

        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute('app_country');
        }
        return $this->renderForm('country/create.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_country_edit', methods:['GET','PUT'])]
    public function edit(Request $request,Country $country, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(CountryType::class, $country,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();

            return $this->redirectToRoute('app_country');
        }
        return $this->renderForm('country/edit.html.twig',[
            'country' => $country,
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_country_delete', methods:'DELETE')]
    public function delete(Request $request,Country $country, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('country_delete_',$submittedToken )) {

        $em->remove($country);
        $em->flush();

        return $this->redirectToRoute('app_country');
        

    }
    
    }
}
