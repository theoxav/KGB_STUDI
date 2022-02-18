<?php

namespace App\Controller;

use App\Entity\Hideout;
use App\Form\HideoutType;
use App\Form\HidewayType;
use App\Repository\HideoutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/hideout')]
#[IsGranted("ROLE_ADMIN")]
class HideoutController extends AbstractController
{
    #[Route('/', name: 'app_hideout')]
    public function index(HideoutRepository $hideoutRepo): Response
    {
        $hideouts = $hideoutRepo->findAll();

        return $this->render('hideout/index.html.twig',[
            'hideouts' => $hideouts
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_hideout_show', methods:'GET')]
    public function show(Hideout $hideout): Response
    {    
    
        return $this->render('hideout/show.html.twig',[
            'hideout' => $hideout
        ]);
    }

    #[Route('/create', name: 'app_hideout_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $hideout = new Hideout;

        $form = $this->createForm(HidewayType::class, $hideout);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($hideout);
            $em->flush();

            $this->addFlash('success', 'Hideout successfully created'  );

            return $this->redirectToRoute('app_hideout');
        }
        return $this->renderForm('hideout/create.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_hideout_edit', methods:['GET','PUT'])]
    public function edit(Request $request,Hideout $hideout, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(HidewayType::class, $hideout,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();

            $this->addFlash('success', 'Hideout successfully updated'  );

            return $this->redirectToRoute('app_hideout');
        }
        return $this->renderForm('hideout/edit.html.twig',[
            'hideout' => $hideout,
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_hideout_delete', methods:'DELETE')]
    public function delete(Request $request,Hideout $hideout, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('hideout_delete_',$submittedToken )) {

        $em->remove($hideout);
        $em->flush();

        $this->addFlash('success', 'Hideout successfully deleted'  );

        return $this->redirectToRoute('app_hideout');
        

    }
    
    }
}
