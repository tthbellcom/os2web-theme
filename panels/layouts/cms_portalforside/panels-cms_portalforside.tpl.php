<div class="panel-display container-24 panel-portalforside" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

  <div class="panel-region-left clearfix">
    <div class="panel-panel grid-6 panel-region-left">
      <div class="inside"><?php print $content['left']; ?></div>
    </div>
  </div>
  
  <div class="panel-region-right clearfix">
      <div class="panel-panel grid-18 panel-region-right_top">
        <div class="inside"><?php print $content['right_top']; ?></div>
      </div>

      <div class="panel-panel grid-18 panel-region-right_middle">
        <div class="inside"><?php print $content['right_middle']; ?></div>
      </div>
      
      <div class="panel-panel grid-18 panel-region-right_bottom">
        <div class="inside"><?php print $content['right_bottom']; ?></div>
      </div>
  </div>
  

</div>




