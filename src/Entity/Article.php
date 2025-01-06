<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

#[Gedmo\Tree(type: 'nested')]
#[ORM\Table(name: 'article')]
#[ORM\Entity(repositoryClass: NestedTreeRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, options: ["default" => ""])]
    private ?string $slug = '';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dt = null;

    #[ORM\Column]
    private ?bool $visible = true;
    
    #[ORM\Column]
    private ?bool $showTitle = true;
    
    #[ORM\Column]
    private ?bool $showChildren = true;
    
    #[ORM\Column]
    private ?bool $showBreadcrumbs = true;
    
    #[ORM\Column (options: ["default" => false])]
    private ?bool $hideInPageList = false;
    
    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'lft', type: Types::INTEGER)]
    private $lft;

    #[Gedmo\TreeLevel]
    #[ORM\Column(name: 'lvl', type: Types::INTEGER)]
    private $lvl;

    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'rgt', type: Types::INTEGER)]
    private $rgt;
    
    #[Gedmo\TreeRoot]
    #[ORM\ManyToOne(targetEntity: Article::class)]
    #[ORM\JoinColumn(name: 'tree_root', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $root;
    
    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: Article::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $parent;
    
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'parent')]
    #[ORM\OrderBy(['lft' => 'ASC'])]
    private $children;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        if (!$slug) $slug='';
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDt(): ?\DateTimeInterface
    {
        return $this->dt;
    }

    public function setDt(\DateTimeInterface $dt): static
    {
        $this->dt = $dt;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

        return $this;
    }
    
    public function getShowTitle(): ?bool {
        return $this->showTitle;
    }

    public function getShowChildren(): ?bool {
        return $this->showChildren;
    }

    public function setShowTitle(?bool $showTitle): static 
    {
        $this->showTitle = $showTitle;

        return $this;
    }

    public function setShowChildren(?bool $showChildren): static 
    {
        $this->showChildren = $showChildren;

        return $this;
    }

    public function getShowBreadcrumbs(): ?bool {
        return $this->showBreadcrumbs;
    }

    public function setShowBreadcrumbs(?bool $showBreadcrumbs): void {
        $this->showBreadcrumbs = $showBreadcrumbs;
    }
    
    public function getHideInPageList(): ?bool {
        return $this->hideInPageList;
    }

    public function setHideInPageList(?bool $hideInPageList): void {
        $this->hideInPageList = $hideInPageList;
    }

    public function getRoot(): ?self
    {
        return $this->root;
    }

    public function setParent(self $parent = null): void
    {
        $this->parent = $parent;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }
    
    public function getChildren() {
        return $this->children;
    }
    
    public function getLft() {
        return $this->lft;
    }

    public function getRgt() {
        return $this->rgt;
    }
    
    public function getSpacedName(): string
    {
        $result = '';
        for($i=0;$i<$this->lvl;$i++) $result = "->".$result;
        $result = $result.$this->title;
        return $result;
    }
    
    public function __toString(): string
    {
        return $this->getTitle();
    }
}
