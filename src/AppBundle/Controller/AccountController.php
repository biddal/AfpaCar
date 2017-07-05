<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;



class AccountController extends AbstractController
{
    /**
     * @Route("/afpacar/account", name="account")
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
     * @Route("/afpacar/account/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
         
        $data = $request->request->all();
        $id   = $data['id'];
        $pwd  = $data['pwd'];
        
        $query = $em->createQuery('SELECT u
                                   FROM AppBundle:User u
                                   WHERE u.username = :id 
                                   AND   u.password = :pwd'
                                 )->setParameter('id', $id)
                                  ->setParameter('pwd', $pwd);
        
        $user = $query->getResult();
        
        if(count($user)) return $this->render('account.html.twig', 
                array('error' => 0));
        else return $this->render('account.html.twig', 
                array('error' => 2));
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
