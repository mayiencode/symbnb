<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends AbstractType
{

    /**
     * Permet d'avoir la configuration de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    public function getConfiguration($label) {

        return [
            'label' => $label,
            'label_attr' =>[
                'class' => 'bmd-label-floating'
            ]
            ];
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
                'label_attr' => [
                'class' => 'bmd-label-floating'
                ]
            ])
            /*plutôt que de faire les répétitions pour chaque champ, nous allons créer une fonction pour automatiser la tâche
            la fonction créé est getConfiguration($label, $placeholder)
            */
            ->add('coverImage', UrlType::class, $this->getConfiguration('URL de l\'image principale'))
            ->add('introduction', TextType::class, $this->getConfiguration('Introduction'))
            ->add('content', TextareaType::class, $this->getConfiguration('Description détaillée'))
            ->add('rooms', IntegerType::class, $this->getConfiguration('Nombre de chambres'))
            ->add('price', MoneyType::class, $this->getConfiguration('Prix par nuit'))    
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
