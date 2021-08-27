<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurFormType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{

    /**
     * @Route("/", name="utilisateur")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurFormType::class, $utilisateur);
        $utilisateur->setDateCreation(new \DateTime('now'));
        $utilisateur->setDateModification(new \DateTime('now'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
        }
        $donne = $this->getDoctrine()->getRepository(Utilisateur::class)->findby([], ['id' => 'asc']);
        // $name = $this->getDoctrine()->getRepository(Utilisateur::class)->searchName('Anny');
        $utilisateurs = $paginator->paginate(
            $donne, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5// Nombre de résultats par page
        );

        return $this->render("utilisateur/utilisateurs.html.twig", [
            "form" => $form->createView(),
            "utilisateurs" => $utilisateurs,
            // "name" => $name,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer_utlisateur")
     */
    public function suppression(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        $entityManager->remove($utilisateur);
        $entityManager->flush();

        return $this->redirectToRoute("utilisateur");
    }

}
