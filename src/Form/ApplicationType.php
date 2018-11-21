<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;



class ApplicationType extends AbstractType {

   /**
     * Permet d'avoir la configuration de base d'un champ
     * $options permet de passer un tableau d'options dans la function
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     * 
     * La fonction est en protected plutôt qu'en private pour permettre aux class qui vont
     * hériter de la class ApplicationType d'utiliser cette fonction. En mode private, seule la 
     * class ApplicationType pourrait utiliser cette function.
     */
    protected function getConfiguration($label, $options = []) {

        return array_merge([
            'label' => $label,
            'label_attr' =>[
                'class' => 'bmd-label-floating'
            ]
            ], $options);
    }

    
}