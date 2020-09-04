<?php

namespace App\Controller\BackOffice;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Class SkillController
 * @package App\Controller\BackOffice
 * @Route ("admin/skills")
 */
class SkillController extends AbstractController
{

    /**
     * @Route (name="skill_manage")
     * @param SkillRepository $skillRepository
     * @return Response
     */
    public function manage(SkillRepository $skillRepository): Response {
        $skills = $skillRepository->findAll();

        return $this->render('backOffice/skill/manage.html.twig', [
            'skills' => $skills
        ]);
    }

    /**
     * @Route ("/create", name="skill_create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response {

        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($skill);
            $em->flush();
            $this->addFlash('success', 'La compétence a été ajoutée avec succès !');

            return $this->redirectToRoute('skill_manage');
        }
        return $this->render('backOffice/skill/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/{id_skill}/update", name="skill_update")
     * @ParamConverter("skill", options={"id" = "id_skill"})
     * @param Skill $skill
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function update(Skill $skill, Request $request, EntityManagerInterface $em): Response {
        $form = $this->createForm(SkillType::class, $skill)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La compétence a été modifiée avec succès !');

            return $this->redirectToRoute('skill_manage');
        }
        return $this->render('backOffice/skill/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/{id_skill}/delete", name="skill_delete")
     * @ParamConverter("skill", options={"id" = "id_skill"})
     * @param Skill $skill
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function delete(Skill $skill, EntityManagerInterface $em): RedirectResponse {
        $em->remove($skill);
        $em->flush();
        $this->addFlash('success', 'La compétence a été supprimée avec succès !');

        return $this->redirectToRoute('skill_manage');
    }


}
