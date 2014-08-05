<?php

namespace Nipponjob\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nipponjob\AccueilBundle\Entity\Article;
use Nipponjob\AccueilBundle\Entity\Image;

class AccueilController extends Controller
{

    public function indexAction()
    {
        return $this->render('NipponjobAccueilBundle:Accueil:index.html.twig');
    }

    public function contactAction()
    {
        $session = $this->get('session');
        $session->set('user_id', 84);
        return $this->render('NipponjobAccueilBundle:Accueil:contact.html.twig');
    }

    public function ajouterAction()
    {

        /** Création de l'entité */
        $article = new Article();
        $article->setTitre('Mon dernier weekend');
        $article->setAuteur('Bibi');
        $article->setContenu("Un corp plongé ...");
        $article->setDateModification(new \Datetime());

        $image = new image();
        $image->setUrl('images/exemple.jpg');
        $image->setAlt('exemple');

        $article->setImage($image);

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info',
                'Article ' . $article->getId() . ' bien enregistré.');
        return $this->redirect($this->generateUrl('nipponjob_accueil_voir',
                                array('id' => $article->getId())));
    }

    public function idAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('NipponjobAccueilBundle:Article');

        $article = $repository->myFindOneByTitre();

        if ($article === null)
        {
            throw $this->createNotFoundException('L\'article avec le numero [id=' . $id . '] n\'existe pas.');
        }

        return $this->render('NipponjobAccueilBundle:Accueil:voir.html.twig',
                        array('article' => $article));
    }

    public function listeAction()
    {
        $liste = $this->getDoctrine()->getManager()->getRepository('NipponjobAccueilBundle:Article')->ohYeah();

        if ($liste === null)
        {
            throw $this->createNotFoundException('Pas de liste possible !');
        }

        return $this->render('NipponjobAccueilBundle:Accueil:liste.html.twig',
                        array('liste' => $liste));
    }
}
