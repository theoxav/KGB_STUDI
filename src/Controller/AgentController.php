<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/agent')]
#[IsGranted("ROLE_ADMIN")]
class AgentController extends AbstractController
{
    #[Route('/', name: 'app_agent')]
    public function index(AgentRepository $agentRepo): Response
    {
        $agents = $agentRepo->findAll();

        return $this->render('agent/index.html.twig',[
            'agents' => $agents
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_agent_show', methods:'GET')]
    public function show(Agent $agent): Response
    {    
    
        return $this->render('agent/show.html.twig',[
            'agent' => $agent
        ]);
    }

    #[Route('/create', name: 'app_agent_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $agent = new Agent;

        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($agent);
            $em->flush();

            $this->addFlash('success', 'Agent successfully created'  );
           
            return $this->redirectToRoute('app_agent');
        }
        return $this->render('agent/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_agent_edit', methods:['GET','PUT'])]
    public function edit(Request $request,Agent $agent, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(AgentType::class, $agent,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();
           
            $this->addFlash('success', 'Agent successfully updated'  );
            
            return $this->redirectToRoute('app_agent');
        }
        return $this->render('agent/edit.html.twig',[
            'agent' => $agent,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_agent_delete', methods:'DELETE')]
    public function delete(Request $request,Agent $agent, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('agent_delete_',$submittedToken )) {

        $em->remove($agent);
        $em->flush();

        $this->addFlash('success', 'Agent successfully deleted'  );


        return $this->redirectToRoute('app_agent');
        

    }
    
    }
}
