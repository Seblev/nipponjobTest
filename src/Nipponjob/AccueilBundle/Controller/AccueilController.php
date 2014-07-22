<?php

namespace Nipponjob\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nipponjob\AccueilBundle\Entity\Article;

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
    
    // Création de l'entité
    $article = new Article();
    $article->setTitre('Mon dernier weekend');
    $article->setAuteur('Bibi');
    $article->setContenu("Un corp plongé ...");
    $article->setDateModification(new \Datetime());

    // On peut ne pas définir ni la date ni la publication,
    // car ces attributs sont définis automatiquement dans le constructeur

    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // Étape 1 : On « persiste » l'entité
    $em->persist($article);

    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();
    $this->get('session')->getFlashBag()->add('info', 'Article '.$article->getId().' bien enregistré.');
    return $this->redirect( $this->generateUrl('nipponjob_accueil_voir', array('id' => $article->getId())) );
    }
    
    public function voirAction($id)
    {
        $repository = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('NipponjobAccueilBundle:Article');
  // On récupère l'entité correspondant à l'id $id
  $article = $repository->find($id);
  // $article est donc une instance de Sdz\BlogBundle\Entity\Article
  // Ou null si aucun article n'a été trouvé avec l'id $id
  if($article === null)
  {
    throw $this->createNotFoundException('L\'article avec le numero [id='.$id.'] n\'existe pas.');
  }
    
  return $this->render('NipponjobAccueilBundle:Accueil:voir.html.twig', array('article' => $article));
    }
}
