<?php
 
namespace App\Enums;
 
enum ProductType: string
{
    case Pasteis = 'pasteis';
    case Bebidas = 'bebidas';
    case Sobremesas = 'sobremesas';
}