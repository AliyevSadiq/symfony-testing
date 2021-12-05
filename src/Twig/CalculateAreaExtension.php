<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CalculateAreaExtension extends AbstractExtension
{


    public function getFunctions(): array
    {
        return [
            new TwigFunction('calculate_area', [$this, 'calculateArea']),
        ];
    }

    public function calculateArea($width,$height): float|int
    {
        return $width*$height;
    }
}
