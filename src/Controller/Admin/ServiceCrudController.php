<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new("name"),
            Field::new("shortDescription"),
            Field::new("summary"),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setRequired(false)
        ];
    }
}
