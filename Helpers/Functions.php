<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 20.08.13
 * Time: 21:03
  */

namespace Itfrogs\SiteBundle\Helpers;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Functions
{
    protected $em;
    protected $qb;
    protected  $container;

    /**
     * {@inheritDoc}
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->qb = $this->em->createQueryBuilder();
    }

    function getSlug($phrase){


        if (function_exists("transliterator_transliterate")) {
            $result = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $phrase);
        }
        else {
            $result = $this->rus2translit($phrase);
        }
        $result = preg_replace('/[^A-Za-z0-9-]+/', '-', $result);
        $result = str_replace(array('/', '+', '.', '&amp;', '&', '$', "`"), ' ', $result);
        $result = str_replace(array('ë','é', 'è'), 'e', $result);
        $result = trim(substr($result, 0, 100));
        $result = preg_replace('/[-\s]+/', '-', $result);
        return trim($result, '-');
    }

    function rus2translit($string) {

        $converter = array(

            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'h',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

            'И' => 'I',   'Й' => 'Y',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

        );

        return strtr($string, $converter);

    }



    public function twigRender() {
        return $this->twig->render(
            "Hello {{ name }}",
            array("name" => "World")
        );
    }

}
