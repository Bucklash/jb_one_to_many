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

        /*
        *
        * table
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_content_type', @$options2['content_type'], $config );
        
        /*
        *
        * field_one_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */

        echo JCckDev::renderForm( 'jb_one_to_many_field_one_id', @$options2['field_one_id'], $config );
        
        /*
        *
        * field_one_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */

        echo JCckDev::renderForm( 'jb_one_to_many_field_one_name', @$options2['field_one_name'], $config );
        
        /*
        *
        * field_many_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */

        echo JCckDev::renderForm( 'jb_one_to_many_field_many_id', @$options2['field_many_id'], $config );
        
        /*
        *
        * field_many_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */

        echo JCckDev::renderForm( 'jb_one_to_many_field_many_name', @$options2['field_many_name'], $config );

        /*
        *
        * seperator_many_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */

        echo JCckDev::renderForm( 'jb_one_to_many_seperator_many_id', @$options2['seperator_many_id'], $config );

        /*
        *
        * seperator_many_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */

        echo JCckDev::renderForm( 'jb_one_to_many_seperator_many_name', @$options2['seperator_many_name'], $config );




        // SPACER
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
        


        
        /*
        *
        * array_one
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_array_one', @$options2['array_one'], $config );
        
        /*
        *
        * array_many
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_array_many', @$options2['array_many'], $config );



        // SPACER
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
        
        
            
        /*
        *
        * jb_one_to_many_fields_name_one_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_fields_name_one_id', @$options2['fields_name_one_id'], $config );    
        
            
            
        /*
        *
        * jb_one_to_many_fields_attribute_one_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_fields_attribute_one_id', @$options2['fields_attribute_one_id'], $config );  
        
        


        /*
        *
        * jb_one_to_many_fields_name_one_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_fields_name_one_name', @$options2['fields_name_one_name'], $config );    
        
        
            
        /*
        *
        * jb_one_to_many_fields_attribute_one_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_fields_attribute_one_name', @$options2['fields_attribute_one_name'], $config );    


        
            

        /*
        *
        * jb_one_to_many_fields_name_many_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_fields_name_many_id', @$options2['fields_name_many_id'], $config );    
        
            
            
        /*
        *
        * jb_one_to_many_fields_attribute_many_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_fields_attribute_many_id', @$options2['fields_attribute_many_id'], $config );    
        

        
        /*
        *
        * jb_one_to_many_fields_name_many_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_fields_name_many_name', @$options2['fields_name_many_name'], $config );    
        
        
            
        /*
        *
        * jb_one_to_many_fields_attribute_many_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_fields_attribute_many_name', @$options2['fields_attribute_many_name'], $config );    
        



        // SPACER
        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );

        
        
            
        /*
        *
        * jb_one_to_many_config_table_one_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_config_table_one_id', @$options2['config_table_one_id'], $config );    
        
            
        /*
        *
        * jb_one_to_many_config_table_one_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_config_table_one_name', @$options2['config_table_one_name'], $config );    
        
            
        /*
        *
        * jb_one_to_many_config_table_many_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_config_table_many_id', @$options2['config_table_many_id'], $config );    
        
            
        /*
        *
        * jb_one_to_many_config_table_many_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_config_table_many_name', @$options2['config_table_many_name'], $config );    
        
        

            
        /*
        *
        * jb_one_to_many_config_field_one_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_config_field_one_id', @$options2['config_field_one_id'], $config );    
        
            
        /*
        *
        * jb_one_to_many_config_field_one_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_config_field_one_name', @$options2['config_field_one_name'], $config );    
        
            
        /*
        *
        * jb_one_to_many_config_field_many_id
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_config_field_many_id', @$options2['config_field_many_id'], $config );    
        
            
        /*
        *
        * jb_one_to_many_config_field_many_name
        *
        * @options: 
        * @tip: 
        * @example: 
        *
        */
        
        echo JCckDev::renderForm( 'jb_one_to_many_config_field_many_name', @$options2['config_field_many_name'], $config );    


        
            
      

		// echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>