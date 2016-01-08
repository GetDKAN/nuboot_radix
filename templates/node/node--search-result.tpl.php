<?php
$groups = og_get_entity_groups('node', $node);
$group_list = null;

if(!empty($groups['node'])) {
    $groups = array_map(function($gid){
        $g = node_load($gid);
        return $g->title;
    }, array_values($groups['node']));
    $group_list = implode(',', $groups);
}
?>
<article class="node-teaser row" xmlns="http://www.w3.org/1999/html">
   <div class="col-md-2">
    <?php
        $icon_src = drupal_get_path('module', 'facet_icons') . '/facet_icons/content_types/' . $type . '.svg';
        print theme('image', array('path' => $icon_src, 'attributes' => array('typeof'=> 'foaf:Image')));
    ?>
   </div>
   <div class="col-md-10">
       <h2 class="node-title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
       <p><?php print $group_list ?></p>
       <?php print render($content['resources']); ?>
   </div>
</article>