<?php
/**
* @version 			SEBLOD 3.x More
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// Plugin
class plgCCK_FieldJb_One_To_Many extends JCckPluginField
{
	protected static $type		=	'jb_one_to_many';
	protected static $path;
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Construct
	
	// onCCK_FieldConstruct
	public function onCCK_FieldConstruct( $type, &$data = array() )
	{
		if ( self::$type != $type ) {
			return;
		}
		parent::g_onCCK_FieldConstruct( $data );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
	
	// onCCK_FieldPrepareContent
	public function onCCK_FieldPrepareContent( &$field, $value = '', &$config = array() )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		parent::g_onCCK_FieldPrepareContent( $field, $config );
		
		// Set
		$field->value	=	$value;
	}
	
	// onCCK_FieldPrepareForm
	public function onCCK_FieldPrepareForm( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		self::$path	=	parent::g_getPath( self::$type.'/' );
		parent::g_onCCK_FieldPrepareForm( $field, $config );
		
		// Init
		if ( count( $inherit ) ) {
			$id		=	( isset( $inherit['id'] ) && $inherit['id'] != '' ) ? $inherit['id'] : $field->name;
			$name	=	( isset( $inherit['name'] ) && $inherit['name'] != '' ) ? $inherit['name'] : $field->name;
		} else {
			$id		=	$field->name;
			$name	=	$field->name;
		}
		$value		=	( $value != '' ) ? $value : $field->defaultvalue;
		$value		=	( $value != ' ' ) ? $value : '';
		$value		=	htmlspecialchars( $value );
		
		// Validate
		$validate	=	'';
		if ( $config['doValidation'] > 1 ) {
			plgCCK_Field_ValidationRequired::onCCK_Field_ValidationPrepareForm( $field, $id, $config );
			parent::g_onCCK_FieldPrepareForm_Validation( $field, $id, $config );
			$validate	=	( count( $field->validate ) ) ? ' validate['.implode( ',', $field->validate ).']' : '';
		}
		
		// Prepare
		$class	=	'inputbox text'.$validate . ( $field->css ? ' '.$field->css : '' );
		$maxlen	=	( $field->maxlength > 0 ) ? ' maxlength="'.$field->maxlength.'"' : '';
		$attr	=	'class="'.$class.'" size="'.$field->size.'"'.$maxlen . ( $field->attributes ? ' '.$field->attributes : '' );
		$form	=	'<input type="text" id="'.$id.'" name="'.$name.'" value="'.$value.'" '.$attr.' />';
		
		// Set
		if ( ! $field->variation ) {
			$field->form	=	$form;
			if ( $field->script ) {
				parent::g_addScriptDeclaration( $field->script );
			}
		} else {
			parent::g_getDisplayVariation( $field, $field->variation, $value, $value, $form, $id, $name, '<input', '', '', $config );
		}
		$field->value	=	$value;
		
		// Return
		if ( $return === true ) {
			return $field;
		}
	}
	
	// onCCK_FieldPrepareSearch
	public function onCCK_FieldPrepareSearch( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		
		// Prepare
		self::onCCK_FieldPrepareForm( $field, $value, $config, $inherit, $return );
		
		// Return
		if ( $return === true ) {
			return $field;
		}
	}
	
	// onCCK_FieldPrepareStore
	public function onCCK_FieldPrepareStore( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		
		// Init
		if ( count( $inherit ) ) {
			$name	=	( isset( $inherit['name'] ) && $inherit['name'] != '' ) ? $inherit['name'] : $field->name;
		} else {
			$name	=	$field->name;
		}
	
		$options2   =   JCckDev::fromJSON( $field->options2 );

		// Event
		$event  =   ( isset( $options2['event'] ) && $field->state != 'disabled' ) ? $options2['event'] : 'afterstore';

		// Content Type
		$content_type  =   ( isset( $options2['content_type'] ) && $field->state != 'disabled' ) ? $options2['content_type'] : '#__cck_store_free_map';
		
		// Table
		// $table  =   ( isset( $options2['table'] ) && $field->state != 'disabled' ) ? $options2['table'] : '#__cck_store_free_map';
		$field_one_id  =   ( isset( $options2['field_one_id'] ) && $field->state != 'disabled' ) ? $options2['field_one_id'] : 'one_id';
		$field_one_name  =   ( isset( $options2['field_one_name'] ) && $field->state != 'disabled' ) ? $options2['field_one_name'] : 'one_name';
		$field_many_id  =   ( isset( $options2['field_many_id'] ) && $field->state != 'disabled' ) ? $options2['field_many_id'] : 'many_id';
		$field_many_name  =   ( isset( $options2['field_many_name'] ) && $field->state != 'disabled' ) ? $options2['field_many_name'] : 'many_name';
		
		// Array
		$array_one  =   ( isset( $options2['array_one'] ) && $field->state != 'disabled' ) ? $options2['array_one'] : 'fields';
		$array_many  =   ( isset( $options2['array_many'] ) && $field->state != 'disabled' ) ? $options2['array_many'] : 'fields';
		
		switch ($array_one) 
		{
			// $fields
			case 'field':				
			$one_id = $fields[$fields_name_one_id]->$fields_attribute_one_id;				
			$one_name = $fields[$fields_name_one_name]->$fields_attribute_one_name;	
			break;
			
			// $config
			case 'config':
			$one_id = $config['storages'][$config_table_one_id]->$config_field_one_id;		
			$one_name = $config['storages'][$config_table_one_name]->$config_field_one_name;	
			break;
			
			default:
			$one_id = $fields[$fields_name_one_id]->$fields_attribute_one_id;				
			$one_name = $fields[$fields_name_one_name]->$fields_attribute_one_name;	
			break;
		}
		
		switch ($array_many) 
		{
			// $fields
			case 'field':					
			$many_id = $fields[$fields_name_many_id]->$fields_attribute_many_id;				
			$many_name = $fields[$fields_name_many_name]->$fields_attribute_many_name;		
			break;
			
			// $config
			case 'config':			
			$many_id = $config['storages'][$config_table_many_id]->$config_field_many_id;		
			$many_name = $config['storages'][$config_table_many_name]->$config_field_many_name;		
			break;
			
			default:	
			$many_id = $fields[$fields_name_many_id]->$fields_attribute_many_id;				
			$many_name = $fields[$fields_name_many_name]->$fields_attribute_many_name;		
			break;
		}
		
		// Seperator
		$seperator_many_id  =   ( isset( $options2['seperator_many_id'] ) && $field->state != 'disabled' ) ? $options2['seperator_many_id'] : ',';
		$seperator_many_name  =   ( isset( $options2['seperator_many_name'] ) && $field->state != 'disabled' ) ? $options2['seperator_many_name'] : ',';
		
		// Validate
		parent::g_onCCK_FieldPrepareStore_Validation( $field, $name, $value, $config );
		
		// Add Process
		if ( $valid ) {
			parent::g_addProcess( $event, self::$type, $config, array(
				'event'=>$event,
				'field_one_id'=>$field_one_id,
				'field_one_name'=>$field_one_name,
				'field_many_id'=>$field_many_id,
				'field_many_name'=>$field_many_name,
				'one_id'=>$one_id,
				'one_name'=>$one_name,
				'many_id'=>$many_id,
				'many_name'=>$many_name,
				'seperator_many_id'=>$seperator_many_id,
				'seperator_many_name'=>$seperator_many_name
				// 'valid'=>$valid
			));
		}

		// Set or Return
		if ( $return === true ) {
			return $value;
		}
		$field->value	=	$value;


		parent::g_onCCK_FieldPrepareStore( $field, $name, $value, $config );


	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Render
	
	// onCCK_FieldRenderContent
	public static function onCCK_FieldRenderContent( $field, &$config = array() )
	{
		return parent::g_onCCK_FieldRenderContent( $field );
	}
	
	// onCCK_FieldRenderForm
	public static function onCCK_FieldRenderForm( $field, &$config = array() )
	{
		return parent::g_onCCK_FieldRenderForm( $field );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Special Events
	
	// onCCK_FieldBeforeRenderContent
	public static function onCCK_FieldBeforeRenderContent( $process, &$fields, &$storages, &$config = array() )
	{
	}
	
	// onCCK_FieldBeforeRenderForm
	public static function onCCK_FieldBeforeRenderForm( $process, &$fields, &$storages, &$config = array() )
	{
	}
	
	// onCCK_FieldBeforeStore
	public static function onCCK_FieldBeforeStore( $process, &$fields, &$storages, &$config = array() )
	{
		self::_jbOneToMany($process);
	}
	
	// onCCK_FieldAfterStore
	public static function onCCK_FieldAfterStore( $process, &$fields, &$storages, &$config = array() )
	{

        self::_jbOneToMany($process);

	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Stuff & Script
	
	/*
    *
    * 
    *
    */
    // protected static function _jbMapProcess( &$pdf, $data, $serialized = 0)
    protected static function _jbOneToMany($process)
    {


		// GET ARRAYS SORTED FIRST
		// get array of new 'many_ids'
		// get array of old 'many_ids'

		$many_ids['new'] = explode($process['seperator_many_id'], $process['many_id']); 


		$content = new JCckContentFree; 
		$data      = array( 
						$process['field_one_id']=>$process['one_id'], 
						$process['field_one_name']=>$process['one_name']
					); 
		
		$map_pks['old'] = $content->search( $process['content_type'], $data )->findPks();

		foreach ( $map_pks['old'] as $key => $pk ) 
		{
			
			if ( $content->load( $pk )->isSuccessful() ) 
			{ 

				$many_ids['old'][$key] = $content->get($process['field_many_id']);
	
			}	
			
		} 

		// NOW ADD OR DELETE MAP DATA
		
		// DELETE
		foreach ( $many_ids['old'] as $key => $id ) 
		{ 

			if ( !in_array($id, $many_ids['new']) )
			{

				$content->delete( $map_pks['old'][$key] );

			}
			
		} 

		// ADD
		foreach ( $many_ids['new'] as $key => $id) 
		{ 

			if (!in_array($id, $many_ids['old']))
			{

				$data      = array( 
					$process['field_one_id']=>$process['one_id'],
					$process['field_one_name']=>$process['one_name'],
					$process['field_many_id']=>$id,
					$process['field_many_name']=>$process['many_name']
				); 

				if ( $content->create( $content_type, $data )->isSuccessful() ) 
				{ 
					// Do something 
				}

			}	
			
		} 

    }
	//
}