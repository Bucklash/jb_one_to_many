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
		// send = if 'never/0', override with value forfrom send_field
		// send_field = expects same options as send i.e form field 'core_options_from_param'
		$send  =   ( isset( $options2['send'] ) ) ? $options2['send'] : 0;
		$send_field	=	( isset( $options2['send_field'] ) && strlen( $options2['send_field'] ) > 0 ) ? $options2['send_field'] : 0;
		$sender	=	0;
		switch ( $send ) 
		{
			case 0:
				$sender	=	0;
				break;
			case 1:
				if ( !$config['pk'] ) 
				{
					$sender	=	1;
				}
				break;
			case 2:
				if ( $config['pk'] ) 
				{
					$sender	=	1;
				}
				break;
			case 3:
				$sender	=	1;
				break;
		}

		$valid = 1; // ?? when is it not valid? what am I checking?

		// Event
		$event  =   ( isset( $options2['event'] ) ) ? $options2['event'] : 'afterStore';
		
		// Table and DB Fields
		// These are the default values, set by you for Onject, database column names, data separators etc
		$object  =   ( isset( $options2['object'] ) ) ? $options2['object'] : 'Free';
		$content_type  =   ( isset( $field->extended ) ) ? $field->extended : '';
		$table  =   ( isset( $options2['table'] ) ) ? $options2['table'] : '';
		$table_pk  =   ( isset( $options2['table_pk'] ) ) ? $options2['table_pk'] : '';
		$field_one_id  =   ( isset( $options2['field_one_id'] ) ) ? $options2['field_one_id'] : 'one_id';
		$field_one_name  =   ( isset( $options2['field_one_name'] ) ) ? $options2['field_one_name'] : 'one_name';
		$field_many_id  =   ( isset( $options2['field_many_id'] ) ) ? $options2['field_many_id'] : 'many_id';
		$field_many_name  =   ( isset( $options2['field_many_name'] ) ) ? $options2['field_many_name'] : 'many_name';
		$invert = ( isset( $options2['invert'] ) ) ? $options2['invert'] : 0; // are you in the 'many' content type
		$separator  =   ( isset( $options2['separator'] ) ) ? $options2['separator'] : ',';
			
		// Array One
		// Values used to pull data from arrays i.e. $fields['one_id_value_1']->one_id_value_2 and also value to store in one_name
		$array_one  =   ( isset( $options2['array_one'] ) ) ? $options2['array_one'] : 'fields';
		$one_id_value_1 = ( isset( $options2['one_id_value_1'] ) ) ? $options2['one_id_value_1'] : '';
		$one_id_value_2 = ( isset( $options2['one_id_value_2'] ) ) ? $options2['one_id_value_2'] : '';
		$one_name = ( isset( $options2['one_name'] ) ) ? $options2['one_name'] : '';
		
		// Array Many
		// Values used to pull data from arrays i.e. $fields['many_id_value_1']->many_id_value_2 and also value to store in many_name
		$array_many  =   ( isset( $options2['array_many'] ) ) ? $options2['array_many'] : 'fields';
		$many_id_value_1 = ( isset( $options2['many_id_value_1'] ) ) ? $options2['many_id_value_1'] : '';
		$many_id_value_2 = ( isset( $options2['many_id_value_2'] ) ) ? $options2['many_id_value_2'] : '';
		$many_name = ( isset( $options2['many_name'] ) ) ? $options2['many_name'] : '';
		
		// Update (Many)
		// Values used to update the content for each 'Many' Item
		$update_other  =   ( isset( $options2['update_other'] ) ) ? $options2['update_other'] : 0;
		$update_object  =   ( isset( $options2['update_object'] ) ) ? $options2['update_object'] : '';
		$update_content_type  =   ( isset( $options2['update_content_type'] ) ) ? $options2['update_content_type'] : '';
		$update_field_value_1  =   ( isset( $options2['update_field_value_1'] ) ) ? $options2['update_field_value_1'] : '';

		// Validate
		parent::g_onCCK_FieldPrepareStore_Validation( $field, $name, $value, $config );

		// Add Process
		if ( ( $sender || $send_field ) && $valid )
		{
			parent::g_addProcess( $event, self::$type, $config, array(
				'isNew' => (int) $isNew,
				'send' => (int) $send,
				'send_field' => $send_field,
				'event' => $event,
				'object' => $object,
				'content_type' => $content_type,
				'table' => $table,
				'table_pk' => (int) $table_pk,
				'field_one_id' => $field_one_id,
				'field_one_name' => $field_one_name,
				'field_many_id' => $field_many_id,
				'field_many_name' => $field_many_name,
				'one_id_multiple' => $one_id_multiple,
				'invert' => (int) $invert,
				'separator' => $separator,
				'array_one' => $array_one,
				'one_id_separator' => $one_id_separator,
				'one_id_value_1' => $one_id_value_1,
				'one_id_value_2' => $one_id_value_2,
				'one_name' => $one_name,
				'array_many' => $array_many,
				'many_id_value_1' => $many_id_value_1,
				'many_id_value_2' => $many_id_value_2,
				'many_name' => $many_name,
				'update_other' => $update_other,
				'update_object' => $update_object,
				'update_content_type' => $update_content_type,
				'update_field_value_1' => $update_field_value_1,
				'valid' => (int) $valid
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
		self::_jbOneToManyWrapper($process, $fields);
	}
	
	// onCCK_FieldAfterStore
	public static function onCCK_FieldAfterStore( $process, &$fields, &$storages, &$config = array() )
	{
        self::_jbOneToManyWrapper($process, $fields);
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Stuff & Script
	
	/*
    *
    * 
    *
    */
	protected static function _jbOneToManyWrapper($process, &$fields)
	{

		// is mapping activated by field?
		$send = $process['send'];
		$send_field = $process['send_field'];

		if ( (!$send) && $send_field ) 
		{
			$send = $fields[$send_field]->value;
		}

		$sender	=	0;
		switch ( $send ) 
		{
			case 0:
				$sender	=	0;
				break;
			case 1:
				if ( !$config['pk'] ) 
				{
					$sender	=	1;
				}
				break;
			case 2:
				if ( $config['pk'] ) 
				{
					$sender	=	1;
				}
				break;
			case 3:
				$sender	=	1;
				break;
		}

		if (!$send) 
		{
			return;
		}

		// 'array_one'=>
		$array_one = $process['array_one'];
		// 'one_id_value_1'=>
		$one_id_value_1 = $process['one_id_value_1'];
		// 'one_id_value_2'=>
		$one_id_value_2 = $process['one_id_value_2'];
		// 'array_many'=>
		$array_many = $process['array_many'];
		// 'many_id_value_1'=>
		$many_id_value_1 = $process['many_id_value_1'];
		// 'many_id_value_2'=>
		$many_id_value_2 = $process['many_id_value_2'];

		// get values of fields based on settings defined in plugin
		switch ($array_one)
		{
			case 'fields':
				$process['one_id'] = $fields[$one_id_value_1]->$one_id_value_2;
				break;
			case 'config':
				$process['one_id'] = $config['storages'][$one_id_value_1][$one_id_value_2];
				break;
			case 'cck':
				$process['one_id'] = $cck->get{$one_id_value_1}($one_id_value_2);
				break;
			case 'value':
				$process['one_id'] = $one_id_value_1;
				break;
			default:
				$process['one_id'] = $fields[$one_id_value_1]->$one_id_value_2;
		}
		switch ($array_many)
		{
			case 'fields':
				$process['many_id'] = $fields[$many_id_value_1]->$many_id_value_2;
				break;
			case 'config':
				$process['many_id'] = $config['storages'][$many_id_value_1][$many_id_value_2];
				break;
			case 'cck':
				$process['many_id'] = $cck->get{$many_id_value_1}($many_id_value_2);
				break;
			case 'value':
				$process['many_id'] = $many_id_value_1;
				break;
			default:
				$process['many_id'] = $fields[$many_id_value_1]->$many_id_value_2;
		}

		self::_jbOneToMany($process, $fields);

	} // --_jbOneToManyWrapper

	protected static function _jbOneToMany($process, &$fields)
	{

		// _jbMapOneToMany deals with either 
		// a singular one_id and multiple many_id 
		// ...at a time, or ... 
		// a singular many_id and multiple one_id 
		// Example is Students and Teachers. 
		// I can assign/unassign students (many) of current teacher (one)
		// ... or I can $invert ...
		// I can assign/unasign teachers (one) of current student (many)

		// 'isNew'=>
		$isNew = (int) $process['isNew'];
		// 'event'=>
		$event = $process['event'];
		// 'object'=>
		$object = $process['object'];
		// 'content_type'=>
		$content_type = $process['content_type'];
		// 'table'=>
		$table = $process['table'];
		// 'table_pk'=>
		$table_pk = (int) $process['table_pk'];
		// 'invert'=>
		$invert = (int) $process['invert'];
		// 'field_one_id'=>
		$field_one_id = $invert ? $process['field_many_id'] : $process['field_one_id'];
		// 'field_one_name'=>
		$field_one_name = $invert ? $process['field_many_name'] : $process['field_one_name'];
		// 'field_many_id'=>
		$field_many_id = $invert ? $process['field_one_id'] : $process['field_many_id'];
		// 'field_many_name'=>
		$field_many_name = $invert ? $process['field_one_name'] : $process['field_many_name'];
		// 'separator'=>
		$separator = $process['separator'];
		// 'one_id'=>
		$one_id = $invert ? (int) $process['many_id'] : (int) $process['one_id'];
		// 'one_name'=>
		$one_name = $invert ? $process['many_name'] : $process['one_name'];
		// 'many_id'=>
		$many_id = $invert ?  $process['one_id'] : $process['many_id'];
		// 'many_name'=>
		$many_name = $invert ? $process['one_name'] : $process['many_name'];
		// 'update_other'=>
		$update_other = $process['update_other'];
		// 'update_object'=>
		$update_object = $process['update_object'];
		// 'update_content_type'=>
		$update_content_type = $process['update_content_type'];
		// 'update_field_value_1'=>
		$update_field_value_1 = $process['update_field_value_1'];
		// arrays used to do stuff, 'new' is from form, 'old' is from db
		$new['many_ids'] = $invert ? explode($separator, $one_id) : explode($separator, $many_id);
		$old['many_pks'] = array();
		$old['many_ids'] = array();
		$new['old_ids'] = array(); // used if multiple one_ids i.e reverse the equation
		$old['old_pks'] = array(); // used if multiple one_ids i.e reverse the equation
		$old['old_ids'] = array(); // used if multiple one_ids i.e reverse the equation

		
		// if new data is not in old data = add
		// if old data is not in new data = delete
		$content = self::_jbContent($object, $table);
		
		// double check that there are no crap bits on value (I kept getting ,406 as a value rather than 406)
		{
			$new['many_ids'][$key] = trim($value, ',');
		}
		
		// Get Multiple ID's from DB
		// ... Seblod and Joomla! have different methods...
		if ($object === 'Joomla') 
		{
			// TODO
			// Get 'old' data from DB
			// Get a db connection.
			$db = JFactory::getDbo();

			// Create a new query object.
			$query = $db->getQuery(true);

			$query
			->select(array($table_pk, $field_many_id))
			->from($db->quoteName($table))
			->where($db->quoteName($field_one_id) . ' = ' . (int) $one_id)
			->where($db->quoteName($field_one_name) . ' = ' . $one_name)
			->where($db->quoteName($field_many_name) . ' = ' . $many_name);

			// Reset the query using our newly populated query object.
			$db->setQuery($query);

			// Load the results as an indexed array of associated arrays from the table records returned by the query
			$results = $db->loadAssocList();

			foreach ($results as $key => $result) 
			{

				$old['many_ids'][$key] = trim($result[$field_many_id], ',');
				$old['many_pks'][$key] = trim($result[$table_pk], ',');
			}

			// NOW ADD OR DELETE MAP DATA
			// DELETE
			foreach ( $old['many_ids'] as $key => $id ) 
			{ 
				if ( !in_array($id, $new['many_ids']) )
				{
					// delete requires $pk
					// $content->delete( $old['many_pks'][$key] );	
					$query = $db->getQuery(true);

					$conditions = array(
						$db->quoteName($table_pk) . ' = ' . $old['many_pks'][$key]
					);

					$query->delete($db->quoteName($table));
					$query->where($conditions);

					$db->setQuery($query);

					$result = $db->execute();
					
				}
			}

			// ADD
			foreach ( $new['many_ids'] as $key => $id ) 
			{ 
				// only add if ID is 1 or above
				if ( ( $one_id > 0 ) && ( $id > 0 ) && ( !in_array($id, $old['many_ids']) ) )
				{ 
					// Create and populate an object.
					$content = new stdClass();
					$content->$field_one_id = (int) $one_id;
					$content->$field_one_name = $one_name;
					$content->$field_many_id = (int) $id;
					$content->$field_many_name = $many_name;

					// Insert the object into the table.
					$result = JFactory::getDbo()->insertObject($table, $content);
				}
			} //--ADD
		} 
		else
		{
			// Get 'old' data from DB
			$data = array( 
				$field_one_id => (int) $one_id, 
				$field_one_name => $one_name,
				$field_many_name => $many_name
			);

			foreach ( $content->find( $content_type, $data )->getPks() as $key => $pk ) 
			{
				if ( $content->load( $pk )->isSuccessful() )
				{
					// Get each many_id and assign to array
					$old['many_ids'][$key] = trim($content->get($field_many_id), ',');
					$old['many_pks'][$key] = (int) $pk;
				}
			}

			// Collate Data for Delete and Add...also used by Update
			foreach ( $old['many_ids'] as $key => $id )
			{
				// delete date if id is 0
				if ( (!in_array($id, $new['many_ids'])) || ($id < 1) )
				{
					$map['delete'][$key] = $id;
				}
			}
	
			foreach ( $new['many_ids'] as $key => $id )
			{
				// only add if ID is 1 or above
				if ( (!in_array($id, $old['many_ids'])) && ($one_id > 0) && ($id > 0) )
				{
					$map['add'][$key] = $id;
				}
			}
			
			// NOW ADD OR DELETE, OR UPDATE MAP DATA
			// DELETE
			foreach ($map['delete'] as $key => $id) 
			{
				// delete requires $pk
				$deleted = $content->delete( $old['many_pks'][$key] );
				if ( $deleted ) 
				{ 
					$message = 'Deleted '.$one_name.' ('.$one_id.') with '.$many_name.' ('.$id.')';
					// if update
				}
				else
				{
					$message = 'Not Deleted '.$one_name.' ('.$one_id.') with '.$many_name.' ('.$id.')';
				}
				JFactory::getApplication()->enqueueMessage($message , 'Warning');
			}


			// ADD
			foreach ($map['add'] as $key => $id)
			{
				$data = array( 
					$field_one_id => (int) $one_id,
					$field_one_name => $one_name,
					$field_many_id => (int) $id,
					$field_many_name => $many_name
				);

				// Create
				if ( $content->create( $content_type, $data )->isSuccessful() ) 
				{ 
					$message = 'Stored '.$one_name.' ('.$one_id.') with '.$many_name.' ('.$id.')';
					JFactory::getApplication()->enqueueMessage($message , 'success');
				}
				else 
				{
					$message = 'Not Stored '.$one_name.' ('.$one_id.') with '.$many_name.' ('.$id.')';
					JFactory::getApplication()->enqueueMessage($message , 'error');
				}
			} //--ADD

			// UPDATE
			// Update the 'many' table my adding or deleting the one_id form the list in the db.field
			if ($update_other) 
			{
				$updater = self::_jbContent($update_object);

				// UPDATE the DELETE's in Many content type
				foreach ($map['delete'] as $key => $id) 
				{
					// foreach ( $updater->find( $update_content_type )->getPks() as $pk ) 
					// {
					if ( $updater->load( $id )->isSuccessful() ) 
					{
						// update data by deleting the many_id's
						$updaterValue = $updater->getProperty( $update_field_value_1 );
						$updaterValue = explode($separator, $updaterValue);
						foreach ($updaterValue as $key => $value) 
						{
							$updatervalue[$key] = trim($value, ',');
						}
						$updaterValue = array_diff($updaterValue,array($one_id));
						$updaterValue = implode($separator, $updaterValue);
						$updated = $updater->setProperty( $update_field_value_1, $updaterValue )->store();

						if ( $updated ) 
						{ 
							$message = ':'.gettype($updaterValue).", {$updaterValue} <- $updaterValue, Updated (Delete)".$one_name.' ('.$one_id.') from '.$many_name.' ('.$id.')';
							JFactory::getApplication()->enqueueMessage($message , 'warning');
						}
						else 
						{
							$message = 'Updated (Not Deleted)'.$one_name.' ('.$one_id.') from '.$many_name.' ('.$id.')';
							JFactory::getApplication()->enqueueMessage($message , 'warning');
						}
					}
				}
				// UPDATE with ADD's
				foreach ($map['add'] as $key => $id) 
				{
					if ( $updater->load( $id )->isSuccessful() ) 
					{
						$message = 'load is successful (Add)'.$one_name.' ('.$one_id.') from '.$many_name.' ('.$id.')';
						JFactory::getApplication()->enqueueMessage($message , 'success');
						// update data by deleting the many_id's
						$updaterValue = $updater->getProperty( $update_field_value_1 );
						JFactory::getApplication()->enqueueMessage($updaterValue.' and one_id '.$one_id, 'updatedshit Add');
						$updaterValue = explode($separator, $updaterValue);
						foreach ($updaterValue as $key => $value) 
						{
							$updatervalue[$key] = trim($value, ',');
						}
						$updaterValue[] = $one_id;
						$updaterValue = implode($separator, $updaterValue);
						$updated = $updater->setProperty( $update_field_value_1, $updaterValue )->store();
						
						if ( $updated ) 
						{ 
							$message = ':'.gettype($updaterValue).", {$updaterValue} <- $updaterValue, Updated (Delete)".$one_name.' ('.$one_id.') from '.$many_name.' ('.$id.')';
							JFactory::getApplication()->enqueueMessage($message , 'updaterValue');
						}
						else 
						{
							$message = 'Updated (Not Added) '.$one_name.' ('.$one_id.') from '.$many_name.' ('.$id.')';
							JFactory::getApplication()->enqueueMessage($message , 'warning');
						}
					}   
				}
			}
		}
	} // --_jbOneToMany

	// return a content object
	protected static function _jbContent($object, $table = '')
	{
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

		return  $content;
	}
}


