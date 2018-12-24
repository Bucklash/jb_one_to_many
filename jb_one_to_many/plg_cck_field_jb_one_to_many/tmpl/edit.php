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
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_'.$this->item->type.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
        echo JCckDev::renderForm( 'core_label', $this->item->label, $config );
        
        echo JCckDev::renderForm( 'core_dev_select', @$options2['event'], $config, array( 'label'=>'Storage Event', 'selectlabel'=>'', 'defaultvalue'=>'afterstore', 'options'=>'BeforeStore=beforestore||AfterStore=afterstore', 'storage_field'=>'json[options2][event]' ) );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['seblod'], $config, array( 'label'=>'Seblod Data?', 'selectlabel'=>'', 'defaultvalue'=>'1', 'options'=>'Yes=1||No=0', 'storage_field'=>'json[options2][seblod]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['table'], $config, array( 'label'=>'Database Table', 'storage_field'=>'json[options2][table]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['content_type'], $config, array( 'label'=>'Content Type', 'storage_field'=>'json[options2][content_type]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_one_id'], $config, array( 'label'=>'Field One ID', 'storage_field'=>'json[options2][field_one_id]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_one_name'], $config, array( 'label'=>'Field One Name', 'storage_field'=>'json[options2][field_one_name]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_many_id'], $config, array( 'label'=>'Field Many ID', 'storage_field'=>'json[options2][field_many_id]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_many_name'], $config, array( 'label'=>'Field Many Name', 'storage_field'=>'json[options2][field_many_name]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['seperator_many_id'], $config, array( 'label'=>'Seperator for many ID', 'defaultvalue'=>',', 'storage_field'=>'json[options2][seperator_many_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['seperator_many_name'], $config, array( 'label'=>'Seperator for many Name', 'defaultvalue'=>',', 'storage_field'=>'json[options2][seperator_many_name]' ) );
        
        echo JCckDev::renderForm( 'core_dev_select', @$options2['array_one'], $config, array( 'label'=>'Array for \'One\'', 'selectlabel'=>'', 'defaultvalue'=>'fields', 'options'=>'$fields=fields||$config=config||$cck=cck', 'storage_field'=>'json[options2][array_one]') );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_name_one_id'], $config, array( 'label'=>'Field\'s name for One ID', 'storage_field'=>'json[options2][fields_name_one_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_attribute_one_id'], $config, array( 'label'=>'Field\'s attribute for One ID', 'storage_field'=>'json[options2][fields_attribute_one_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_name_one_name'], $config, array( 'label'=>'Field\'s name for One Name', 'storage_field'=>'json[options2][fields_name_one_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_attribute_one_name'], $config, array( 'label'=>'Field\'s attribute for One Name', 'storage_field'=>'json[options2][fields_attribute_one_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_table_one_id'], $config, array( 'label'=>'Config\'s storage table for One ID', 'storage_field'=>'json[options2][config_table_one_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_field_one_id'], $config, array( 'label'=>'Config\'s storage field for One ID', 'storage_field'=>'json[options2][config_field_one_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_table_one_name'], $config, array( 'label'=>'Config\'s storage table for One Name', 'storage_field'=>'json[options2][config_table_one_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_field_one_name'], $config, array( 'label'=>'Config\'s storage field for One Name', 'storage_field'=>'json[options2][config_field_one_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_name_one_id'], $config, array( 'label'=>'Cck\'s name for One ID', 'storage_field'=>'json[options2][cck_name_one_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_attribute_one_id'], $config, array( 'label'=>'Cck\'s attribute for One ID', 'storage_field'=>'json[options2][cck_attribute_one_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_name_one_name'], $config, array( 'label'=>'Cck\'s name for One Name', 'storage_field'=>'json[options2][cck_name_one_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_attribute_one_name'], $config, array( 'label'=>'Cck\'s attribute for One Name', 'storage_field'=>'json[options2][cck_attribute_one_name]' ) );
        
        echo JCckDev::renderForm( 'core_dev_select', @$options2['array_many'], $config, array( 'label'=>'Array for \'Many\'', 'selectlabel'=>'', 'defaultvalue'=>'fields', 'options'=>'$fields=fields||$config=config||$cck=cck', 'storage_field'=>'json[options2][array_many]') );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_name_many_id'], $config, array( 'label'=>'Field\'s name for many ID', 'storage_field'=>'json[options2][fields_name_many_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_attribute_many_id'], $config, array( 'label'=>'Field\'s attribute for many ID', 'storage_field'=>'json[options2][fields_attribute_many_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_name_many_name'], $config, array( 'label'=>'Field\'s name for Many Name', 'storage_field'=>'json[options2][fields_name_many_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_attribute_many_name'], $config, array( 'label'=>'Field\'s attribute for Many Name', 'storage_field'=>'json[options2][fields_attribute_many_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_table_many_id'], $config, array( 'label'=>'Config\'s storage table for Many ID', 'storage_field'=>'json[options2][config_table_many_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_field_many_id'], $config, array( 'label'=>'Config\'s storage field for Many ID', 'storage_field'=>'json[options2][config_field_many_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_table_many_name'], $config, array( 'label'=>'Config\'s storage table for Many Name', 'storage_field'=>'json[options2][config_table_many_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_field_many_name'], $config, array( 'label'=>'Config\'s storage field for Many Name', 'storage_field'=>'json[options2][config_field_many_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_name_many_id'], $config, array( 'label'=>'Cck\'s name for Many ID', 'storage_field'=>'json[options2][cck_name_many_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_attribute_many_id'], $config, array( 'label'=>'Cck\'s attribute for Many ID', 'storage_field'=>'json[options2][cck_attribute_many_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_name_many_name'], $config, array( 'label'=>'Cck\'s name for Many Name', 'storage_field'=>'json[options2][cck_name_many_name]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_attribute_many_name'], $config, array( 'label'=>'Cck\'s attribute for Many Name', 'storage_field'=>'json[options2][cck_attribute_many_name]' ) );
        
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>