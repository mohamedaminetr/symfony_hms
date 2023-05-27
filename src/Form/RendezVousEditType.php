<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\RendezVous;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use DateTime;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class RendezVousEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentDateTime = $this->getCurrentDateTime();
        $user = $this->security->getUser();
        $rendezVous = $options['data'];
        $isAdmin = $this->isAdmin();
        $builder
            ->add('date', null, [
                'data' => $currentDateTime,
                'constraints' => $isAdmin ? [] : [
                    new GreaterThanOrEqual([
                        'value' => $currentDateTime,
                        'message' => 'La date du rendez-vous doit être supérieure ou égale à la date actuelle.',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-field',
                    'style' => 'margin-bottom: 10px; margin-left: 10px;'
                ],
                'disabled' => $this->isPatientUser() && $rendezVous && ($rendezVous->getEtat() === 'refuse' || $rendezVous->getEtat() === 'accepte'),
            ])
            ->add('temps', null, [
                'attr' => [
                    'style' => 'margin-bottom: 10px; margin-left: 10px;'
                ],
                'disabled' => $this->isPatientUser() && $rendezVous && ($rendezVous->getEtat() === 'refuse' || $rendezVous->getEtat() === 'accepte'),
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'accepter' => 'accepte',
                    'refuser' => 'refuse',
                    'encours' => 'encours',
                ],
                'disabled' => $this->isPatientUser() && !$isAdmin,
                'attr' => [
                    'class' => 'form-field',
                    'style' => 'margin-bottom: 10px; margin-left: 10px;'
                ],
            ]);

        /*
        Reste du code
        */
        if (($rendezVous->getEtat() === 'encours' || $isAdmin)) {
            $builder->add('delete', ButtonType::class, [
                'label' => 'Supprimer',
                'attr' => [
                    'class' => 'btn btn-danger',
                ],
            ]);
        }
        
        
      
}


    private function isPatientUser(): bool
    {
        $user = $this->security->getUser();
        if ($user && in_array('ROLE_PATIENT', $user->getRoles())) {
            return true;
        }
        return false;
    }


    private function isAdmin(): bool
    {
        $user = $this->security->getUser();
        if ($user && in_array('ROLE_ADMIN', $user->getRoles())) {
            return true;
        }
        return false;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
            'new' => false,
        ]);
    }

    private function getCurrentDateTime(): DateTime
    {
        return new DateTime();
    }

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
}
