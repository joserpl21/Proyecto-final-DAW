<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
   <?php
   
   if(isset($_GET['dato'])){
	  drupal_set_message("Dato guardado correctamente");
   }	
	?>
    <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>

  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_texto_imagenes_slider']);
      hide($content['field_imagen_slider']);
      print render($content);



    ?>
    <ul>
      <li><a href="<?php print url('/tipo-ejercicios/aeróbico'); ?>">Ejercicio aeróbico y de resistenciao</a></li>
      <li><a href="<?php print url('/tipo-ejercicios/anaerobico'); ?>">Ejercicio anaeróbico</a></li>
      <li><a href="<?php print url('/tipo-ejercicios/flexibilidad'); ?>">Ejercicios de flexibilidad</a></li>
      <li><a href="<?php print url('/tipo-ejercicios/fuerza'); ?>">Ejercicios de fuerza, equilibrio y estabilidad</a></li>
    </ul>

	
  </div>

  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>
    

</div>