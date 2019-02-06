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

		$isNew      =   ( $config['pk'] ) ? 0 : 1;

		// Event
		$event  =   ( isset( $options2['event'] ) ) ? $options2['event'] : 'afterStore';
		
		// Table and DB Fields
		$object  =   ( isset( $options2['object'] ) ) ? $options2['object'] : 'Free';
		$content_type  =   ( isset( $options2['content_type'] ) ) ? $options2['content_type'] : '';
		$table  =   ( isset( $options2['table'] ) ) ? $options2['table'] : '';
		$field_one_id  =   ( isset( $options2['field_one_id'] ) ) ? $options2['field_one_id'] : 'one_id';
		$field_one_name  =   ( isset( $options2['field_one_name'] ) ) ? $options2['field_one_name'] : 'one_name';
		$field_many_id  =   ( isset( $options2['field_many_id'] ) ) ? $options2['field_many_id'] : 'many_id';
		$field_many_name  =   ( isset( $options2['field_many_name'] ) ) ? $options2['field_many_name'] : 'many_name';
		// Separator
		$separator_many_id  =   ( isset( $options2['separator_many_id'] ) ) ? $options2['separator_many_id'] : ',';
		$separator_many_name  =   ( isset( $options2['separator_many_name'] ) ) ? $options2['separator_many_name'] : ',';
			
		// Array One
		$array_one  =   ( isset( $options2['array_one'] ) ) ? $options2['array_one'] : 'fields';
		$one_id_value_1 = ( isset( $options2['one_id_value_1'] ) ) ? $options2['one_id_value_1'] : $options2['one_id_value_1'];
		$one_id_value_2 = ( isset( $options2['one_id_value_2'] ) ) ? $options2['one_id_value_2'] : $options2['one_id_value_2'];
		$one_name_value_1 = ( isset( $options2['one_name_value_1'] ) ) ? $options2['one_name_value_1'] : $options2['one_name_value_1'];
		$one_name_value_2 = ( isset( $options2['one_name_value_2'] ) ) ? $options2['one_name_value_2'] : $options2['one_name_value_2'];
		
		// Array Many
		$array_many  =   ( isset( $options2['array_many'] ) ) ? $options2['array_many'] : 'fields';
		$many_id_value_1 = ( isset( $options2['many_id_value_1'] ) ) ? $options2['many_id_value_1'] : $options2['many_id_value_1'];
		$many_id_value_2 = ( isset( $options2['many_id_value_2'] ) ) ? $options2['many_id_value_2'] : $options2['many_id_value_2'];
		$many_name_value_1 = ( isset( $options2['many_name_value_1'] ) ) ? $options2['many_name_value_1'] : $options2['many_name_value_1'];
		$many_name_value_2 = ( isset( $options2['many_name_value_2'] ) ) ? $options2['many_name_value_2'] : $options2['many_name_value_2'];

		// 
		$valid      =   1;

		// Validate
		parent::g_onCCK_FieldPrepareStore_Validation( $field, $name, $value, $config );

		// Add Process
		if ( $valid ) {
			parent::g_addProcess( $event, self::$type, $config, array(
				'isNew'=>$isNew,
				'event'=>$event,
				'object'=>$object,
				'content_type'=>$content_type,
				'table'=>$table,
				'field_one_id'=>$field_one_id,
				'field_one_name'=>$field_one_name,
				'field_many_id'=>$field_many_id,
				'field_many_name'=>$field_many_name,
				'separator_many_id'=>$separator_many_id,
				'separator_many_name'=>$separator_many_name,
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
		// 'object'=>
		$object = $process['object'];
		// 'content_type'=>
		$content_type = $process['content_type'];
		// 'table'=>
		$table = $process['table'];
		// 'field_one_id'=>
		$field_one_id = $process['field_one_id'];
		// 'field_one_name'=>
		$field_one_name = $process['field_one_name'];
		// 'field_many_id'=>
		$field_many_id = $process['field_many_id'];
		// 'field_many_name'=>
		$field_many_name = $process['field_many_name'];
		// 'separator_many_id'=>
		$separator_many_id = $process['separator_many_id'];
		// 'separator_many_name'=>
		$separator_many_name = $process['separator_many_name'];
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
		// arrays used to do stuff, 'new' is from form, 'old' is from db
		$new['many_ids'] = array();
		$new['many_names'] = array();
		$old['many_pks'] = array();
		$old['many_ids'] = array();
		$old['many_names'] = array();

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

		// Get many ID's
		
		// ... from form as 'new'
		$new['many_ids'] = explode($separator_many_id, $many_id);

		// ... from db as 'old'
		// Seblod and Joomla! have different methods...
		switch ($object) 
		{
			case 'Joomla':
				# code...
				$content = new stdClass();
				break;
			case 'Free':
				# code...
				$content = new JCckContentFree;
				$content->setTable( $table );
				break;
			case 'Article':
				$content = new JCckContentArticle;
				# code...
				break;
			case 'Category':
				$content = new JCckContentCategory;
				# code...
				break;
			case 'UserNote':
				$content = new JCckContentUserNote;
				# code...
				break;
			case 'User':
				$content = new JCckContentUser;
				# code...
				break;
			case 'UserGroup':
				$content = new JCckContentUserGroup;
				# code...
				break;
				
			default:
				# code...
				$content = new JCckContentFree;
				$content->setTable( $table );
				break;
		}

		if ($object === 'Joomla') 
		{
			// TODO
			// Get 'old' data from DB

			// ADD
			// TODO
			// $content->$field_one_id = $one_id;
			// $content->$field_one_name = $one_name;
			// $content->$field_many_id = $id;
			// $content->$field_many_name = $many_name;
			
			// Insert the object into the user profile table.
			// $result = JFactory::getDbo()->insertObject($table, $content);

			// DELETE
			// TODO
		} 
		else
		{
			// Get 'old' data from DB
			$data = array( 
				$field_one_id=>$one_id, 
				$field_one_name=>$one_name,
				$field_many_name=>$many_name
			);

			foreach ( $content->find( $content_type, $data )->getPks() as $key => $pk ) 
			{ 

				if ( $content->load( $pk )->isSuccessful() ) 
				{ 
					// Get each many_id and assign to array
					$old['many_ids'][$key] = $content->get($field_many_id);
					$old['many_pks'][$key] = $pk;
				}	
			} 

			// NOW ADD OR DELETE MAP DATA
			// DELETE
			if (count($old['many_ids']) > 0)
			{
				foreach ( $old['many_ids'] as $key => $id ) 
				{ 
					if ( !in_array($id, $new['many_ids']) )
					{
						// delete requires $pk
						$content->delete( $old['many_pks'][$key] );	
						
					}
				} 
			}
			// ADD
			if (count($new['many_ids']) > 0)
			{
				foreach ( $new['many_ids'] as $key => $id) 
				{ 
					if (!in_array($id, $old['many_ids']))
					{
						$data      = array( 
							$field_one_id=>$one_id,
							$field_one_name=>$one_name,
							$field_many_id=>$id,
							$field_many_name=>$many_name
						); 
	
						// Create
						if ( $content->create( $content_type, $data )->isSuccessful() ) 
						{ 
							$message = 'Stored '.$one_name.' with '.$many_name.', id of '.$id;
							JFactory::getApplication()->enqueueMessage($message , 'success');
						}
						else 
						{
							$message = 'Not stored '.$one_name.' with '.$many_name.', id of '.$id;
							$message .=  $content->getLog();
							JFactory::getApplication()->enqueueMessage($message , 'success');
						}
					}
				} 
			} //--ADD
		}
    } // --_jbOneToMany
}