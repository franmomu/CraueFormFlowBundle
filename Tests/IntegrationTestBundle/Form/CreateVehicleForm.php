<?php

namespace Craue\FormFlowBundle\Tests\IntegrationTestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2018 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class CreateVehicleForm extends AbstractType {

	/**
	 * {@inheritDoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$defaultChoiceOptions = array();

		switch ($options['flow_step']) {
			case 1:
				$choices = array(2, 4);
				$builder->add('numberOfWheels', ChoiceType::class, array_merge($defaultChoiceOptions, array(
					'choices' => array_combine($choices, $choices),
					'placeholder' => '',
				)));
				break;
			case 2:
				$choices = array(
					'electric',
					'gas',
					'naturalGas',
				);
				$builder->add('engine', ChoiceType::class, array_merge($defaultChoiceOptions, array(
					'choices' => array_combine($choices, $choices),
					'placeholder' => '',
				)));
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
		return 'createVehicle';
	}

}
