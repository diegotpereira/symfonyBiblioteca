<?php

namespace App\Controller;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    /**
     * @Route("Usuario/mostra", methods="GET")
     */
    public function mostraAction()
    {
        return $this->render('Usuario/mostra.html.twig', ["usuario" => new Usuario()]);
    }
    /**
     * @Route('/usuario/novo", methods="GET")
     */
    public function formulario()
    {
        $form = $this->createFormBuilder(new Usuario)
                     ->add('login')
                     ->add('senha')
                     ->add('permissoes', ChoiceType::class,[
                         "multiple" => true,
                         "choices" => [
                         "Bibliotecario" => "ROLE_BIBLIOTECARIO", "Atendente" => "ROLE_ATENDENTE"

                         ]
                     ])
                     ->setAction('/usuario/novo')
                     ->getForm();

        return $this->render("Usuario/novo.html.twig", ["form" => $form->createView()])             ;
    }
    /**
     * @Route("Usuario/novo", methods="POST")
     */
    public function cria(Request $request)
    {
        $usuario = new Usuario();

        $form = $this->createFormBuilder($usuario)
                     ->add('login')
                     ->add('senha')
                     ->add('permissoes', ChoiceType::class, [
                         "multiple" => true,
                         "choices" => [
                             "Bibliotecario" => "ROLE_BIBLIOTECARIO", "Atendente" => "ROLE_ATENDENTE"
                         ]
                     ])
                     ->getForm();
                     $form->handleRequest($request);

                     $em = $this->getDoctrine()->getManager();
                     $em->persist($usuario);
                     $em->flush();

                     return $this->redirect("/usuario/lista");
    }
    /**
     * @Route("/usuario/lista", methods="GET")
     */
    public function lista()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Usuario::class);

        return $this->render("Usuario/lista.html.twig", ["usuarios" => $repository->findAll()]);
    }
    /**
     * @Route("/usuario/edita/{id}", methods="GET")
     */
    public function mostra(Usuario $usuario)
    {
        $form = $this->createFormBuilder($usuario)
                     ->add('login')
                     ->add('senha')
                     ->add('permissoes', ChoiceType::class, [
                         "multiple" => true,
                         "choices" =>  [
                             "Biblotecario" => "ROLE_BIBLIOTECARIO", "Atendente" => "ROLE_ATENDENTE"
                         ]
                     ])
                     ->setAction("/usuario/edita/".$usuario->getId())
                     ->getForm();
        return $this->render('Usuario/edita.html.twig', ["usuario" => $usuario, "form" => $form->createView()]);
    }
    /**
     * @Route("usuario/edita/{id}", methods="POST")
     */
    public function edita(Usuario $usuario, Request $request)
    {
        $form = $this->createFormBuilder($usuario)
                     ->('login')
                     ->('senha')
                     ->('permissoes', ChoiceType::class, [
                         "multiple" => true,
                         "choices" => [
                             "Bibliotecario" => "ROLE_BIBLIOTECARIO", "Atendente" => "ROLE_ATENDENTE"
                         ]
                     ])
        ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            # code...
            $usuario = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->merge($usuario);
            $em->flush();

            return $this->redirect("/usuario/edita/".$usuario->getId());
        }
    return $this->render('Usuario/edita.html.twig', ["usuario" => $usuario]);
    }
    /**
     * @Route("/usuario/remove/{id}", methods="GET")
     */
    public function delete(Usuario $usuario)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($usuario);
        $em->flush();

        return $this->redirect("/usuario/lista");
    }
}
