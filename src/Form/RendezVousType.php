<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\RendezVous;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('date')
                ->add('etat' ,ChoiceType::class,[
                    'choices' => [
                        'accepter ' => 'accepte',
                        'refuser ' => 'refuse',
                        'encours ' => 'encours',
                    ] ,
                    'disabled' => $options['new'], // make the 'etat' field nomodifiable  for new entities
                ])  
             
            ->add('user', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'nom', 
                'query_builder' => function (UserRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.roles LIKE :roles')
                        ->setParameter('roles', '%ROLE_PATIENT%');
                },
            ])// Replace 'username' with the actual property of User entity you want to use as the label
            
        
            ->add('temps')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
            'new' => false,
        ]);
    }
}
