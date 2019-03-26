<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 25/03/19
 * Time: 14:32
 */

namespace App\Form\Type;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CharacterType
 *
 * @package App\Form\Type
 */
class CharacterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                "label" => "Votre nom :"
            ])
/**
            ->add('pv', NumberType::class, [
                "label" => "Points de vie :"
            ])

            ->add('damage', NumberType::class, [
                "label" => "Points de dégats :"
                ])

            ->add('psy', NumberType::class, [
                "label" => "Points de psy :"
                ])
**/
            ->add('job', ChoiceType::class, [
                "label" => "Choisissez un métier :",
                "choices" => [
                    "Inspecteur" => 1,
                    "Boxeur"     => 2,
                    "Réanimateur"=> 3
                ]
            ])

            ->add('submit', SubmitType::class);

    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class
        ]);
    }

}