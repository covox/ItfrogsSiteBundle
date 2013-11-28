<?php

namespace Itfrogs\SiteBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
#use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use CG\Core\ClassUtils;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;


class ItfrogsExtension extends \Twig_Extension
{
    public $container;
    public $em;
    protected $controller;


    /*
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('doctrine.orm.entity_manager');
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'code' => new \Twig_Function_Method($this, 'getCode', array('is_safe' => array('html'))),
            'settings' => new \Twig_Function_Method($this, 'getSettings'),
        );
    }

    public function getCode($template)
    {
        $controller = htmlspecialchars($this->getControllerCode(), ENT_QUOTES, 'UTF-8');
        $template = htmlspecialchars($this->getTemplateCode($template), ENT_QUOTES, 'UTF-8');

        // remove the code block
        $template = str_replace('{% set code = code(_self) %}', '', $template);

        return <<<EOF
<p><strong>Controller Code</strong></p>
<pre>$controller</pre>

<p><strong>Template Code</strong></p>
<pre>$template</pre>
EOF;
    }

    public function getSettings($name)
    {
        return  $this->em->getRepository('ItfrogsSiteBundle:Settings')->findOneByName($name)->getValue();

    }

    protected function getControllerCode()
    {
        $class = get_class($this->controller[0]);
        if (class_exists('CG\Core\ClassUtils')) {
            $class = ClassUtils::getUserClass($class);
        }

        $r = new \ReflectionClass($class);
        $m = $r->getMethod($this->controller[1]);

        $code = file($r->getFilename());

        return '    '.$m->getDocComment()."\n".implode('', array_slice($code, $m->getStartline() - 1, $m->getEndLine() - $m->getStartline() + 1));
    }

    protected function getTemplateCode($template)
    {
//        var_dump($template->getTemplateName());
//        return $this->loader->getSource($template->getTemplateName());
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'itfrogs_extension';
    }

    public function getFilters()
    {
        return array(
            'price' => new \Twig_Filter_Method($this, 'priceFilter'),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ' ')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
//        $price = '$' . $price;

        return $price;
    }
}
