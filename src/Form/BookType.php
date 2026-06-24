<?php

namespace App\Form;

use App\Entity\Author;

use App\Entity\Book;
use App\Entity\Editor;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('isbn')
            ->add('cover')
            ->add('editedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'available' => 'Disponible',
                    'borrowed' => 'Emprunté',
                    'unavailable' => 'Indisponible'
                ]
            ])
            ->add('editor', EntityType::class, [
                'class' => Editor::class,
                'choice_label' => 'editor_name',
            ])
            ->add('authors', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'author_name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
