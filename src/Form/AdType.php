<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends AbstractType
{

    /**
     * Permet d'avoir la configuration de base d'un champ
     * $options permet de passer un tableau d'options dans la function
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     * 
     */
    public function getConfiguration($label, $options = []) {

        return array_merge([
            'label' => $label,
            'label_attr' =>[
                'class' => 'bmd-label-floating'
            ]
            ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('title', TextType::class, [
                'label' => 'Titre',
                
                'label_attr' => [
                    'class' => 'bmd-label-floating'
                    
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug de votre annonce',
                'required' => false,
                'label_attr' => [
                'class' => 'bmd-label-floating'
                ]
            ])
            /*plutôt que de faire les répétitions pour chaque champ, nous allons créer une fonction pour automatiser la tâche
            la fonction créé est getConfiguration($label, $placeholder)
            */
            ->add(
                'coverImage',
                 UrlType::class,
                  $this->getConfiguration('URL de l\'image principale')
                  )
            ->add(
                'introduction',
                 TextType::class,
                  $this->getConfiguration('Introduction')
                  )
            ->add(
                'content',
                 TextareaType::class,
                  $this->getConfiguration('Description détaillée')
                  )
            ->add(
                'rooms',
                 IntegerType::class,
                  $this->getConfiguration('Nombre de chambres')
                  )
            ->add(
                'price',
                 MoneyType::class,
                  $this->getConfiguration('Prix par nuit')
                  )   
                
                /* Création de champs de type collectionType pour l'ajout d'images multiples */
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    /* cette option permet de rajouter de nouveaux éléments dans la Collection */
                    'allow_add' => true,
                    /* autorise la suppression de champs dans le CollectionType */
                    'allow_delete' => true
                ]
            )
                
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
