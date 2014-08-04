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
    $this->get('session')->getFlashBag()->add('info', 'Article '.$article->getId().' bien enregistré.');
    return $this->redirect( $this->generateUrl('nipponjob_accueil_voir', array('id' => $article->getId())) );
    }
    
    public function voirAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('NipponjobAccueilBundle:Article');
  // On récupère l'entité correspondant à l'id $id
  $article = $repository->find($id);
  // Ou null si aucun article n'a été trouvé avec l'id $id
  if($article === null)
  {
    throw $this->createNotFoundException('L\'article avec le numero [id='.$id.'] n\'existe pas.');
  }
    
  return $this->render('NipponjobAccueilBundle:Accueil:voir.html.twig', array('article' => $article));
    }
}
