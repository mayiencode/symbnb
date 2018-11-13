<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Image;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

     /**
     * Permet de créer une annonce
     * @Route("/ads/new", name="ads_create")
     */

    public function create(Request $request, ObjectManager $manager){
        /*
        Instantiation d'une annonce
        */ 
        $ad = new Ad();
        
    
        /*
        1) création d'un formulaire basé sur les champs de l'Entity Ad
        le FormBuilder adapte le type de champ à la propriété correspondante
         
        $form = $this->createFormBuilder($ad)
                     ->add('title')
                     ->add('introduction')
                     ->add('content')
                     ->add('rooms')
                     ->add('price')
                     ->add('coverImage')
                     /*création d'un bouton de validation si celui-ci n'est pas ajouté dans TWIG 
                     ->add('save', SubmitType::class, [
                         'label' => 'Créer la nouvelle annonce',
                         'attr' => [
                             'class' => 'btn btn-primary'

                         ]
                     ])
                     ->getForm();
                    /* Pour éviter de surcharger le Controller avec les attributs du formulaire, on créé
                     une classe dédiée à nos formulaire par php bin/console make:form */

        /* 2) appel d'une classe de formulaire */

        $form = $this->createForm(AdType::class, $ad);

        /* utilisation de Request */
        /* handlerequest permet de parcourir la requête et de relier toutes les informations du
        formulaire aux champ du formulaire $ad */
        $form->handleRequest($request);

        
                            
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($ad);
            $manager->flush();
            
        /* Permet d'ajouter un message lorsque le formulaire est soumis et validé
            Il faut pour cela utiliser la variable App dans TWIG*/
            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong>a bien été enregistrée !"
            );
            

        /* Redirige vers la route désignée lorsque le formulaire est soumis et validé 
        ici, on redirige vers la page d'affichage de l'annonce que nous venons de créer
        en passant le paramètre slug correspondant à celui qui vient d'être créé */
            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);

        }

        return $this->render('ad/new.html.twig',[
            'form' => $form->createView()
    ]);        

    }




    /**
     * @Route("ads/{slug}", name="ads_show")
     * 
     * @return Response
     */
    /*
    public function show($slug, AdRepository $repo){
         1) on peut chercher dans une repository les entrées par leur propriétés. Par exemple ci-dessous nous
        cherchons les entrées par leur slug, mais nous aurions pu chercher les entrées par leur id, price, ...
        avec par exemple findByPrice() 
        findBy() renvoie un tableau, findOneBy() renvoi une entrée
        
        $ad = $repo->findOneBySlug($slug);
        */

        /* 2) avec le ParamConverter il n'est pas nécessaire d'appeler le Repository puisque le ParamConverter appelle 
        automatiquement l'Entity en paramètre de la fonction qui correspond à notre slug passé dans la route
        */
    public function show($slug, Ad $ad){

        return  $this->render('ad/show.html.twig',[
            'ad' => $ad
                
        ]);

    }

   

}


  