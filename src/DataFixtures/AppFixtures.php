<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use App\Entity\Media;
use App\Entity\Reference;
use App\Entity\Skill;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setPassword($this->userPasswordEncoder->encodePassword($admin, "password"));
        $admin->setEmail("admin@email.com");
        $manager->persist($admin);

        for ($i = 1; $i <= 5; $i++) {
            $reference = new Reference();
            $reference->setName("Reference " . $i);
            $reference->setCompany("Company " . $i);
            $reference->setDescription("Description " . $i);
            $reference->setStartedAt(new \DateTimeImmutable("10 years ago"));
            $reference->setEndedAt(new \DateTimeImmutable("8 years ago"));
            $media = new Media();
            $media->setPath("uploads/image.png");
            $reference->addMedia($media);
            $manager->persist($reference);

            $skill = new Skill();
            $skill->setLevel(random_int(1, 10));
            $skill->setName("Skill " . $i);
            $manager->persist($skill);

            $formation = new Formation();
            $formation->setGradeLevel(random_int(0, 5));
            $formation->setDescription("Description " . $i);
            $formation->setSchool("School " . $i);
            $formation->setName("Formation " . $i);
            $formation->setStartedAt(new \DateTimeImmutable("10 years ago"));
            $formation->setEndedAt(new \DateTimeImmutable("8 years ago"));
            $manager->persist($formation);
        }
        $manager->flush();
    }
}
