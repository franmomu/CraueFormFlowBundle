<?php

namespace Craue\FormFlowBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Konstantin Myakshin <koc-dp@yandex.ru>
 * @copyright 2011-2015 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class FormFlowFormExtension extends AbstractTypeExtension {

	/**
	 * {@inheritDoc}
	 */
	public function getExtendedType() {
		return 'form';
	}

	/**
	 * {@inheritDoc}
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$optionNames = array(
			'flow_step',
			'flow_step_key',
		);

		if (version_compare(Kernel::VERSION, '2.6', '>=')) {
			$resolver->setDefined($optionNames);
		} else {
			$resolver->setOptional($optionNames);
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		if (array_key_exists('flow_step', $options) && array_key_exists('flow_step_key', $options)) {
			$builder->add($options['flow_step_key'], 'hidden', array(
				'data' => $options['flow_step'],
				'mapped' => false,
				'flow_step_key' => $options['flow_step_key'],
			));
		}
	}

}
