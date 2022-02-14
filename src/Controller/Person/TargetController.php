<?php

namespace App\Controller\Person;

use App\Entity\Target;
use App\Form\TargetType;
use App\Repository\TargetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/target')]
class TargetController extends AbstractController
{
    #[Route('/', name: 'app_target')]
    public function index(TargetRepository $targetRepo): Response
    {
        $targets = $targetRepo->findAll();

        return $this->render('target/index.html.twig',[
            'targets' => $targets
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_target_show', methods:'GET')]
    public function show(Target $target): Response
    {    
    
        return $this->render('target/show.html.twig',[
            'target' => $target
        ]);
    }

    #[Route('/create', name: 'app_target_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $target = new Target;

        $form = $this->createForm(TargetType::class,$target);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($target);
            $em->flush();

            return $this->redirectToRoute('app_target');
        }
        return $this->render('target/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_target_edit', methods:['GET','PUT'])]
    public function edit(Request $request,Target $target, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(TargetType::class, $target,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();

            return $this->redirectToRoute('app_target');
        }
        return $this->renderForm('target/edit.html.twig',[
            'target' => $target,
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_target_delete', methods:'DELETE')]
    public function delete(Request $request,Target $target, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('target_delete_',$submittedToken )) {

        $em->remove($target);
        $em->flush();

        return $this->redirectToRoute('app_target');
        

    }
    
    }
}
