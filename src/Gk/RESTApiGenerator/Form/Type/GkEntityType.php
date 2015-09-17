<?php


namespace Gk\RESTApiGenerator\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Gk\RESTApiGenerator\Form\DataTransformer\ArrayToIdTransformer;

/**
 * Class GkEntityType
 * @package Gk\RESTApiGenerator\Form\Type
 */
class GkEntityType extends EntityType
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $view_transformer = new ArrayToIdTransformer($this->em, null);
        $builder->addViewTransformer($view_transformer);
//        $model_transformer = new UserToUsernameTransformer()
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'invalid_message' => 'The selected entity does not exist',
            )
        );
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gk_entity';
    }
}
