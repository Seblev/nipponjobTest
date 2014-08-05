<?php
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

        $menu->addChild('Accueil', array('route' => 'nipponjob_accueil_index', 'routeAbsolute' => true));
        $menu->addChild('Ajouter', array('route' => 'nipponjob_accueil_ajouter', 'routeAbsolute' => true));
        $menu->addChild('Voir');
        $menu['Voir']->addChild('Id', array('route' => 'nipponjob_accueil_id', 'routeAbsolute' => true));
        $menu['Voir']->addChild('Liste', array('route' => 'nipponjob_accueil_liste', 'routeAbsolute' => true));
        $menu->addChild('Contact', array('route' => 'nipponjob_accueil_contact', 'routeAbsolute' => true));

        return $menu;
    }
}