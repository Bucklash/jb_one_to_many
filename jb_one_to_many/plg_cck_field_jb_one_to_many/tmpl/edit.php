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
$options2	=	JCckDev::fromJSON( $this->item->options2 );
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_'.$this->item->type.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
        echo JCckDev::renderForm( 'core_label', $this->item->label, $config );
        
        // GLOBAL SETTINGS
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_GLOBAL_SETTINGS' ), JText::_( 'COM_CCK_GLOBAL_SETTINGS_DESC' ), '2' );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['event'], $config, array( 'label'=>'STORAGE_EVENT', 'selectlabel'=>'', 'defaultvalue'=>'afterStore', 'options'=>'BeforeStore=beforeStore||AfterStore=afterStore', 'storage_field'=>'json[options2][event]' ) );
        echo JCckDev::renderBlank();
        echo JCckDev::renderForm( 'core_dev_select', @$options2['object'], $config, array( 'label'=>'OBJECT', 'selectlabel'=>'', 'defaultvalue'=>'Free', 'options'=>'JOOMLA=Joomla||ARTICLE=Article||CATEGORY=Category||FREE=Free||USERNOTE=UserNote||USER=User||USERGROUP=UserGroup', 'storage_field'=>'json[options2][object]' ), array(), 'object' );
        echo '<div style="clear: left;width: 100%; height:1px"></div>';
        echo JCckDev::renderBlank( '<div style="clear:left"><div style="width:50%; text-display:inline-block;" class="table">i.e. #__some_table;</div><div style="width:50%; display:inline-block;" class="content-type">i.e. map (<- name of content type)</div></div>', 'Values:');
        echo '<div style="clear: left;width: 100%; height:1px"></div>';
        echo JCckDev::renderForm( 'core_dev_text', @$options2['table'], $config, array( 'label'=>'TABLE', 'selectlabel'=>'', 'defaultvalue'=>'', 'storage_field'=>'json[options2][table]' ), array(), 'table' );
        echo JCckDev::renderForm( 'core_form', $this->item->extended, $config, array( 'label'=>'CONTENT_TYPE_FORM', 'selectlabel'=>'',
							'options2'=>'{"query":"","table":"#__cck_core_types","name":"title","where":"published!=-44","value":"name","orderby":"title","orderby_direction":"ASC","limit":""}',
							'required'=>'required', 'storage_field'=>'extended' ) );
        echo '<div style="clear: left;width: 100%; height:1px"></div>';
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_one_id'], $config, array( 'label'=>'FIELD_ONE_ID', 'defaultvalue'=>'one_id', 'storage_field'=>'json[options2][field_one_id]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_one_name'], $config, array( 'label'=>'FIELD_ONE_NAME', 'defaultvalue'=>'one_name', 'storage_field'=>'json[options2][field_one_name]', 'required'=>'required' ) );
        echo '<div style="clear: left;width: 100%; height:1px"></div>';
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_many_id'], $config, array( 'label'=>'FIELD_MANY_ID', 'defaultvalue'=>'many_id', 'storage_field'=>'json[options2][field_many_id]', 'required'=>'required' ) );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['field_many_name'], $config, array( 'label'=>'FIELD_MANY_NAME', 'defaultvalue'=>'many_name', 'storage_field'=>'json[options2][field_many_name]', 'required'=>'required' ) );
        echo '<div style="clear: left;width: 100%; height:1px"></div>';
        echo JCckDev::renderForm( 'core_dev_text', @$options2['separator_many_id'], $config, array( 'label'=>'SEPARATOR_FOR_MANY_ID', 'defaultvalue'=>',', 'storage_field'=>'json[options2][separator_many_id]' ) );
        
        // ONE OPTIONS
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_ONE' ), '', '2', array( 'class_sfx'=>'-2cols' ) );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['array_one'], $config, array( 'label'=>'ARRAY_ONE', 'selectlabel'=>'', 'defaultvalue'=>'fields', 'options'=>'FIELDS=fields||CONFIG=config||CCK=cck||VALUE=value', 'storage_field'=>'json[options2][array_one]'), array(), 'array one' );
        echo JCckDev::renderBlank( '<div class="fields-one">$fields[#value1#]->#value2#;</div><div class="config-one">$config[\'storages\'][#value1#][#value2#];</div><div class="cck-one">$cck->get#value1#(#value2#);</div><div class="value-one">#value1#</div>', 'Value:');
        echo JCckDev::renderForm( 'core_dev_text', @$options2['one_id_value_1'], $config, array( 'label'=>'ONE_ID_VALUE_1', 'storage_field'=>'json[options2][one_id_value_1]' ), array(), 'one_id_value_1' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['one_id_value_2'], $config, array( 'label'=>'ONE_ID_VALUE_2', 'storage_field'=>'json[options2][one_id_value_2]' ), array(), 'one_id_value_2' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['one_name_value_1'], $config, array( 'label'=>'ONE_NAME_VALUE_1', 'storage_field'=>'json[options2][one_name_value_1]' ), array(), 'one_name_value_1' );
        
        // MANY OPTIONS
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_MANY' ), '', '2', array( 'class_sfx'=>'-2cols' ) );
        echo JCckDev::renderForm( 'core_dev_select', @$options2['array_many'], $config, array( 'label'=>'ARRAY_MANY', 'selectlabel'=>'', 'defaultvalue'=>'fields', 'options'=>'FIELDS=fields||CONFIG=config||CCK=cck||VALUE=value', 'storage_field'=>'json[options2][array_many]'), array(), 'array many' );
        echo JCckDev::renderBlank( '<div class="fields-many">$fields[#value1#]->#value2#;</div><div class="config-many">$config[\'storages\'][#value1#][#value2#];</div><div class="cck-many">$cck->get#value1#(#value2#);</div><div class="value-many">#value1#</div>', 'Value:');
        echo JCckDev::renderForm( 'core_dev_text', @$options2['many_id_value_1'], $config, array( 'label'=>'MANY_ID_VALUE_1', 'storage_field'=>'json[options2][many_id_value_1]' ), array(), 'many_id_value_1' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['many_id_value_2'], $config, array( 'label'=>'MANY_ID_VALUE_2', 'storage_field'=>'json[options2][many_id_value_2]' ), array(), 'many_id_value_2' );
        echo JCckDev::renderForm( 'core_dev_text', @$options2['many_name_value_1'], $config, array( 'label'=>'MANY_NAME_VALUE_1', 'storage_field'=>'json[options2][many_name_value_1]' ), array(), 'many_name_value_1' );
        
        // STORAGE
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) 
{
    $('#json_options2_object').change(function()
    {
        if ( this.value == 'Joomla' )
        {
            $(".content-type").hide();
            $(".table").show();
        } 
        else if ( this.value == 'Free' )
        {
            $(".content-type, .table").show();
        }
        else
        {
            $(".table").hide();
            $(".content-type").show();
        }
    });

    $(".config-one, .cck-one, .value-one").hide();
    $('#json_options2_array_one').change(function()
    {
        if ( this.value == 'fields')
        {
            $(".config-one, .cck-one, .value-one").hide();
            $(".fields-one").show();
        }
        else if ( this.value == 'config')
        {
            $(".fields-one, .cck-one, .value-one").hide();
            $(".config-one").show();
        }
        else if ( this.value == 'cck')
        {
            $(".fields-one, .config-one, .value-one").hide();
            $(".cck-one").show();
        }
        else if ( this.value == 'value')
        {
            $(".fields-one, .config-one, .cck-one").hide();
            $(".value-one").show();
        }
    });
    
    $(".config-many, .cck-many, .value-many").hide();
    $('#json_options2_array_many').change(function()
    {
        if ( this.value == 'fields')
        {
            $(".config-many, .cck-many, .value-many").hide();
            $(".fields-many").show();
        }
        else if ( this.value == 'config')
        {
            $(".fields-many, .cck-many, .value-many").hide();
            $(".config-many").show();
        }
        else if ( this.value == 'cck')
        {
            $(".fields-many, .config-many, .value-many").hide();
            $(".cck-many").show();
        }
        else if ( this.value == 'value')
        {
            $(".fields-many, .config-many, .cck-many").hide();
            $(".value-many").show();
        }
    });
});
</script>