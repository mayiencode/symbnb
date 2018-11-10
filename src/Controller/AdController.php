<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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


  