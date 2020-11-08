<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AcountPasswordController extends AbstractController
{
    private $entityManager;
    /**
 * AcountPasswordController constructor.
 * @param $entityManager
 */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/acount/password", name="acount_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $notification = null;
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $old_psw = $form->get('old_password')->getData();
            $test_password = $encoder->isPasswordValid($user, $old_psw);
            if($test_password) {
                $new_psw = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user, $new_psw);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notification = "Vous mot de passe a bien ete mis a jour ";
            } else {
                $notification = "Votre mot de passe actuel n'est pas le bon!!";
            }
        }
        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
