<?php

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\Regex;
use Doctrine\ORM\EntityManagerInterface;

class ArticleAdmin extends AbstractAdmin
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
        parent::__construct();
    }
    
    protected function configureFormFields(FormMapper $form): void
    {
        $form
                ->add('slug', TextType::class,[
                    'required' => false,
                    'constraints'=>[
                        new Regex([
                            'pattern'=>'/^[a-zA-Z0-9_\-]*$/',
                            'message'=>'Допустимы тоько английские буквы, цифры, дефис и символ подчеркивания'
                        ])
                    ]
                ])
                ->add('title', TextType::class)
                ->add('category', ModelType::class, [
                    'property' => 'spacedName',
                    'query' => $this->em->createQueryBuilder()
                        ->select('c')
                        ->from(Category::class, 'c')
                        ->orderBy('c.lft')
                        ->getQuery()
                ])
                ->add('content', TextareaType::class, [
                    'attr' => ['class' => 'tinymce'],
                    'required' => false,
                ])
                ->add('visible',CheckboxType::class, [
                    'required' => false,
                ])
                ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('title');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('title');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
                ->add('title')
                ->add('category')
                ->add('content','html');
    }
    
    public function toString(object $object): string
    {
        return $object instanceof Article
            ? $object->getTitle()
            : 'Статья';
    }
}
