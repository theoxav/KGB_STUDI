<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/skill')]
class SkillController extends AbstractController
{
    #[Route('/', name: 'app_skill')]
    public function index(SkillRepository $skillRepo): Response
    {
        $skills = $skillRepo->findAll();

        return $this->render('skill/index.html.twig',[
            'skills' => $skills
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_skill_show', methods:'GET')]
    public function show(Skill $skill): Response
    {    
    
        return $this->render('skill/show.html.twig',[
            'skill' => $skill
        ]);
    }

    #[Route('/create', name: 'app_skill_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $skill = new Skill;

        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('app_skill');
        }
        return $this->renderForm('skill/create.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_skill_edit', methods:['GET','PUT'])]
    public function edit(Request $request,Skill $skill, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(SkillType::class, $skill,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();

            return $this->redirectToRoute('app_skill');
        }
        return $this->renderForm('skill/edit.html.twig',[
            'skill' => $skill,
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_skill_delete', methods:'DELETE')]
    public function delete(Request $request,Skill $skill, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('skill_delete_',$submittedToken )) {

        $em->remove($skill);
        $em->flush();

        return $this->redirectToRoute('app_skill');
        

    }
    
    }
}
