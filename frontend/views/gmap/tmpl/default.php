<!--[if IE]>
  <style>
    div#map img{
      margin-top: -1px;
      margin-left: -1px;
    }
  </style>
<![endif]-->

<?php
defined('_JEXEC') or die('Restricted access');
?>  
<noscript><b><?php echo JText::_('This page need javascript to proper display!')?></b></noscript>
<div id="markerText"></div>
<div id="sets" style="width:30%; float:left;">
<form>
    <ul>  
<?php 
for($i=0,$max=count($this->sets);$i<$max;$i++)
{
    $row = $this->sets[$i];
?>
<li style="background: url('<?php echo $row->icon;?>') no-repeat scroll 20px 7px transparent; line-height: 400%; margin-bottom: 5px; overflow: hidden; padding-left: 50px;">
<input type ="checkbox" id="set<?php echo $row->id;?>" value="<?php echo $row->id;?>" onclick="ChangeState(this)" checked="checked"><?php echo $row->title;?>
</li>
<?php
}   
?>
</ul>
</form>
</div>
<div id="map" style="width: 70%; height: 600px;"></div>
<script type="text/javascript">

ShowMap();

downloadUrl("index.php?option=com_gmap&task=mapData&tmpl=component&format=raw", LoadMarkers);

</script>