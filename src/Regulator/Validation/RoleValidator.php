<?php namespace Jameron\Regulator\Validation;

class RoleValidator extends Validator {

	/**
	 * Validation rules for creating new Jameron\Regulator\Models\Role models.
	 *
	 * @var array
	 */
	static $rules = [
		'name' => 'required',
	];
}
