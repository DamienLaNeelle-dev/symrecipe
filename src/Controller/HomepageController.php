<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController extends AbstractController{
    
    #[Route ("/", 'homepage.index', methods: ['GET'])]


    public function homepage(): Response{
    return $this->render('pages/homepage.html.twig');
}
}

?>