<?php

namespace Nipponjob\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction()
    {
        return $this->render('NipponjobAccueilBundle:Accueil:index.html.twig');
    }
    
        public function contactAction()
    {
        return $this->render('NipponjobAccueilBundle:Accueil:contact.html.twig');
    }
}
