<?php

namespace App\Twig;

use App\Controller\BaseController;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $setting;

    public function __construct(BaseController $baseController)
    {
        $this->setting = $baseController->getSetting();
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getSetting', [$this, 'getSetting']),
        ];
    }

    public function getSetting()
    {
        return $this->setting;
    }
}
