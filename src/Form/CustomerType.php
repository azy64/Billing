<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('companyName',TextType::class,[
                'label'=>'Company\'s Name',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('companyEmail',EmailType::class,[
                'label'=>'Company\'s mail Address',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('name',TextType::class,[
                'label'=>'Handler Name',
                'required'=>false,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('companyAddress',TextType::class,[
                'label'=>'Company\'s Address',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('billingAddress', TextType::class,[
                'label'=>'Company\'s Billing Address',
                'required'=>false,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('phoneNumber',TelType::class,[
                'label'=>'Company\'s Phone Number',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('companyMail',EmailType::class,[
                'label'=>'Handler\'s mail Address',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            /*->add('createAt', null, [
                'widget' => 'single_text',
            ])*/
            ->add('companySiren',TextType::class,[
                'label'=>'Company\'s ID or SIREN',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
           /* ->add('createdBy', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
