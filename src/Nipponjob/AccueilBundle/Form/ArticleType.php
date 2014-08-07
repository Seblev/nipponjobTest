<?php

namespace Nipponjob\AccueilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

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
                ->add('active', 'checkbox', array('required' => false))
                ->add('note')
                ->add('categories', 'entity',
                        array(
                    'class' => 'NipponjobAccueilBundle:Categorie',
                    'property' => 'nom',
                    'multiple' => true,
                    'required' => false))
                ->add('image', new ImageType(), array('required' => false))
                ->add('Enregister', 'submit')
        ;
        $factory = $builder->getFormFactory();
        $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function(FormEvent $event) use ($factory) {
                    $article = $event->getData();
                    if (null === $article)
                    {
                        return;
                    }
                    if (true === $article->getActive())
                    {
                        $event->getForm()->remove('active');
                    }
                });
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
