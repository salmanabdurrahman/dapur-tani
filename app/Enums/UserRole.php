<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPERADMIN = 'superadmin';
    case SUPPLIER = 'supplier';
    case BUYER = 'buyer';
}