<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\PricesRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\PricesType;

class ProductsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('nom', 'text', array('label' => 'nom'))
          ->add('prices', CollectionType::class, [
            'entry_type' => PricesType::class,
            'error_bubbling' => false,
            'description' => "List of prices"
          ])
          ->add('stock', 'integer', array('label' => 'information du stock'))
          ->add('categories', CollectionType::class, array(
                'entry_type' => CategoryType::class,
                'error_bubbling' => false,
            ))
          ;   
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Products'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
