
<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.html.html.list' );
JHTML::_('behavior.formvalidation'); 
?>

<style type="text/css">
/* form validation */
.invalid { border-color: #ff0000; background-color:#ffd;}
</style>
<script type="text/javascript">
function LoadIcon(option)
{
    var icon = prompt("Insert image url:",option.value);
    if(icon)
        {
            option.value = icon;
            option.text = icon;
        }
}

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

<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate" onSubmit="return doValidate(this)">
<div class="col100">
    <fieldset class="adminform">
        <legend><?php
                if($this->data)
                    echo JText::_( 'Edit Set' );
                else
                    echo JText::_( 'New Set' );
                ?>
        </legend>
        <table class="admintable">
        <tr>
            <td width="100" align="right" class="key"><label for="title"><?php echo JText::_( 'Title' ); ?>:</label></td>
            <td><input class="text_area required" type="text" name="title" id="title" size="40" maxlength="40" value="<?php echo $this->data->title;?>" /></td>
        </tr>
        <tr>
            <td width="100" align="right" class="key"><label for="published"><?php echo JText::_( 'Published' ); ?>:</label></td>
            <td><?php echo JText::_( 'Yes' ); ?><input type="radio" name="published" value="1" <?php if($this->data->published)echo "checked";?>>
                <?php echo JText::_( 'No' ); ?><input type="radio" name="published" value="0" <?php if(!$this->data->published)echo "checked";?>>
            </td>            
        </tr>
        <tr>
            <td width="100" align="right" class="key"><label for="description"><?php echo JText::_( 'Icon' ); ?>:</label></td>
            <td>
                <select name="icon" id="icon" size="1">
                    <?php if($this->data->icon){ ?>
                    <option value="<?php echo $this->data->icon;?>"><?php echo $this->data->icon;?></option>
                    <?php }
                        foreach ($this->icons as $icon) 
                            {
                                if($this->data->icon != JURI::root()."media/com_gmap/".$icon)
                                ?>
                                <option value="<?php echo JURI::root()."media/com_gmap/".$icon;?>"><?php echo $icon;?></option>
                    <?php
                            }
                    ?>
                    <option value="<?php echo JURI::root();?>" onclick="LoadIcon(this)"> <?php echo JText::_( 'Select your own:' ); ?></option>
                </select>

            </td>            
        </tr>
        <tr>
            <td width="100" align="right" class="key"><label for="description"><?php echo JText::_( 'Description' ); ?>:</label></td>
            <td><textarea class="text_area " name="description" id="description" cols="40" rows="5"><?php echo $this->data->description;?></textarea></td>            
        </tr>
    </table>
    </fieldset>
</div>
 
<div class="clr"></div>
 
<input type="hidden" name="option" value="com_gmap" />
<input type="hidden" name="id" value="<?php echo $this->data->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="set" />
</form>

