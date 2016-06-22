<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 01/04/16
 * Time: 18:09
 */

namespace MRS\ControleBundle\Service;



use Symfony\Component\DependencyInjection\ContainerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;


class GenerateDirService implements DirectoryNamerInterface
{

    private $container;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function generateId()
    {
        return $this->container->get('doctrine')
                    ->getRepository('MRSControleBundle:Product')
                    ->getMaxIdProduct();
    }

    /**
     * Creates a directory name for the file being uploaded.
     *
     * @param object $object The object the upload is attached to.
     * @param PropertyMapping $mapping The mapping to use to manipulate the given object.
     *
     * @return string The directory name.
     */
    public function directoryName($object, PropertyMapping $mapping)
    {
        if($object->getId() == null){
            return $this->generateId();
        }else{
            return $object->getId();
        }
    }
}