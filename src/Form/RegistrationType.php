<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * On hérite de la class ApplicationType qui contient des function communes à plusieurs class
 * la class ApplicationType hérite elle même de la class AbstractType
 */
class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Votre prénom"))
            ->add('lastName', TextType::class, $this->getConfiguration("Votre nom"))
            ->add('email', EmailType::class, $this->getConfiguration("Votre email"))
            ->add('picture', UrlType::class, $this->getConfiguration("Url de votre avatar"))
            ->add('hash', PasswordType::class,$this->getConfiguration("Mot de passe"))
            /**
             * pour ajouter un champ qui ne correspond pas à ceux de l'entité User il faut l'ajouter dans la class
             * User.
             */
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmez votre mot de passe"))
            ->add('introduction', TextType::class, $this->getConfiguration("Présentez-vous"))
            ->add('description', TextareaType::class, $this->getConfiguration("Qui êtes vous ?"))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
