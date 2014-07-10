<?php
// src/Nipponjob/AccueilBundle/Menu/MenuBuilder.php

namespace Nipponjob\AccueilBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Accueil', array('route' => 'nipponjob_accueil_index'));
        $menu->addChild('Ajouter', array('route' => 'nipponjob_accueil_ajouter'));
        $menu->addChild('Voir', array('route' => 'nipponjob_accueil_voir'));
        $menu->addChild('Contact', array('route' => 'nipponjob_accueil_contact'));

        return $menu;
    }
}