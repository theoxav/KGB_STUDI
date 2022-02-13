<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agent')]
class AgentController extends AbstractController
{
    #[Route('/', name: 'app_agent')]
    public function index(): Response
    {
        return $this->render('agent/index.html.twig');
    }
}
