<?php

namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front')]
class frontController extends AbstractController
{
    #[Route('/', name: 'app-_uuu')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig');
    }
    #[Route('/A_propos', name: 'app-apropos')]
    public function apropos(): Response
    {
        return $this->render('front/A_propos.html.twig');
    }

    #[Route('/Contact', name: 'app-contact')]
    public function contact(): Response
    {
        return $this->render('front/Contacter_nous.html.twig');
    }
    

    #[Route('/identifier', name: 'app-identifier')]
    public function identifier(): Response
    {
        return $this->render('front/identifier.html.twig');
    }
    
    
 
}
