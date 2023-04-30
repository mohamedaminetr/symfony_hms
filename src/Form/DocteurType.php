<?php

namespace App\Form;

use App\Entity\Docteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class DocteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('ncin')
            ->add('numerotelephone')
            ->add('age')
            ->add('motdepasse')
            ->add('specialite',ChoiceType::class,[
                'choices' => [
                    'service de radiologie' => 'service de radiologie',
                    'service de readaptation ' => 'service de readaptation ',
                    'service de chirurgie ' => 'service de chirurgie ',
                    'service de allaitement ' => 'service de allaitement ',
                ] ,
                
            ] 
         )
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Docteur::class,
        ]);
    }
}
