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
use Symfony\Component\Validator\Constraints\Regex;
use Doctrine\ORM\EntityManagerInterface;

final class CategoryAdmin extends AbstractAdmin
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
                    'constraints'=>[
                        new Regex([
                            'pattern'=>'/^[a-zA-Z0-9_\-]+$/',
                            'message'=>'Допустимы тоько английские буквы, цифры, дефис и символ подчеркивания'
                        ])
                    ]
                ])
                ->add('name', TextType::class)
                ->add('parent', ModelType::class, [
                    'property' => 'spacedName',
                    'query' => $this->em->createQueryBuilder()
                        ->select('c')
                        ->from(Category::class, 'c')
                        ->orderBy('c.lft')
                        ->getQuery()
                ])
                ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('name');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('name');
    }
    
    public function toString(object $object): string
    {
        return $object instanceof Category
            ? $object->getName()
            : 'Категория';
    }
}
