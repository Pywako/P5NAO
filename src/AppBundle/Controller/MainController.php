<?php
/**
 */

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Actualite;
use AppBundle\Entity\Newsletter;
use AppBundle\Entity\Observation;
use AppBundle\Entity\Taxref;
use AppBundle\Form\SubscribeNewsletterType;
use AppBundle\Form\Type\SearchObservationType;
use AppBundle\Form\Type\SearchSpecObservationType;
use AppBundle\Service\ObservationManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use AppBundle\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;

class MainController extends Controller
{
    /**
     * @param SessionInterface $session
     * @param Request $request
     * @param ObservationManager $observationManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * * @Route("/", name="homepage")
     */
    public function indexAction(SessionInterface $session, Request $request, ObservationManager $observationManager, EntityManagerInterface $em)
    {
        if (empty($session->get('observation'))) {
            $observation = $observationManager->createObservation();
        } else {
            $observation = $observationManager->getObservationInSession();
        }

        //Récupération Observation
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Observation');


        if(!$session->has('taxref'))
        {
            //Affichage de base
            $observationList = $repository->findBy(
                array('observationStatus'=> Observation::STATUS_VALIDATE),
                array('observationDate' => 'desc'),
                5,
                0
            );
            $observationArray = array();
            foreach ($observationList as $key => $observationElt){
                array_push($observationArray, array(
                        "nom" => $observationElt->getTaxref()->getNomVern(),
                        "lat" => $observationElt->getObservationLatitude(),
                        "lng" => $observationElt->getObservationLongitude(),
                    )
                );
            }
                $json_data = json_encode($observationArray);
        }
        else{
            //Affichage suite à la recherche
            $taxrefFamille = $session->get('taxref')->getFamille();

            $observationList = $em->getRepository("AppBundle\Entity\Observation")->getObservationsByFamily($taxrefFamille);

            $observationArray = array();
            foreach ($observationList as $key => $observationElt){
                array_push($observationArray, array(
                        "nom" => $observationElt->getTaxref()->getNomVern(),
                        "date" =>$observationElt->getObservationDate(),
                        "lat" => $observationElt->getObservationLatitude(),
                        "lng" => $observationElt->getObservationLongitude(),
                    )
                );
            }
            $json_data = json_encode($observationArray);
        }
        // Formulaire recherche
        $taxref = new Taxref();
        $form = $this->createForm(SearchObservationType::class, $taxref);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $session->clear();
            //mettre le retour du formulaire (taxref) en session
            $session->set('taxref', $taxref);
            return $this->redirectToRoute('homepage', array(
                'taxref' => $taxref
            ));
        }

        // replace this example code with whatever you need
        return $this->render('main/index.html.twig', [
            'map_api_key' => $this->getParameter('map_api_key'),
            'observationList' => $observationList,
            'form' => $form->createView(),
            'json_data' => $json_data
        ]);
    }

    /**
     * @Route("/actualite", name="actualite")
     */
    public function actualiteAction(Request $request)
    {

        $actualite = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Actualite')
            ->findBy(array(
                'actualiteStatus' => '2'
            ) , array(
                'id' => 'desc'
            ));

        return $this->render('main/actualite.html.twig', ['actualite' => $actualite]);

    }

    /**
     * @Route("/article/{id}/", name="actualite_article_view")
     */
    public function articleviewAction(Actualite $id)
    {
        if (!$id)
        {
            throw $this->createNotFoundException('Pas d\'article trouvée');
        }

        $actualite = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Actualite')
            ->findOneById($id);

        return $this->render('main/article.html.twig', ['actualite' => $actualite]);
    }

    /**
     * @Route("/aPropos", name="aPropos")
     */
    public function aProposAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('main/aPropos.html.twig', []);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('main/mentions.html.twig', []);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('main/contact.html.twig', []);
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faqAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('main/faq.html.twig', []);
    }

    /**
     * @Route("/carte", name="carte")
     */
    public function carteAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('main/carte.html.twig', ['map_api_key' => $this->getParameter('map_api_key') ]);
    }

    /**
     * @Route("/newsletter", name="subscribe_newsletter")
     */
    public function newsletterAction(Request $request)
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(SubscribeNewsletterType::class , $newsletter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($newsletter);
            $em->flush();

            return $this->redirect($this->generateUrl('profil_editor_allarticle'));
        }

        return $this->render('main/index.html.twig', []);

    }

    /**
     * @Route("/admin/", name="admin")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function adminAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('main/admin.html.twig', []);
    }

    /**
     * @Route("/client", name="client")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function clientAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('main/client.html.twig', []);
    }

    /**
     * @Route("/naturalist", name="naturalist")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function naturalistAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('main/naturalist.html.twig', []);
    }

    /**
     * @Route("/editor", name="editor")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function editorAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('main/editor.html.twig', []);
    }

    public function registerAction(Request $request)
    {

        $user = new UserAdmin();

        $form = $this->createForm(RegistrationType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {


        }
        else
        {
            return false;
        }


        return $this->render('@FOSUser/Registration/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/user", name="user_info")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function showUserAction()
    {
        $observationRepository = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Observation');

        $actualiteRepository = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Actualite');

        $userRepository = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:UserAdmin');

        if ($this->get('security.authorization_checker')
            ->isGranted('ROLE_ADMIN'))
        {

            $user = $userRepository->findAll();
            return $this->render('profil/adminUser.html.twig', ['user' => $user]);
        }
        if ($this->get('security.authorization_checker')
            ->isGranted('ROLE_NATURALIST'))
        {
            $observation = $observationRepository->findBy(array(
                'observationStatus' => '2'
            ));
            $titleTable = 'Observation à valider';
            return $this->render('profil/naturalist.html.twig', ['observation' => $observation, 'titleTable' => $titleTable]);
        }
        if ($this->get('security.authorization_checker')
            ->isGranted('ROLE_EDITOR'))
        {
            $actualite = $actualiteRepository->findAll();
            return $this->render('profil/editor.html.twig', ['actualite' => $actualite]);
        }
        if ($this->get('security.authorization_checker')
            ->isGranted('ROLE_USER'))
        {
            $titleTable = 'Toutes mes observations';
            $userId = 'alexorac';

            $observation = $observationRepository->findBy(array(
                'user' => $userId
            ));

            return $this->render('profil/user.html.twig', ['observation' => $observation, 'titleTable' => $titleTable]);
        }
    }

    /**
     * @Route("/who-is-user", name="user_question")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */

    public function determineUser()
    {
        return $this->render('main/user.html.twig', []);
    }

}