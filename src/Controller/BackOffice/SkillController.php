<?php

namespace App\Controller\BackOffice;

use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response {

    }

    /**
     * @return Response
     */
    public function update(): Response {

    }

    /**
     * @return RedirectResponse
     */
    public function delete(): RedirectResponse {

    }


}
