<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\PatientTypeLogin;
use App\Entity\Patient;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use  Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    #[Route(path: '/loginn', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils , PatientRepository $patientRepository) :Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

            // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last email entered by the patient
        $lastEmail = $authenticationUtils->getLastUsername();

        // create the login form
        $form = $this->createForm(PatientTypeLogin::class, [
            'email' => $lastEmail,
        ]);
    
        // handle the login form submission
        $form->handleRequest($request);
       
            // get the email and password from the form
            $email = $form->get('email')->getData();
            $password = $form->get('motdepasse')->getData(); 
            // retrieve the patient from the database based on email
           $this->$patientRepository(Patient::class)->findOneBy([
                'email' => $email,
            ]);
      // check if the patient exists and the password is correct
            if (!$patient || !password_verify($password, $patient->getMotdepasse())) {
                throw new AuthenticationException('Invalid email or password');
            }

            // set the patient object in the session
            $this->get('session')->set(Security::LAST_USERNAME, $email);
            $this->get('session')->set('patient', $patient);

            // redirect to the homepage or any other protected page
            alert("ok");
            return $this->redirectToRoute('/patient');
  
        return $this->render('security/login.html.twig', [ 'error' => $error]);

      /*  return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]); */
    }
 

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
