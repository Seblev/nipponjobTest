<?php

namespace Nipponjob\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Nipponjob\AccueilBundle\Entity\Article;
use Nipponjob\AccueilBundle\Entity\Contact;

class AccueilController extends Controller
{

    public function indexAction()
    {
        return $this->render('NipponjobAccueilBundle:Accueil:index.html.twig');
    }

    public function contactAction(Request $request)
    {
        $session = $this->get('session'); //appel du service session
        $session->set('user_id', 84);
        if ('POST' === $request->getMethod())
        {
            return $this->render('NipponjobAccueilBundle:Accueil:contact.html.twig',
                            array('valid' => TRUE));
        }
        $form = $this->createFormBuilder(new Contact())->add('mail', 'text')->add('message',
                        'textarea')->getForm();
        return $this->render('NipponjobAccueilBundle:Accueil:contact.html.twig',
                        array('form' => $form->createView(), 'valid' => FALSE));
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

    public function idAction(Article $article)
    {
        return $this->render('NipponjobAccueilBundle:Accueil:id.html.twig',
                        array('article' => $article));
    }

    public function listeAction()
    {
        $categories = array('Tutoriel');
        $liste = $this->getDoctrine()->getManager()->getRepository('NipponjobAccueilBundle:Article')->ohYeah();
        $listec = $this->getDoctrine()->getManager()->getRepository('NipponjobAccueilBundle:Article')->getAvecCategories($categories);

        if ($liste === null || $listec === null)
        {
            throw $this->createNotFoundException('Pas de liste possible !');
        }



        return $this->render('NipponjobAccueilBundle:Accueil:liste.html.twig',
                        array('liste' => $liste, 'listec' => $listec));
    }
}
