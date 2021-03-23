<?php

namespace App\Controller;
use App\Entity\Livro;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LivroController extends AbstractController
{
    /**
     * @Route("/livro/mostra", methods="GET")
     */
    public function mostraAction()
    {
        return $this->render('Livro/mostra.html.twig', ["livro" => new Livro()]);
    }
    /**
     * @Route("/livro/novo", methods="GET")
     */
    public function formulario()
    {
        if (!$this->isGranted("ROLE_BIBLIOTECARIO")) 
            # code...
            return $this->redirect("/login");
        
        $form = $this->createFormBuilder(new Livro())
                     ->add('nome')
                     ->add('autor')
                     ->setAction('/livro/novo')
                     ->getForm();
                    
        return $this->render("Livro/novo.html.twig", ["form" => $form->createView()]);
    }
    /**
     * @Route("/livro/novo", methods="POST")
     */
    public function cria(Request $request)
    {
        $livro = new Livro();

        $form = $this->createFormBuilder($livro)
                     ->add('nome')
                     ->add('autor')
                     ->getForm();

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($livro);
        $em->flush();

        return $this->redirect("/livro/lista");
    }
    /**
     * @Route("/livro/lista", methods="GET", name="admin_livro_lista")
     */
    public function lista()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Livro::class);

        return $this->render("Livro/lista.html.twig", ["livros" => $repository->findAll()]);
    }
    /**
     * @Route("/livro/edita/{id}", methods="GET")
     */
    public function mostra(Livro $livro)
    {
        $form = $this->createFormBuilder($livro)
                     ->add('nome')
                     ->add('autor')
                     ->getForm();

        return $this->render('Livro/edita.html.twig', ["livro" => $livro, "form" => $form->createView()]);        
    }
    /**
     * @Route("/livro/edita/{id}", methods="POST")
     */
    public function edita(Livro $livro, Request $request)
    {
        $form = $this->createFormBuilder($livro)
                    ->add('nome')
                    ->add('autor')
                    ->getForm();
           
        $form->handleRequest($request);

        if ($form->isValid()) {
            # code...
            $livro = $form->getData();

            $em = $this->getDoctrine()->getManager();

            
            $em->merge($livro);
            $em->flush();

            return $this->redirect("/livro/edita/".$livro->getId());
        }
        return $this->render('Livro/edita.html.twig', ["livro" => $livro]);
    }
    /**
     * @Route("/livro/remove/{id}", methods="GET")
     */
    public function delete(Livro $livro)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($livro);
        $em->flush();

        return $this->redirect("/livro/lista");
    }
}
