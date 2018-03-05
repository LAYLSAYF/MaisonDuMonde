<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\PricesRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use AppBundle\Form\PricesType;

class ProductsType extends AbstractType
{
    
    //private $categories;

    //public function __constrcut(array $categories){

   //     $this->categories = $categories;
   // }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        //$categoriesChoiceList   = new ObjectChoiceList($this->categories);
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
            ));
         // ->add('categories')
/*          ->add('categories', 'choice', array(
             'choices' => array('a' => 'ahhh', 'b' => 'bhhh'),
             'label'   => 'Catégorie du produit',
             'choice_list' => $categoriesChoiceList,
             'multiple' => true,
          ));*/
/*          ->add('categories','entity',array(
              'class'=> 'AppBundle\Entity\Category',
              'query_builder' => function (\AppBundle\Repository\CategoryRepository $repo) {
                  return $repo->findAll();
              },                
              'expanded' => true,
              'multiple' => true
          ));*/
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
