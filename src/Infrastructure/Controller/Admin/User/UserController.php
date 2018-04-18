<?php

namespace Javier\Cineja\Infrastructure\Controller\Admin\User;

use Javier\Cineja\Infrastructure\Form\Model\Admin\User as UserForm;
use Javier\Cineja\Infrastructure\Form\Type\Admin\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class User extends Controller
{
    public function userLogin(): Response
    {
        $form = $this->createForm(UserType::class, new UserForm());

        if ($form->isSubmitted() && $form->isValid()) {
            $dataAdmin = $form->getData();
            //return $this->redirectToRoute();
        }

        return $this->render(
            'Admin/User/login_user.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}