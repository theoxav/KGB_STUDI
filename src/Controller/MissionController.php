<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/mission')]
class MissionController extends AbstractController
{
    #[Route('/', name: 'app_mission')]
    public function index(MissionRepository $missionRepo, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $missionRepo->findAll();
        $missions = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            3
        );

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
    #[IsGranted("ROLE_ADMIN")]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $mission = new Mission;

        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
           if(!$mission->skillsAgentsIsValid()){ 
            $this->addFlash('error', 'At least one of the agents must have the mission\' speciality'); 
          
        } else if(!$mission->nationalityIsValid()) {
            $this->addFlash('error', 'An Agent and a Target can\' have the same nationality'); 

           } else if(!$mission->hideoutIsValid()) {
            $this->addFlash('error', 'The Hideout must be in the same country as the mission'); 

           } else if(!$mission->contactIsValid()) {
              $this->addFlash('error', 'The contact must have the nationality of the country in wich the mission is located'); 

           } else {

               $em->persist($mission);
               $mission->setStatus('preparation');
               $em->flush(); 

               $this->addFlash('success', 'Mission successfully created'  );
              
               return $this->redirectToRoute('app_mission');

           }
        }
          return $this->render('mission/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_mission_edit', methods:['GET','PUT'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Request $request,Mission $mission, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(MissionType::class, $mission,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            if(!$mission->skillsAgentsIsValid()){ 
                $this->addFlash('error', 'At least one of the agents must have the mission\' speciality'); 
              
            } else if(!$mission->nationalityIsValid()) {
                $this->addFlash('error', 'An Agent and a Target can\' have the same nationality'); 
    
               } else if(!$mission->hideoutIsValid()) {
                  $this->addFlash('error', 'The Hideout must be in the same country as the mission'); 
    
               } else if(!$mission->contactIsValid()) {
                   $this->addFlash('error', 'The contact must have the nationality of the country in wich the mission is located');
             
               } else {
                   
                   $em->flush(); 

                   $this->addFlash('success', 'Mission successfully updated'  );
                   return $this->redirectToRoute('app_mission');
               }
        }

        return $this->render('mission/edit.html.twig',[
            'mission' => $mission,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_mission_delete', methods:'DELETE')]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Request $request,Mission $mission, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('mission_delete_',$submittedToken )) {
           
        $em->remove($mission);
        $em->flush();

        $this->addFlash('success', 'Mission successfully deleted'  );

        return $this->redirectToRoute('app_mission');
        

    }
    
    }
}
