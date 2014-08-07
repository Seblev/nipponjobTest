<?php

namespace Nipponjob\AccueilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('titre')
                ->add('contenu')
                ->add('dateModification')
                ->add('auteur')
                ->add('active', 'checkbox', array('required' => false))
                ->add('note')
                ->add('categories', 'entity',
                        array(
                    'class' => 'NipponjobAccueilBundle:Categorie',
                    'property' => 'nom',
                    'multiple' => true))
                ->add('image', new ImageType())
                ->add('Enregister', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nipponjob\AccueilBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nipponjob_accueilbundle_article';
    }
}
