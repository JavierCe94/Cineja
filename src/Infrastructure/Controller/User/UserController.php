<?php

namespace Javier\Cineja\Infrastructure\Controller\User;

use Javier\Cineja\Infrastructure\Form\Model\Admin\UserForm;
use Javier\Cineja\Infrastructure\Form\Type\Admin\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function userLogin(Request $request): Response
    {
        $form = $this->createForm(UserType::class, new UserForm());
        $form->handleRequest($request);

        if ($form->isSubmitted() &&
            $form->isValid()) {
            $dataAdmin = $form->getData();
            return $this->redirectToRoute('admin_films');
        }

        return $this->render(
            'Admin/User/login_user.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
