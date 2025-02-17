<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class CharacterOrderType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('name', TextType::class, [
                    'label' => 'Ваше имя (по паспорту)',
                    'required' => false
                ])
                ->add('nick', TextType::class, [
                    'label' => 'Ник в тусовке (если есть)',
                    'required' => false
                ])
                ->add('age', IntegerType::class, [
                    'label' => 'Сколько вам полных лет',
                    'required' => false
                ])
                ->add('contacts', TextareaType::class, [
                    'label' => 'Способы связи с вами',
                    'help' => 'Телефон, е-мэйл, телеграмм, ВКонтакт, вотсапп (на ваше усмотрение, но чем больше – тем лучше)'
                ])
                ->add('health', TextareaType::class, [
                    'label' => 'Проблемы со здоровьем (информация для медиков)',
                    'help' => 'Хронические заболевания, противопоказания, аллергии, прочее'
                ])
                ->add('food', TextareaType::class, [
                    'label' => 'Пищевые особенности, если есть (информация для кухни)',
                    'help' => 'Диеты, непереносимость конкретных продуктов, вегетарианство, прочее'
                ])
                ->add('psychological', TextareaType::class, [
                    'label' => 'Психологические противопоказания',
                    'help' => 'Страхи, триггеры, нежелательные темы'
                ])
                ->add('role', TextareaType::class, [
                    'label' => 'Желаемая роль',
                    'help' => 'Можно брать из списка на сайте, можно предлагать своё',
                    'required' => false
                ])
                ->add('want', TextareaType::class, [
                    'label' => 'Что вам было бы особенно интересно на этой игре? Чем хотели бы заниматься, что надеетесь получить?',
                    'required' => false
                ])
                ->add('nowant', TextareaType::class, [
                    'label' => 'Во что вам ни в коем случае не хотелось бы играть?',
                    'required' => false
                ])
                ->add('other', TextareaType::class, [
                    'label' => 'Что вы ещё хотите сказать мастерам',
                    'required' => false
                ])
                ->add('save', SubmitType::class, ['label' => 'Отправить'])
        ;
    }
}
