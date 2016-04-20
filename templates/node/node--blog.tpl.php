<?php

/**
 * @file
 * Blog node.
 */
hide($content['comments']);
hide($content['links']);
hide($content['field_content_image']);
global $base_url;
$user = user_load($node->uid);
$img = !empty($content['field_content_image']['#items'][0]['uri']) ? $content['field_content_image']['#items'][0]['uri'] : NULL;
$img_path = file_create_url($img);
$name = !empty($user->name) ? $user->name : 'anonymous';
?>

<?php if ($teaser || !$page): ?>
  <?php if($img) : ?>
    <article class="node-teaser">
      <div class="blog-image col-md-3" <?php print ' style="background-image:url(' . $img_path . ');"' ?>></div>
  <?php else : ?>
    <article class="node-teaser no-image">
  <?php endif; ?>

      <div class="content <?php if($img) { print 'col-md-9'; } ?>"<?php print $content_attributes ?>>
        <?php print render($title_prefix); ?>
          <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
        <?php print render($title_suffix); ?>
        <?php if ($display_submitted): ?>
          <div class="submitted">
            <?php if(!empty($user->name)) { print ' Posted by <a href="' . $base_url . '/users/' . $name . '">' . $name . '</a> on ' . date('F j, Y', $node->created) . '  <i class="fa fa-clock-o" aria-hidden="true"></i> '  . date('g:ia', $node->created); }
              else { print ' Posted by ' . $name . ' on ' . date('F j, Y', $node->created) . '  <i class="fa fa-clock-o" aria-hidden="true"></i> '  . date('g:ia', $node->created); }
            ?>
          </div>
        <?php endif; ?>

        <?php
          print render($content);
          print render($content['links']);
        ?>

      </div>

    </article>

<?php else: ?>

  <article class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <?php if($img) : ?>
      <div class="content"<?php print $content_attributes; ?>>
        <div class="blog-image">
          <?php print theme('image_style', array('path' => $content['field_content_image']['#items'][0]['uri'], 'style_name' => 'story_image_teaser')); ?>
        </div>
    <?php else : ?>
      <div class="content no-image"<?php print $content_attributes; ?>>
    <?php endif; ?>
      <?php print render($title_prefix); ?>
        <h1<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h1>
      <?php print render($title_suffix); ?>
      <?php if ($display_submitted): ?>
        <div class="submitted">
          <?php print ' Posted by <a href="users/' . $user->name . '">' . $user->name . '</a> on ' . date('F j, Y', $node->created) . '  <i class="fa fa-clock-o" aria-hidden="true"></i> '  . date('g:ia', $node->created); ?>
        </div>
      <?php endif; ?>

      <?php
        print render($content);
      ?>
    </div>

    <?php print render($content['links']); ?>

    <?php print render($content['comments']); ?>

<?php endif; ?>