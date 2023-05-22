<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use DateTime;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual; 
use App\Entity\RendezVous;
use Symfony\Component\Validator\Constraints\GreaterThan;
use App\Entity\User;
use Symfony\Component\Validator\Constraints\Time;
use Symfony\Component\Security\Core\Security;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {$user = $this->security->getUser();
        $currentDateTime = $this->getCurrentDateTime();
        $builder
           
        ->add('date', null, [
            'data' => $currentDateTime,
            'constraints' => [
                new GreaterThanOrEqual([
                    'value' => $currentDateTime,
                    'message' => 'La date du rendez-vous doit être supérieure ou égale à la date actuelle.',
                ]),
            ],
        ])
        ->add('temps', null, [
            
        ])
                ->add('etat' ,ChoiceType::class,[
                    'choices' => [
                        'accepter ' => 'accepte',
                        'refuser ' => 'refuse',
                        'encours ' => 'encours',
                    ] ,
                    'disabled' => $options['new'], // make the 'etat' field nomodifiable  for new entities
                ])  
                
           /* ->add('user', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'nom', 
                'query_builder' => function (UserRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.roles LIKE :roles' )
                        ->setParameter('roles', '%ROLE_PATIENT%');
                },'disabled' => true,
            ])// Replace 'username' with the actual property of User entity you want to use as the label
            */
            ->add('user', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'nom',
                'query_builder' => function (UserRepository $er) use ($user) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u = :user    ')
                        ->setParameter('user', $user);
                },
                
            ])
        
            
        ;
    }
    private function getCurrentDateTime(): DateTime
{
    return new DateTime();
}
 
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
            'new' => false,
        ]);
    }

    public function __construct(Security $security)
{
    $this->security = $security;
}
}
