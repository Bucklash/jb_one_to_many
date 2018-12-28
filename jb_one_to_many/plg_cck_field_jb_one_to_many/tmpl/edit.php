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
        
        // GLOBAL SETTINGS
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_GLOBAL_SETTINGS' ), JText::_( 'COM_CCK_GLOBAL_SETTINGS_DESC' ), '2' );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['event'], $config, array( 'label'=>'STORAGE_EVENT', 'selectlabel'=>'', 'defaultvalue'=>'afterstore', 'options'=>'BeforeStore=beforestore||AfterStore=afterstore', 'storage_field'=>'json[options2][event]' ) );
        echo JCckDev::renderBlank();
        echo JCckDev::renderForm( 'core_dev_select', @$options2['seblod'], $config, array( 'label'=>'SEBLOD_DATA', 'selectlabel'=>'', 'defaultvalue'=>'1', 'options'=>'Yes=1||No=0', 'storage_field'=>'json[options2][seblod]' ) );
        echo JCckDev::renderBlank();
        echo JCckDev::renderForm( 'core_dev_text', @$options2['table'], $config, array( 'label'=>'DATABASE_TABLE', 'storage_field'=>'json[options2][table]' ), array(), 'database table' ); 
        echo JCckDev::renderForm( 'core_dev_text', @$options2['content_type'], $config, array( 'label'=>'CONTENT_TYPE', 'storage_field'=>'json[options2][content_type]' ), array(), 'database content-type' );
        echo JCckDev::renderBlank();
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_one_id'], $config, array( 'label'=>'FIELD_ONE_ID', 'storage_field'=>'json[options2][field_one_id]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_one_name'], $config, array( 'label'=>'FIELD_ONE_NAME', 'storage_field'=>'json[options2][field_one_name]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_many_id'], $config, array( 'label'=>'FIELD_MANY_ID', 'storage_field'=>'json[options2][field_many_id]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_many_name'], $config, array( 'label'=>'FIELD_MANY_NAME', 'storage_field'=>'json[options2][field_many_name]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['seperator_many_id'], $config, array( 'label'=>'SEPERATOR_FOR_MANY_ID', 'defaultvalue'=>',', 'storage_field'=>'json[options2][seperator_many_id]' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['seperator_many_name'], $config, array( 'label'=>'SEPERATOR_FOR_MANY_NAME', 'defaultvalue'=>',', 'storage_field'=>'json[options2][seperator_many_name]' ) );
        
        // ONE OPTIONS
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_ONE' ), '', '2', array( 'class_sfx'=>'-2cols' ) );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['array_one'], $config, array( 'label'=>'ARRAY_ONE', 'selectlabel'=>'', 'defaultvalue'=>'fields', 'options'=>'FIELDS=fields||CONFIG=config||CCK=cck', 'storage_field'=>'json[options2][array_one]'), array(), 'array one' );
        echo JCckDev::renderBlank( '<div class="fields-one">$fields[#value1#]->#value2#;</div><div class="config-one">$config[\'storages\'][#value1#][#value2#];</div><div class="cck-one">$cck->get#value1#(#value2#);</div>', 'Array:');
        echo JCckDev::renderForm( 'core_dev_text', @$options2['one_id_value_1'], $config, array( 'label'=>'ONE_ID_VALUE_1', 'storage_field'=>'json[options2][one_id_value_1]' ), array(), 'one_id_value_1' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['one_id_value_2'], $config, array( 'label'=>'ONE_ID_VALUE_2', 'storage_field'=>'json[options2][one_id_value_2]' ), array(), 'one_id_value_2' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['one_name_value_1'], $config, array( 'label'=>'ONE_NAME_VALUE_1', 'storage_field'=>'json[options2][one_name_value_1]' ), array(), 'one_name_value_1' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['one_name_value_2'], $config, array( 'label'=>'ONE_NAME_VALUE_2', 'storage_field'=>'json[options2][one_name_value_2]' ), array(), 'one_name_value_2' );
        
        // MANY OPTIONS
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_MANY' ), '', '2', array( 'class_sfx'=>'-2cols' ) );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['array_many'], $config, array( 'label'=>'ARRAY_MANY', 'selectlabel'=>'', 'defaultvalue'=>'fields', 'options'=>'FIELDS=fields||CONFIG=config||CCK=cck', 'storage_field'=>'json[options2][array_many]'), array(), 'array many' );
        echo JCckDev::renderBlank( '<div class="fields-many">$fields[#value1#]->#value2#;</div><div class="config-many">$config[\'storages\'][#value1#][#value2#];</div><div class="cck-many">$cck->get#value1#(#value2#);</div>', 'Array:');
        echo JCckDev::renderForm( 'core_dev_text', @$options2['many_id_value_1'], $config, array( 'label'=>'MANY_ID_VALUE_1', 'storage_field'=>'json[options2][many_id_value_1]' ), array(), 'many_id_value_1' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['many_id_value_2'], $config, array( 'label'=>'MANY_ID_VALUE_2', 'storage_field'=>'json[options2][many_id_value_2]' ), array(), 'many_id_value_2' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['many_name_value_1'], $config, array( 'label'=>'MANY_NAME_VALUE_1', 'storage_field'=>'json[options2][many_name_value_1]' ), array(), 'many_name_value_1' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['many_name_value_2'], $config, array( 'label'=>'MANY_NAME_VALUE_2', 'storage_field'=>'json[options2][many_name_value_2]' ), array(), 'many_name_value_2' );
        
        // STORAGE
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) 
{
    $(".database.table").hide();
    $('#json_options2_seblod').change(function()
    {
        if ( this.value == '1')
        {
            $(".database.table").hide();
            $(".database.content-type").show();
        }
        else if ( this.value == '0')
        {
            $(".database.content-type").hide();
            $(".database.table").show();
        }
    });

    $(".config-one, .cck-one").hide();
    $('#json_options2_array_one').change(function()
    {
        if ( this.value == 'fields')
        {
            $(".config-one, .cck-one").hide();
            $(".fields-one").show();
        }
        else if ( this.value == 'config')
        {
            $(".fields-one, .cck-one").hide();
            $(".config-one").show();
        }
        else if ( this.value == 'cck')
        {
            $(".fields-one, .config-one").hide();
            $(".cck-one").show();
        }
    });
    
    $(".config-many, .cck-many").hide();
    $('#json_options2_array_many').change(function()
    {
        if ( this.value == 'fields')
        {
            $(".config-many, .cck-many").hide();
            $(".fields-many").show();
        }
        else if ( this.value == 'config')
        {
            $(".fields-many, .cck-many").hide();
            $(".config-many").show();
        }
        else if ( this.value == 'cck')
        {
            $(".fields-many, .config-many").hide();
            $(".cck-many").show();
        }
    });
});
</script>