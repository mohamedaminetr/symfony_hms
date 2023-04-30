<?php

namespace App\Form;

use App\Entity\RendezVous;
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
             
            ->add('patient')
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
