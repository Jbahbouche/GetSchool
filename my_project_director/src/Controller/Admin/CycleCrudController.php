<?php

namespace App\Controller\Admin;

use App\Entity\Cycle;
use App\Controller\Admin\CycleCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CycleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cycle::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            
        ];
    }
   
}
