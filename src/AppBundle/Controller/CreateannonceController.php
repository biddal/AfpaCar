<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreateannonceController extends AbstractController
{
    /**
     * @Route("/annonce/new", name="createannonce")
     */
  
    public function newAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
       

        $form = $this->createFormBuilder()
            ->add('Description', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Déposer mon annonce'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('createannonce.html.twig', array(
            'form1' => $form->createView()
        ));
    }
//    public function registerAnnonceAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        
//        $data = $request->request->all();
//        $id   = $data['Description'];
//    }
}

