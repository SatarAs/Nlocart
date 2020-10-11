<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\CustomerCategory;
use App\Repository\CustomerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerLastName', TextType::class, [
                'required'  => true,
                'label'     => 'Nom : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez votre nom'
                ]
            ])
            ->add('customerFirstName', TextType::class, [
                'required'  => true,
                'label'     => 'Prénom : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez votre prénom'
                ]
            ])
            ->add('customerNickname', TextType::class, [
                'required'  => true,
                'label'     => 'Pseudo : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez votre pseudo'
                ]
            ])
            ->add('customerEmail', EmailType::class, [
                'required'  => true,
                'label'     => 'Email : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez votre adresse Email'
                ]
            ])
            ->add('password', TextType::class, [
                'required'  => true,
                'label'     => 'Mot de passe : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez un mot de passe'
                ]
            ])
            ->add('customerPhoneHome', TelType::class, [
                'required'  => false,
                'label'     => 'Téléphone fixe : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez votre numéro de téléphone fixe'
                ]
            ])
            ->add('customerCellPhone', TelType::class, [
                'required'  => true,
                'label'     => 'Téléphone portable : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez votre numéro de téléphone portable'
                ]
            ])
            ->add('customerCategory', EntityType::class, [
                'class'  => CustomerCategory::class,
                'choice_label'     => 'customerCategoryLabel',
                'expanded' => false,
                'multiple' => false,
                'label'    => false,
                'attr'      => [
                    'class'         => 'form-control'
                ]
            ])
            ->add('customerCompany', TextType::class, [
                'required'  => false,
                'label'     => 'Entreprise : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez votre nom d\'entreprise'
                ]
            ])
            ->add('customerSiretCompany', TextType::class, [
                'required'  => false,
                'label'     => 'SIRET : ',
                'attr'      => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Saisissez votre numéro de siret  de l\'entreprise'
                ]
            ])

            ->add('reset', ResetType::class, [
                'label' => 'Effacer',
                'attr' => [
                    'class' => 'btn btn-lg btn-block bouton_lien'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'M\'inscrire !',
                'attr' => [
                    'class' => 'btn btn-lg btn-block bouton_lien'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
