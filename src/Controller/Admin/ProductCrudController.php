<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{   
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldname('name'),//creér à partir du champs name
            TextEditorField::new('description'),
            TextEditorField::new('moreInformations')->hideOnindex(),//Cacher au liste
            MoneyField::new('Price')->setCurrency('USD'),
            IntegerField::new('quantity'),
            TextField::new('tags'),
            BooleanField::new('isBestSeller', 'Best seller'),//2eme parametre redefinition de label
            BooleanField::new('isNewArrival', 'New arrival'),
            BooleanField::new('isFeatured', 'Featured'),
            BooleanField::new('isSpecialoffer', 'Special offer'),
            AssociationField::new('category', 'Categories'),
            ImageField::new('image')->setBasePath('/assets/uploads/products')
                                    ->setUploadDir("public/assets/uploads/products")
                                    ->setUploadedFileNamePattern('[randomhash].[extension]')
                                    ->setRequired(false)
        ];
    }
    
}
