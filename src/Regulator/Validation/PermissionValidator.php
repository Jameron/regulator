<?php namespace Jameron\Regulator\Validation;

class PermissionValidator extends Validator {

	/**
	 * Validation rules for creating new \Jameron\Regulator\Models\Permission models.
	 *
	 * @var array
	 */
	static $rules = [
		'name' => 'required',
	];
}
