<?php

namespace Craue\FormFlowBundle\Tests\IntegrationTestBundle\Form;

use Craue\FormFlowBundle\Tests\IntegrationTestBundle\Entity\Issue64SubData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2018 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Issue64Form extends AbstractType {

	/**
	 * {@inheritDoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		switch ($options['flow_step']) {
			case 1:
				$subForm = $builder->create('sub', FormType::class, array(
					'data_class' => Issue64SubData::class,
				));
				$subForm->add('prop1', TextType::class, array(
					'required' => true,
				));
				$builder->add($subForm);
				break;
			case 2:
			case 3:
				$subForm = $builder->create('sub', FormType::class, array(
					'data_class' => Issue64SubData::class,
				));
				$subForm->add('prop2', TextType::class, array(
					'required' => true,
				));
				$builder->add($subForm);
				break;
			case 4:
				// nothing
				break;
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName() {
		return $this->getBlockPrefix();
	}

	/**
	 * {@inheritDoc}
	 */
	public function getBlockPrefix() {
		return 'issue64';
	}

}
