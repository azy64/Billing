<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                "label"=>"Your email Address",
                "required"=>true,
                "attr"=>["class"=>"form-control"],
                "row_attr"=>["class"=>"form-group m-1"]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add("prenom",TextType::class,[
                "attr"=>["class"=>"form-control"],
                "required"=>true,
                "label"=>"Your Firstname",
                "row_attr"=>["class"=>"form-group m-1"]
            ])
            ->add("nom",TextType::class,[
                "attr"=>["class"=>"form-control"],
                "required"=>true,
                "label"=>"Your Name",
                "row_attr"=>["class"=>"form-group m-1"]
            ])
            ->add("phoneNumber",TelType::class,[
                "attr"=>["class"=>"form-control"],
                "required"=>true,
                "label"=>"Your Phone Number",
                "row_attr"=>["class"=>"form-group m-1"]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', "class"=>"form-control"],
                "required"=>true,
                "row_attr"=>["class"=>"form-group m-1"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            "constraints"=> [new UniqueEntity([
                "fields"=>["email"],
                "message"=>"This email address exist already in the system! please choose another one"
            ])]
        ]);
    }
}
