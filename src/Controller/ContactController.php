<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact')]
#[IsGranted("ROLE_ADMIN")]
class ContactController extends AbstractController
{
    #[Route('/', name: 'app_contact')]
    public function index(ContactRepository $contactRepo): Response
    {
        $contacts = $contactRepo->findAll();

        return $this->render('contact/index.html.twig',[
            'contacts' => $contacts
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_contact_show', methods:'GET')]
    public function show(Contact $contact): Response
    {    
    
        return $this->render('contact/show.html.twig',[
            'contact' => $contact
        ]);
    }

    #[Route('/create', name: 'app_contact_create', methods:['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {    
        $contact = new Contact;

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('app_contact');
        }
        return $this->render('contact/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/edit', name: 'app_contact_edit', methods:['GET','PUT'])]
    public function edit(Request $request,Contact $contact, EntityManagerInterface $em): Response
    {    
        
        $form = $this->createForm(ContactType::class, $contact,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $em->flush();

            return $this->redirectToRoute('app_contact');
        }
        return $this->renderForm('contact/edit.html.twig',[
            'contact' => $contact,
            'form'=>$form
        ]);
    }

    #[Route('/{id<[0-9]+>}/delete', name: 'app_contact_delete', methods:'DELETE')]
    public function delete(Request $request,Contact $contact, EntityManagerInterface $em): RedirectResponse
    {  
        $submittedToken = $request->request->get('csrf_token');
         if($this->isCsrfTokenValid('contact_delete_',$submittedToken )) {

        $em->remove($contact);
        $em->flush();

        return $this->redirectToRoute('app_contact');
        

    }
    
    }
}
