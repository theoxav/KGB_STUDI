<?php

namespace App\Controller;

use App\Entity\HideoutType;
use App\Form\TypeHideoutsType;
use App\Repository\HideoutTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/hideout')]
class HideoutTypeController extends AbstractController
{
    #[Route('/', name:'app_hideout_type')]
    public function index(HideoutTypeRepository $hideoutTypeRepo): Response
    {
        $hideouts = $hideoutTypeRepo->findAll();

        return $this->render('hideout_type/index.html.twig',[
            'hideouts_type' => $hideouts
        ]);
    }

     #[Route('/{id<[0-9]+>}', name: 'app_hideout_type_show', methods:'GET')]
    public function show(HideoutType $hideoutType): Response
    {    
    
        return $this->render('hideout_type/show.html.twig',[
            'hideout_type' => $hideoutType
        ]);
    }

    #[Route('/create', name: 'app_hideout_type_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $hideoutType = new HideoutType;

        $form = $this->createForm(TypeHideoutsType::class, $hideoutType);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($hideoutType);
            $em->flush();

            return $this->redirectToRoute('app_hideout_type');
        }
        return $this->renderForm('hideout_type/create.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_hideout_type_edit', methods:['GET','PUT'])]
    public function edit(Request $request,HideoutType $hideoutType, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(TypeHideoutsType::class, $hideoutType,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();

            return $this->redirectToRoute('app_hideout_type');
        }
        return $this->renderForm('hideout_type/edit.html.twig',[
            'hideout_type' => $hideoutType,
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_hideout_type_delete', methods:'DELETE')]
    public function delete(Request $request,HideoutType $hideoutType, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('hideout_type_delete_',$submittedToken )) {

        $em->remove($hideoutType);
        $em->flush();

        return $this->redirectToRoute('app_hideout_type');
        
    }
 }
 
}
