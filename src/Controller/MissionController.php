<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/mission')]
class MissionController extends AbstractController
{
    #[Route('/', name: 'app_mission')]
    public function index(MissionRepository $missionRepo): Response
    {
        $missions = $missionRepo->findAll();

        return $this->render('mission/index.html.twig',[
            'missions' => $missions
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_mission_show', methods:'GET')]
    public function show(Mission $mission): Response
    {    
    
        return $this->render('mission/show.html.twig',[
            'mission' => $mission
        ]);
    }

    #[Route('/create', name: 'app_mission_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $mission = new Mission;

        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($mission);
            $em->flush();

            return $this->redirectToRoute('app_mission');
        }
        return $this->render('mission/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_mission_edit', methods:['GET','PUT'])]
    public function edit(Request $request,Mission $mission, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(MissionType::class, $mission,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();

            return $this->redirectToRoute('app_mission');
        }
        return $this->render('mission/edit.html.twig',[
            'mission' => $mission,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_mission_delete', methods:'DELETE')]
    public function delete(Request $request,Mission $mission, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('mission_delete_',$submittedToken )) {

        $em->remove($mission);
        $em->flush();

        return $this->redirectToRoute('app_mission');
        

    }
    
    }
}
