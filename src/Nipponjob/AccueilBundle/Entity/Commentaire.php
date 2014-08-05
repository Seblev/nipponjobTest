<?php

namespace Nipponjob\AccueilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nipponjob\AccueilBundle\Entity\CommentaireRepository")
 */
class Commentaire
{

    /**
     * @ORM\ManyToOne(targetEntity="Nipponjob\AccueilBundle\Entity\Article", inversedBy="commentaires"))
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Commentaire
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set article
     *
     * @param \Nipponjob\AccueilBundle\Entity\Article $article
     * @return Commentaire
     */
    public function setArticle(\Nipponjob\AccueilBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Nipponjob\AccueilBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

}
