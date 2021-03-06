<?php

namespace Nipponjob\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nipponjob\AccueilBundle\Entity\Article;
use Nipponjob\AccueilBundle\Form\ArticleType;
use Nipponjob\AccueilBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use JMS\SecurityExtraBundle\Annotation\Secure;

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

    public function ajouterAction(Request $request, $id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_AUTEUR'))
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if ($id != 0)
        {
            $article = $this->getDoctrine()->getManager()->getRepository('NipponjobAccueilBundle:Article')->find($id);
        }
        else
        {
            $article = new Article;
        }

        $form = $this->createForm(new ArticleType, $article);
        $form->handleRequest($request);
        $parameters = array('form' => $form->createView(), 'valid' => FALSE);

        if ($request->getMethod() == 'POST')
        {
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                $this->get('session')->getFlashBag()->add('form',
                        'Article ' . $article->getId() . ' bien enregistré.');
                $parameters = array('valid' => TRUE, 'articleId' => $article->getId());
            }
        }
        return $this->render('NipponjobAccueilBundle:Accueil:ajouter.html.twig',
                        $parameters);
    }

    public function ajouterstaticAction()
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

    /**
     * 
     * @Template
     * @Secure(roles="ROLE_AUTEUR")
     */
    public function listeAction()
    {
        $categories = array('Tutoriel');
        $liste = $this->getDoctrine()->getManager()->getRepository('NipponjobAccueilBundle:Article')->ohYeah();
        $listec = $this->getDoctrine()->getManager()->getRepository('NipponjobAccueilBundle:Article')->getAvecCategories($categories);

        if ($liste === null || $listec === null)
        {
            throw $this->createNotFoundException('Pas de liste possible !');
        }

        return array('liste' => $liste, 'listec' => $listec);
    }

    /**
     * 
     * @Route("/annotation")
     */
    public function AnnotationAction()
    {
        return new Response('Route par annotation !');
    }
}
