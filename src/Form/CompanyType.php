<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       // dd($options);
        $logo = "../public/uploads/logo/".$options["data"]->getLogo();
        //dd($logo);
        $builder
            ->add('name',TextType::class,[
                'label'=>'Company\'s name',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('address', TextType::class,[
                'label'=>'Company\'s Address',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('billAddress',TextType::class,[
                'label'=>'Company\'s Billing Address if it\'s different than the company\'s address',
                'required'=>false,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('siren',TextType::class,[
                'label'=>'Company\'s SIREN or Identification Number',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('phoneNumber',TelType::class,[
                'label'=>'Company\'s phone number',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            ->add('logo',FileType::class,[
                'label'=>'Company\'s logo',
                'required'=>false,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group'],
                'data_class'=>null,
                "empty_data"=>$logo,
            ])
            ->add('email',EmailType::class,[
                'label'=>'Company\'s mail Address',
                'required'=>true,
                'attr'=>['class'=>'form-control'],
                'row_attr'=>['class'=>'form-group']
            ])
            /*->add('createAt', null, [
                'widget' => 'single_text',
            ])
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
            'constraints'=>new UniqueEntity([
                'fields'=>['name','email','phoneNumber'],
                'message'=>'The name, email and phone number that you tryng to save exist already in the system, choose another one'
            ])
        ]);
    }
}
