<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */
    public function indexAction()
    {
        return $this->render('account.html.twig', 
                array('error' => -1));
    }
    
    /**
     * @Route("/afpacar/account/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $data = $request->request->all();
        $id   = $data['id'];
        $pwd  = $data['pwd'];
        $cfpwd  = $data['cfpwd'];
        if($pwd != $cfpwd) return $this->redirectToRoute('error', array("type" => 1));
        
        $query = $em->createQuery('SELECT u
                                   FROM AppBundle:User u
                                   WHERE u.username = :id'
                                 )->setParameter('id', $id);
        $user = $query->getResult();
        if(count($user)) return $this->redirectToRoute('error', array("type" => 2));
        
        $newuser = new User();
        $newuser->setUsername($id);
        $newuser->setPassword($pwd);
        $em->persist($newuser);
        $em->flush();
        
        return $this->render('account.html.twig', 
                             array('error' => 0));
    }
    
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
{
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        

        return $this->render('account.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    
    /**
     * @Route("/afpacar/account/error/{type}", name="error")
     */
    public function errorAction($type)
    {
        return $this->render('account.html.twig', 
                array('error' => $type));
    }
}
