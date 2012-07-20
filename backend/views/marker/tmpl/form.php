<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.formvalidation'); 
?>
<style type="text/css">
/* form validation */
.invalid { border-color: #ff0000; background-color:#ffd;}
</style>
<script type="text/javascript">

 var myFormValidator = JFormValidator.extend({});
  // override core behavior
  function submitbutton( pressbutton )
  {
    if( pressbutton == 'cancel' )
    {
      submitform( pressbutton );
      return true;
    }
    var form = document.adminForm;
    var validator = new myFormValidator();
    if( validator.isValid( form ) )
    {
      submitform( pressbutton );
    }
    else
    {
      alert( '<?php echo JText::_('Fields highlighted in red are compulsory or unacceptable!'); ?>' );
    }
  }
  // our validation script
  function doValidate( f )
  {
    if( document.formvalidator.isValid( f ) )
    {
      return true;
    }
    return false;
  }
  
</script>

<noscript><fieldset class="adminform"><?php echo JText::_( 'Váš prohlížeč nepodporuje javascript. Akci nebude možno uložit.' ); ?></fieldset></noscript>
<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate" onSubmit="//return doValidate(this)">
<div class="col100">
    <fieldset class="adminform">
        <legend><?php echo JText::_( 'Marker' ); ?></legend>
        <table class="admintable" style="float: left;">
        <tr>
            <td width="50" align="right" class="key"><label for="title"><?php echo JText::_( 'Název' ); ?>:</label></td>
            <td><input class="text_area required" type="text" name="title" id="title" size="40" maxlength="40" value="<?php echo $this->marker->title;?>" /></td>
        </tr>
        <tr>
            <td width="50" align="right" class="key"><label for="latitude"><?php echo JText::_( 'Latitude' ); ?>:</label></td>
            <td><input class="text_area required" type="text" name="latitude" id="latitude" size="40" maxlength="12" value="<?php echo $this->marker->latitude;?>" /></td>
        </tr>
        <tr>
            <td width="100" align="right" class="key"><label for="longitude"><?php echo JText::_( 'Longitude' ); ?>:</label></td>
            <td><input class="text_area required" type="text" name="longitude" id="longitude" size="40" maxlength="12" value="<?php echo $this->marker->longitude;?>" /></td>
        </tr>
        <tr>
            <td width="100" align="right" class="key"><label for="set"><?php echo JText::_( 'Set' ); ?>:</label></td>
            <td>
                <select class="required" name="set_id" id="set_id" size="1">
                <?php 
                    for($i=0, $max = count($this->sets);$i<$max;$i++)
                    {
                       $row = $this->sets[$i]; 
      
                ?>
                    <option value="<?php echo $row->id;?>" <?php if($row->id == $this->marker->set_id) echo "selected";?> ><?php echo $row->title;?></option>
                <?php }?>
                </select>
            </td> 
        </tr>    
        <tr>
            <td width="50" align="right" class="key"><label for="published"><?php echo JText::_( 'Published' ); ?>:</label></td>
            <td><?php echo JText::_( 'Yes' ); ?><input type="radio" name="published" value="1" <?php if($this->marker->published)echo "checked";?>>
                <?php echo JText::_( 'No' ); ?><input type="radio" name="published" value="0" <?php if(!$this->marker->published)echo "checked";?>>
            </td> 
        </tr>
        <tr>
            <td width="100" align="right" class="key"><label for="text"><?php echo JText::_( 'Description' ); ?>:</label></td>
            <td>				
            <?php
                $editor =& JFactory::getEditor();
                echo $editor->display('text', $this->marker->text, '550', '400', '60', '20', true);
             ?>
            </td>
            <td>
            </td>
        </tr>       
        </table>
        <table class ="admintable">
        <tr>
            <td>
                <div id="map" style="width: 500px; height: 550px;"></div>
            </td
        <tr>    
        </table>
    </fieldset>
</div>
<div class="clr"></div>
 
<input type="hidden" name="option" value="com_gmap" />
<input type="hidden" name="id" value="<?php echo $this->marker->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="marker" />
</form>

<script type="text/javascript">
ShowMap();


</script>