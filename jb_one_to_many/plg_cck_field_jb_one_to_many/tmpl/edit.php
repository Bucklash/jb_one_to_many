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
        
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_ONE' ) );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['array_one'], $config, array( 'label'=>'ARRAY_ONE', 'selectlabel'=>'', 'defaultvalue'=>'fields', 'options'=>'FIELDS=fields||CONFIG=config||CCK=cck', 'storage_field'=>'json[options2][array_one]'), array(), 'array one' );
        
        echo '<ul id="array-one-fields" style="clear: both">';
        echo JCckDev::renderLegend(JText::_( 'COM_CCK_FIELDS' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_name_one_id'], $config, array( 'label'=>'FIELDS_NAME_ONE_ID', 'storage_field'=>'json[options2][fields_name_one_id]' ), array(), 'fields one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_attribute_one_id'], $config, array( 'label'=>'FIELDS_ATTRIBUTE_ONE_ID', 'storage_field'=>'json[options2][fields_attribute_one_id]' ), array(), 'fields one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_name_one_name'], $config, array( 'label'=>'FIELDS_NAME_ONE_NAME', 'storage_field'=>'json[options2][fields_name_one_name]' ), array(), 'fields one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_attribute_one_name'], $config, array( 'label'=>'FIELDS_ATTRIBUTE_ONE_NAME', 'storage_field'=>'json[options2][fields_attribute_one_name]' ), array(), 'fields one' );
        echo '</ul>';
        
        echo '<ul id="array-one-config" style="clear: both">';
        echo JCckDev::renderLegend(JText::_( 'COM_CCK_CONFIG' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_table_one_id'], $config, array( 'label'=>'CONFIG_TABLE_ONE_ID', 'storage_field'=>'json[options2][config_table_one_id]' ), array(), 'config one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_field_one_id'], $config, array( 'label'=>'CONFIG_FIELD_ONE_ID', 'storage_field'=>'json[options2][config_field_one_id]' ), array(), 'config one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_table_one_name'], $config, array( 'label'=>'CONFIG_TABLE_ONE_NAME', 'storage_field'=>'json[options2][config_table_one_name]' ), array(), 'config one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_field_one_name'], $config, array( 'label'=>'CONFIG_FIELD_ONE_NAME', 'storage_field'=>'json[options2][config_field_one_name]' ), array(), 'config one' );
        echo '</ul>';
        
        echo '<ul id="array-one-cck" style="clear: both">';
        echo JCckDev::renderLegend(JText::_( 'COM_CCK_CCK' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_name_one_id'], $config, array( 'label'=>'CCK_NAME_ONE_ID', 'storage_field'=>'json[options2][cck_name_one_id]' ), array(), 'cck one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_attribute_one_id'], $config, array( 'label'=>'CCK_ATTRIBUTE_ONE_ID', 'storage_field'=>'json[options2][cck_attribute_one_id]' ), array(), 'cck one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_name_one_name'], $config, array( 'label'=>'CCK_NAME_ONE_NAME', 'storage_field'=>'json[options2][cck_name_one_name]' ), array(), 'cck one' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_attribute_one_name'], $config, array( 'label'=>'CCK_ATTRIBUTE_ONE_NAME', 'storage_field'=>'json[options2][cck_attribute_one_name]' ), array(), 'cck one' );
        echo '</ul>';
        
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_MANY' ) );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['array_many'], $config, array( 'label'=>'ARRAY_MANY', 'selectlabel'=>'', 'defaultvalue'=>'fields', 'options'=>'FIELDS=fields||CONFIG=config||CCK=cck', 'storage_field'=>'json[options2][array_many]'), array(), 'array many' );
        
        echo '<ul id="array-many-fields" style="clear: both">';
        echo JCckDev::renderLegend(JText::_( 'COM_CCK_FIELDS' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_name_many_id'], $config, array( 'label'=>'FIELDS_NAME_MANY_ID', 'storage_field'=>'json[options2][fields_name_many_id]' ), array(), 'fields many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_attribute_many_id'], $config, array( 'label'=>'FIELDS_ATTRIBUTE_MANY_ID', 'storage_field'=>'json[options2][fields_attribute_many_id]' ), array(), 'fields many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_name_many_name'], $config, array( 'label'=>'FIELDS_NAME_MANY_NAME', 'storage_field'=>'json[options2][fields_name_many_name]' ), array(), 'fields many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['fields_attribute_many_name'], $config, array( 'label'=>'FIELDS_ATTRIBUTE_MANY_NAME', 'storage_field'=>'json[options2][fields_attribute_many_name]' ), array(), 'fields many' );
        echo '</ul>';
        
        echo '<ul id="array-many-config" style="clear: both">';
        echo JCckDev::renderLegend(JText::_( 'COM_CCK_CONFIG' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_table_many_id'], $config, array( 'label'=>'CONFIG_TABLE_MANY_ID', 'storage_field'=>'json[options2][config_table_many_id]' ), array(), 'config many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_field_many_id'], $config, array( 'label'=>'CONFIG_FIELD_MANY_ID', 'storage_field'=>'json[options2][config_field_many_id]' ), array(), 'config many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_table_many_name'], $config, array( 'label'=>'CONFIG_TABLE_MANY_NAME', 'storage_field'=>'json[options2][config_table_many_name]' ), array(), 'config many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['config_field_many_name'], $config, array( 'label'=>'CONFIG_FIELD_MANY_NAME', 'storage_field'=>'json[options2][config_field_many_name]' ), array(), 'config many' );
        echo '</ul>';
        
        echo '<ul id="array-many-cck" style="clear: both">';
        echo JCckDev::renderLegend(JText::_( 'COM_CCK_CCK' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_name_many_id'], $config, array( 'label'=>'CCK_NAME_MANY_ID', 'storage_field'=>'json[options2][cck_name_many_id]' ), array(), 'cck many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_attribute_many_id'], $config, array( 'label'=>'CCK_ATTRIBUTE_MANY_ID', 'storage_field'=>'json[options2][cck_attribute_many_id]' ), array(), 'cck many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_name_many_name'], $config, array( 'label'=>'CCK_NAME_MANY_NAME', 'storage_field'=>'json[options2][cck_name_many_name]' ), array(), 'cck many' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['cck_attribute_many_name'], $config, array( 'label'=>'CCK_ATTRIBUTE_MANY_NAME', 'storage_field'=>'json[options2][cck_attribute_many_name]' ), array(), 'cck many' );
        echo '</ul>';
        
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $(".database.table").hide();
    $('#json_options2_seblod').change(function(){
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

    $("#array-one-config, #array-one-cck").hide();
    $('#json_options2_array_one').change(function(){
        if ( this.value == 'fields')
        {
            $("#array-one-config, #array-one-cck").hide();
            $("#array-one-fields").show();
        }
        else if ( this.value == 'config')
        {
            $("#array-one-fields, #array-one-cck").hide();
            $("#array-one-config").show();
        }
        else if ( this.value == 'cck')
        {
            $("#array-one-config, #array-one-fields").hide();
            $("#array-one-cck").show();
        }
    });

    $("#array-many-config, #array-many-cck").hide();
    $('#json_options2_array_many').change(function(){
        if ( this.value == 'fields')
        {
            $("#array-many-config, #array-many-cck").hide();
            $("#array-many-fields").show();
        }
        else if ( this.value == 'config')
        {
            $("#array-many-fields, #array-many-cck").hide();
            $("#array-many-config").show();
        }
        else if ( this.value == 'cck')
        {
            $("#array-many-config, #array-many-fields").hide();
            $("#array-many-cck").show();
        }
    });
});
</script>