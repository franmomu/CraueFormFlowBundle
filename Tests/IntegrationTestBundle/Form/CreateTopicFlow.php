<?php

namespace Craue\FormFlowBundle\Tests\IntegrationTestBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2018 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class CreateTopicFlow extends FormFlow {

	protected $allowDynamicStepNavigation = true;

	/**
	 * {@inheritDoc}
	 */
	protected function loadStepsConfig() {
		return array(
			array(
				'label' => 'basics',
				'form_type' => CreateTopicForm::class,
			),
			array(
				'label' => 'comment',
				'form_type' => CreateTopicForm::class,
			),
			array(
				'label' => 'bug_details',
				'form_type' => CreateTopicForm::class,
				'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
					return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->isBugReport();
				},
			),
			array(
				'label' => 'confirmation',
			),
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getFormOptions($step, array $options = array()) {
		$options = parent::getFormOptions($step, $options);

		if ($step === 3) {
			$options['isBugReport'] = $this->getFormData()->isBugReport();
		}

		return $options;
	}

}
