<?php


namespace App\Controller\Admin;


use App\Entity\Users;
use App\Form\EditUsersType;
use App\Form\RegistrationLogType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/liste_users")
     */
    public function utilisateur(UsersRepository $usersRepository)
    {
        $users = $usersRepository->findBy([], ['id' => 'ASC']);

        return $this->render('admin/users/users.html.twig',
            [
                'users' => $users
            ]
        );
    }

    /**
     * @Route("/modifier/{id}", defaults={"id": null}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, EntityManagerInterface $manager, $id)
    {
        $user = $manager->find(Users::class, $id);

        if (is_null($user)) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(EditUsersType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Les informations de ' . $user->getNickname() . ' ont été modifié');

            return $this->redirectToRoute('app_admin_users_utilisateur');
        }

        return $this->render('admin/users/edit.html.twig',
            [
                'form' => $form->createView()
            ]
        );

    }

    /**
     * @Route("/suppression/{id}", requirements={"id": "\d+"})
     */
    public function delete(EntityManagerInterface $manager, Users $users)
    {
        $manager->remove($users);
        $manager->flush();

        $this->addFlash('success', 'Le membre ' . $users->getNickname() . ' a bien été supprimé');

        return $this->redirectToRoute('app_admin_users_utilisateur');
    }
}