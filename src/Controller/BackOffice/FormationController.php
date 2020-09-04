<?php

namespace App\Controller\BackOffice;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Class FormationController
 * @package App\Controller\BackOffice
 * @Route ("admin/formations")
 */
class FormationController extends AbstractController
{

    /**
     * @Route (name="formation_manage")
     * @param FormationRepository $formationRepository
     * @return Response
     */
    public function manage(FormationRepository $formationRepository): Response {
        $formations = $formationRepository->findAll();

        return $this->render('backOffice/formation/manage.html.twig', [
            'formations' => $formations
        ]);
    }

    /**
     * @Route ("/create", name="formation_create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response {

        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($formation);
            $em->flush();
            $this->addFlash('success', 'La formation a été ajoutée avec succès !');

            return $this->redirectToRoute('formation_manage');
        }
        return $this->render('backOffice/formation/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/{id_formation}/update", name="formation_update")
     * @ParamConverter("formation", options={"id" = "id_formation"})
     * @param Formation $formation
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function update(Formation $formation, Request $request, EntityManagerInterface $em): Response {
        dump($formation);
        $form = $this->createForm(FormationType::class, $formation)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La formation a été modifiée avec succès !');

            return $this->redirectToRoute('formation_manage');
        }
        return $this->render('backOffice/formation/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/{id_formation}/delete", name="formation_delete")
     * @ParamConverter("formation", options={"id" = "id_formation"})
     * @param Formation $formation
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function delete(Formation $formation, EntityManagerInterface $em): RedirectResponse {
        $em->remove($formation);
        $em->flush();
        $this->addFlash('success', 'La formation a été supprimée avec succès !');

        return $this->redirectToRoute('formation_manage');
    }


}
