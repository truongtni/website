<?php
class Redux_Validation_css extends ReduxFrameworkNew {	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since ReduxFrameworkNew 1.0.0
	*/
	function __construct($field, $value, $current) {
		
		parent::__construct();
		$this->field = $field;
		$this->value = $value;
		$this->current = $current;
		$this->validate();
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and validates them
	 *
	 * @since ReduxFrameworkNew 3.0.0
	*/
	function validate() {
		
		// Strip all html
		$this->value = wp_filter_nohtml_kses($this->value);
				
	}//function
	
}//class
