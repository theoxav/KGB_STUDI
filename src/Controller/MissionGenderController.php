<?php

namespace App\Controller;

use App\Entity\MissionGender;
use App\Form\MissionGenderType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MissionGenderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/mission-gender')]
#[IsGranted("ROLE_ADMIN")]
class MissionGenderController extends AbstractController
{
    #[Route('/', name: 'app_mission_gender')]
    public function index(MissionGenderRepository $missionGenderRepo): Response
    {
        $missionsGender = $missionGenderRepo->findBy([],['name' => 'ASC']);

        return $this->render('mission_gender/index.html.twig',[
            'missions_gender' => $missionsGender
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_mission_gender_show', methods:'GET')]
    public function show(MissionGender $missionGender): Response
    {    
    
        return $this->render('mission_gender/show.html.twig',[
            'mission_gender' => $missionGender
        ]);
    }

    #[Route('/create', name: 'app_mission_gender_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $missionGender = new MissionGender;

        $form = $this->createForm(MissionGenderType::class, $missionGender);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($missionGender);
            $em->flush();

            return $this->redirectToRoute('app_mission_gender');
        }
        return $this->renderForm('mission_gender/create.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_mission_gender_edit', methods:['GET','PUT'])]
    public function edit(Request $request,MissionGender $missionGender, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(MissionGenderType::class, $missionGender,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();

            return $this->redirectToRoute('app_mission_gender');
        }
        return $this->renderForm('mission_gender/edit.html.twig',[
            'mission_gender' => $missionGender,
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_mission_gender_delete', methods:'DELETE')]
    public function delete(Request $request,MissionGender $missionGender, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('mission_gender_delete_',$submittedToken )) {

        $em->remove($missionGender);
        $em->flush();

        return $this->redirectToRoute('app_mission_gender');
        

    }
    
    }
}
