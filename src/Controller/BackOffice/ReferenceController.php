<?php

namespace App\Controller\BackOffice;

use App\Entity\Reference;
use App\Form\ReferenceType;
use App\Repository\ReferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Class ReferenceController
 * @package App\Controller\BackOffice
 * @Route ("admin/references")
 */
class ReferenceController extends AbstractController
{

    /**
     * @Route (name="reference_manage")
     * @param ReferenceRepository $referenceRepository
     * @return Response
     */
    public function manage(ReferenceRepository $referenceRepository): Response {
        $references = $referenceRepository->findAll();

        return $this->render('backOffice/reference/manage.html.twig', [
            'references' => $references
        ]);
    }

    /**
     * @Route ("/create", name="reference_create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response {

        $reference = new Reference();
        $form = $this->createForm(ReferenceType::class, $reference)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($reference);
            $em->flush();
            $this->addFlash('success', 'La référence a été ajoutée avec succès !');

            return $this->redirectToRoute('reference_manage');
        }
        return $this->render('backOffice/reference/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/{id_reference}/update", name="reference_update")
     * @ParamConverter("reference", options={"id" = "id_reference"})
     * @param Reference $reference
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function update(Reference $reference, Request $request, EntityManagerInterface $em): Response {
        $form = $this->createForm(ReferenceType::class, $reference)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La référence a été modifiée avec succès !');

            return $this->redirectToRoute('reference_manage');
        }
        return $this->render('backOffice/reference/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/{id_reference}/delete", name="reference_delete")
     * @ParamConverter("reference", options={"id" = "id_reference"})
     * @param Reference $reference
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function delete(Reference $reference, EntityManagerInterface $em): RedirectResponse {
        $em->remove($reference);
        $em->flush();
        $this->addFlash('success', 'La référence a été supprimée avec succès !');

        return $this->redirectToRoute('reference_manage');
    }


}
