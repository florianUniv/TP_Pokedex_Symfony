<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


use App\Entity\RefPokemon;
use App\Entity\ElementaryType;
use App\Entity\User;
use App\Entity\Pokemon;

use Doctrine\ORM\EntityRepository;

class DefaultController extends AbstractController
{
	/**
	 * @Route("/home", name="home")
+    */
    public function home()
    {
    	$repository = $this->getDoctrine()->getRepository(RefPokemon::class);
    	$pkms = $repository->findAll();
    	$nb_pkms = count($pkms);
    	$nb_bases = count($repository->findBy(['starter' => 1 ]));
    	$nb_evo = count($repository->findBy(['evolution' => 1 ]));

    	$repository = $this->getDoctrine()->getRepository(ElementaryType::class);

    	$types = $repository->findAll();

    	$nb_par_types = array();
    	for($i=0;$i<sizeof($types)-1;$i++){ //-1 pour éliminer le type aucun
    		$nb_par_types[$i]=0;
    	}
		
    	for ($i=0;$i<sizeof($pkms);$i++) {
    		for ($j=0;$j<sizeof($types)-1;$j++) {
    			if($pkms[$i]->getType1()==$types[$j] || $pkms[$i]->getType2()==$types[$j]){
    				$nb_par_types[$j]+=1;
    			}
    		}
    	}
		
    	$les_types= array();
    	for($i=0; $i<sizeof($nb_par_types);$i++){
    		$les_types[$i]= array();
    		$les_types[$i][0]= $types[$i];
    		$les_types[$i][1]= $nb_par_types[$i];
    	}
    	

        return $this->render('home.html.twig',array('nb_pkms' => $nb_pkms, 'nb_bases' => $nb_bases, 'nb_evo' => $nb_evo, 'les_types' => $les_types));
    }

    /**
+    * @Route("/liste", name="liste")
+    */
	public function liste(){
		$repository = $this->getDoctrine()->getRepository(RefPokemon::class);
		$ref_pkms = $repository->findAll();
		
		return $this->render('liste.html.twig',array('ref_pkms' => $ref_pkms));	
	}

	/**
	 * @Route("/detail/{id}")
	 */
	public function detail($id){
		$repository = $this->getDoctrine()->getRepository(RefPokemon::class);
		$ref_pkm = $repository->find($id);
		return $this->render('detail.html.twig',array('ref_pkm' => $ref_pkm));	
	}

	/**
	 * @Route("/new", name="new")
	 */
	public function new(Request $request){
		$ref_pkm = new RefPokemon();
		
		$form = $this->createFormBuilder($ref_pkm)
		->add('nom', TextType::class)
        ->add('evolution', CheckboxType::class, [
        	'label' => 'Evolution',
    		'required' => false,
        ])
        ->add('starter', CheckboxType::class, [
        	'label' => 'Starter',
    		'required' => false,
        ])
        ->add('type_courbe_niveau', ChoiceType::class, [
        	'choices' =>[
        		'P' => 'P'
        	]
        ])
        ->add('type_1', EntityType::class, [
        	'class' => ElementaryType::class,
        	'choice_label' => 'libelle'
        ])
        ->add('type_2',EntityType::class, [
        	'class' => ElementaryType::class,
        	'choice_label' => 'libelle'
        ])
        ->add('save', SubmitType::class, ['label' => 'Créer le Pokémon'])
        ->getForm();

			

		$form->handleRequest($request);

		 if ($form->isSubmitted() && $form->isValid()) {
		 	$ref_pkm =$form->getData();

		 	$entityManager = $this->getDoctrine()->getManager();
		 	$entityManager->persist($ref_pkm);
		 	$entityManager->flush();

		 	return $this->redirectToRoute('new_success');
		 }

		 return $this->render('new.html.twig',['form' => $form->createView()]);

	}

	/**
	 * @Route("/new_success", name="new_success")
	 */
	public function new_success(){
		return $this->render('new_success.html.twig');	
	}	

	/**
	 * @Route("/connexion")
	 */
	public function connexion(){
		return $this->render('connexion.html.twig');	
	}

	/**
	 * @Route("/inscription", name="inscription")
	 */
	public function inscription(Request $request){

		$trainer = new User();
		$form = $this->createFormBuilder($trainer)
		->add('username',TextType::class)
		->add('password',PasswordType::class)
		->add('email',EmailType::class)
		->add('starter', EntityType::class, [
        	'class' => RefPokemon::class,
        	'query_builder' => function (EntityRepository $er) {
        		return $er->createQueryBuilder('u')
        			 ->orderBy('u.id', 'ASC')
   					 ->where('u.id = 1 OR u.id = 4 OR u.id = 7');
    		},
        	'choice_label' => 'nom'
        ])
        ->add('save', SubmitType::class, ['label' => 'S\'inscrire'])
		->getForm();


		$form->handleRequest($request);

		 if ($form->isSubmitted() && $form->isValid()) {
		 	
		 	$trainer =$form->getData();

		 	$entityManager = $this->getDoctrine()->getManager();
		 	$entityManager->persist($trainer);
		 	$entityManager->flush();

		 	//Ajout du starter:
		 	$pkm = new Pokemon();

		 	$nb_random = random_int(0, 1);
		 	if($nb_random==1){
		 		$pkm->setSexe('M');
			}
			else{
				$pkm->setSexe('F');
			}

			$pkm->setXp(0);
			$pkm->setNiveau(5);
			$pkm->setAVendre(false);
			$pkm->setPrix(0);
			$pkm->setDateDernierEntrainement(new \DateTime('now'));
			$pkm->setRefPokemon($form->get('starter')->getData());
			$user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $form->get('email')->getData() ]);
			$pkm->setDresseur($user);

			$entityManager->persist($pkm);
			$entityManager->flush();

		 	return $this->redirectToRoute('inscription_success');
		 }


		return $this->render('inscription.html.twig', [
        'form' => $form->createView(),
    	]);

			
	}

	/**
	 * @Route("/inscription_success", name="inscription_success")
	 */
	public function inscription_success(){
		return $this->render('inscription_success.html.twig');	
	}	

	/**
	 * @Route("/ajout") 
	 */
	public function addAction(){

		$advert = new Advert();
		$advert->setDate(\DateTime::createFromFormat('Y-m-d', "2019-04-23"));
		$advert->setTitle('Recherche développeur Symfony.');
		$advert->setAuthor('Alexandre');
		$advert->setContent('Nous recherchons un développeur Symfony débutant sur Lyon. Bla bla bla ...');
		$advert->setPublished(true);

		$application1 = new Application();
		$application1->setAuthor('Marine');
		$application1->setContent("J'ai toutes les qualités requises.");

		$application2 = new Application();
		$application2->setAuthor('Pierre');
		$application2->setContent("Je suis très motivé.");

		$application1->setAdvert($advert);
		$application2->setAdvert($advert);

		$entityManager = $this->getDoctrine()->getManager();

		$entityManager->persist($advert);

		$entityManager->persist($application1);
		$entityManager->persist($application2);

		$entityManager->flush();

		return new Response('C\'est ajouté!');


	}

	/**
	 * @Route("/delete_pkm/{id}")
	 */
	public function delete_pkm($id){

		$entityManager = $this->getDoctrine()->getManager();
    	$ref_pkm = $entityManager->getRepository(RefPokemon::class)->find($id);
		
		$entityManager->remove($ref_pkm);
		$entityManager->flush();

		return $this->redirectToRoute('delete_pkm_success');
		
	}

	/**
	 * @Route("/delete_pkm_success", name="delete_pkm_success")
	 */
	public function delete_pkm_success(){
		return $this->render('delete_pkm_success.html.twig');
	}


	/**
	 * @Route("/mesPokemons", name="mesPokemons")
	 */
	public function mesPokemons(){

		$user = $this->getUser();

		$repository = $this->getDoctrine()->getRepository(Pokemon::class);
		$pkms = $repository->findBy(
			['dresseur' => $user]
		);
		
		return $this->render('mesPokemons.html.twig', array('pkms' => $pkms));
	}

}