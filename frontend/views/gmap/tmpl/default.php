<?php
defined('_JEXEC') or die('Restricted access');
?>  
<noscript><b><?php echo JText::_('This page need javascript to proper display!')?></b></noscript>
<div id="markerText"></div>
<div id="map" style="width: 700px; height: 800px;"></div>
<script type="text/javascript">

ShowMap();

downloadUrl("index.php?option=com_gmap&task=mapData&tmpl=component&format=raw", LoadMarkers);

</script>
<form>
<?php 
for($i=0,$max=count($this->sets);$i<$max;$i++)
{
    $row = $this->sets[$i];
?>
<img src="<?php echo $row->icon;?>" alt="Set icon"><input type ="checkbox" id="set<?php echo $row->id;?>" value="<?php echo $row->id;?>" onclick="ChangeState(this)" checked="checked"><?php echo $row->title;?><br>

<?php
}
?>

</form>
