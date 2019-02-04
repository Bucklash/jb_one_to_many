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
		$event  =   ( isset( $options2['event'] ) && $field->state != 'disabled' ) ? $options2['event'] : 'afterStore';

		// Table and Fields
		$seblod  =   ( isset( $options2['seblod'] ) && $field->state != 'disabled' ) ? $options2['seblod'] : '1';
		$table  =   ( isset( $options2['table'] ) && $field->state != 'disabled' ) ? $options2['table'] : '#__cck_store_free_map';
		$content_type  =   ( isset( $options2['content_type'] ) && $field->state != 'disabled' ) ? $options2['content_type'] : 'map';
		$field_one_id  =   ( isset( $options2['field_one_id'] ) && $field->state != 'disabled' ) ? $options2['field_one_id'] : 'one_id';
		$field_one_name  =   ( isset( $options2['field_one_name'] ) && $field->state != 'disabled' ) ? $options2['field_one_name'] : 'one_name';
		$field_many_id  =   ( isset( $options2['field_many_id'] ) && $field->state != 'disabled' ) ? $options2['field_many_id'] : 'many_id';
		$field_many_name  =   ( isset( $options2['field_many_name'] ) && $field->state != 'disabled' ) ? $options2['field_many_name'] : 'many_name';
		// Separator
		$separator_many_id  =   ( isset( $options2['separator_many_id'] ) && $field->state != 'disabled' ) ? $options2['separator_many_id'] : ',';
		$separator_many_name  =   ( isset( $options2['separator_many_name'] ) && $field->state != 'disabled' ) ? $options2['separator_many_name'] : ',';
		
		// Array One
		$array_one  =   ( isset( $options2['array_one'] ) && $field->state != 'disabled' ) ? $options2['array_one'] : 'fields';
		$one_id_value_1 = ( isset( $options2['one_id_value_1'] ) && $field->state != 'disabled' ) ? $options2['one_id_value_1'] : $options2['one_id_value_1'];
		$one_id_value_2 = ( isset( $options2['one_id_value_2'] ) && $field->state != 'disabled' ) ? $options2['one_id_value_2'] : $options2['one_id_value_2'];
		$one_name_value_1 = ( isset( $options2['one_name_value_1'] ) && $field->state != 'disabled' ) ? $options2['one_name_value_1'] : $options2['one_name_value_1'];
		$one_name_value_2 = ( isset( $options2['one_name_value_2'] ) && $field->state != 'disabled' ) ? $options2['one_name_value_2'] : $options2['one_name_value_2'];
		
		// Array Many
		$array_many  =   ( isset( $options2['array_many'] ) && $field->state != 'disabled' ) ? $options2['array_many'] : 'fields';
		$many_id_value_1 = ( isset( $options2['many_id_value_1'] ) && $field->state != 'disabled' ) ? $options2['many_id_value_1'] : $options2['many_id_value_1'];
		$many_id_value_2 = ( isset( $options2['many_id_value_2'] ) && $field->state != 'disabled' ) ? $options2['many_id_value_2'] : $options2['many_id_value_2'];
		$many_name_value_1 = ( isset( $options2['many_name_value_1'] ) && $field->state != 'disabled' ) ? $options2['many_name_value_1'] : $options2['many_name_value_1'];
		$many_name_value_2 = ( isset( $options2['many_name_value_2'] ) && $field->state != 'disabled' ) ? $options2['many_name_value_2'] : $options2['many_name_value_2'];

		$isNew      =   ( $config['pk'] ) ? 0 : 1;
		// Validate
		parent::g_onCCK_FieldPrepareStore_Validation( $field, $name, $value, $config );

		// 
		$valid      =   1;
		// Add Process
		if ( $valid ) {
			parent::g_addProcess( $event, self::$type, $config, array(
				'isNew'=>$isNew,
				'event'=>$event,
				'seblod'=>$seblod,
				'table'=>$table,
				'content_type'=>$content_type,
				'field_one_id'=>$field_one_id,
				'field_one_name'=>$field_one_name,
				'field_many_id'=>$field_many_id,
				'field_many_name'=>$field_many_name,
				'array_one'=>$array_one,
				'one_id_value_1'=>$one_id_value_1,
				'one_id_value_2'=>$one_id_value_2,
				'one_name_value_1'=>$one_name_value_1,
				'one_name_value_2'=>$one_name_value_2,
				'array_many'=>$array_many,
				'many_id_value_1'=>$many_id_value_1,
				'many_id_value_2'=>$many_id_value_2,
				'many_name_value_1'=>$many_name_value_1,
				'many_name_value_2'=>$many_name_value_2,
				'separator_many_id'=>$separator_many_id,
				'separator_many_name'=>$separator_many_name,
				'valid'=>$valid
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
		self::_jbOneToMany($process, $fields);
	}
	
	// onCCK_FieldAfterStore
	public static function onCCK_FieldAfterStore( $process, &$fields, &$storages, &$config = array() )
	{
        self::_jbOneToMany($process, $fields);
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Stuff & Script
	
	/*
    *
    * 
    *
    */
    protected static function _jbOneToMany($process, &$fields)
    {

		// 'isNew'=>
		$isNew = $process['isNew'];
		// 'event'=>
		$event = $process['event'];
		// 'seblod'=>
		$seblod = $process['seblod'];
		// 'table'=>
		$table = $process['table'];
		// 'content_type'=>
		$content_type = $process['content_type'];
		// 'field_one_id'=>
		$field_one_id = $process['field_one_id'];
		// 'field_one_name'=>
		$field_one_name = $process['field_one_name'];
		// 'field_many_id'=>
		$field_many_id = $process['field_many_id'];
		// 'field_many_name'=>
		$field_many_name = $process['field_many_name'];
		// 'array_one'=>
		$array_one = $process['array_one'];
		// 'one_id_value_1'=>
		$one_id_value_1 = $process['one_id_value_1'];
		// 'one_id_value_2'=>
		$one_id_value_2 = $process['one_id_value_2'];
		// 'one_name_value_1'=>
		$one_name_value_1 = $process['one_name_value_1'];
		// 'one_name_value_2'=>
		$one_name_value_2 = $process['one_name_value_2'];
		// 'array_many'=>
		$array_many = $process['array_many'];
		// 'many_id_value_1'=>
		$many_id_value_1 = $process['many_id_value_1'];
		// 'many_id_value_2'=>
		$many_id_value_2 = $process['many_id_value_2'];
		// 'many_name_value_1'=>
		$many_name_value_1 = $process['many_name_value_1'];
		// 'many_name_value_2'=>
		$many_name_value_2 = $process['many_name_value_2'];

		// get values of fields based on settings defined in plugin
		switch ($array_one)
		{
			case 'fields':
				$one_id = $fields[$one_id_value_1]->$one_id_value_2;
				$one_name = $fields[$one_name_value_1]->$one_name_value_2;
				break;
			case 'config':
				$one_id = $config['storages'][$one_id_value_1][$one_id_value_2];
				$one_name = $config['storages'][$one_name_value_1][$one_name_value_2];
				break;
			case 'cck':
				$one_id = $cck->get{$one_id_value_1}($one_id_value_2);
				$one_name = $cck->get{$one_name_value_1}($one_name_value_2);
				break;
			case 'value':
				$one_id = $one_id_value_1;
				$one_name = $one_name_value_1;
				break;
			default:
				$one_id = $fields[$one_id_value_1]->$one_id_value_2;
				$one_name = $fields[$one_name_value_1]->$one_name_value_2;	
		}
		
		switch ($array_many)
		{
			case 'fields':
				$many_id = $fields[$many_id_value_1]->$many_id_value_2;
				$many_name = $fields[$many_name_value_1]->$many_name_value_2;
				break;
			case 'config':
				$many_id = $config['storages'][$many_id_value_1][$many_id_value_2];
				$many_name = $config['storages'][$many_name_value_1][$many_name_value_2];
				break;
			case 'cck':
				$many_id = $cck->get{$many_id_value_1}($many_id_value_2);
				$many_name = $cck->get{$many_name_value_1}($many_name_value_2);
				break;
			case 'value':
				$many_id = $many_id_value_1;
				$many_name = $many_name_value_1;
				break;
			default:
				$many_id = $fields[$many_id_value_1]->$many_id_value_2;
				$many_name = $fields[$many_name_value_1]->$many_name_value_2;	
		}

		// if new data is not in old data = add
		// if old data is not in new data = delete

		// get 'new' data from form
		$new['many_ids'] = explode($separator_many_id, $many_id); 
		$new['many_names'] = explode($separator_many_name, $many_name); 
		
		// get 'old' data from db (where name of one AND many are correct)
		$content = new JCckContentFree; 
		$data      = array( 
			$field_one_id=>$one_id, 
			$field_one_name=>$one_name,
			$field_many_name=>$many_name
		);
		$old['pks'] = $content->search( $content_type, $data )->findPks();
		// get 'many_id' from each 'old' $pks
		foreach ( $old['pks'] as $key => $pk )
		{
			
			if ( $content->load( $pk )->isSuccessful() ) 
			{ 

				$old['many_ids'][$key] = $content->get($field_many_id);
	
			}	
			
		} 


		// NOW ADD OR DELETE MAP DATA
		
		// DELETE
		foreach ( $old['many_ids'] as $key => $id ) 
		{ 

			if ( !in_array($id, $new['many_ids']) )
			{

				$content->delete( $old['pks'][$key] );

			}
			
		} 

		// ADD
		foreach ( $new['many_ids'] as $key => $id) 
		{ 

			if (!in_array($id, $old['many_ids']))
			{

				$data      = array( 
					$field_one_id=>$one_id,
					$field_one_name=>$one_name,
					$field_many_id=>$id,
					$field_many_name=>$new['many_names'][$key]
				); 
				$message = $field_one_id;
				JFactory::getApplication()->enqueueMessage($message , 'onCCK_FieldAfterStore');
				switch ($seblod) 
				{
					case '0':
						// if table use Joomla!...
						// Create and populate an object.
						$content = new stdClass();
						$content->$field_one_id = $one_id;
						$content->$field_one_name = $one_name;
						$content->$field_many_id = $id;
						$content->$field_many_name = $new['many_names'][$key];

						// Insert the object into the user profile table.
						$result = JFactory::getDbo()->insertObject($table, $content);
						break;
					case '1':
						// if content type use Seblod...
						if ( $content->create( $content_type, $data )->isSuccessful() ) 
						{ 
							// Do something 
						}
						break;
					
					default:
						if ( $content->create( $content_type, $data )->isSuccessful() ) 
						{ 
							// Do something 
						}
						break;
				}

			}	
			
		} 

    }
	//
}