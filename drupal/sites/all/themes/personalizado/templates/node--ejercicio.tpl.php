<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
   <?php
   
   if(isset($_GET['dato'])){
	  
    print "<div class='alert alert-success'>Actividad Guardada Correctamente</div>";
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
	<?php 

	if(user_is_logged_in()){?>
   <form method="POST" action="http://jjml.xyz/drupal/registrar/mensaje">
    	<?php 
			global $user;
		$usuario = $user->name;
		$term=sacarTipoEjercicio($node->nid);
    	$fecha=  date("Y-m-d h:i:s");
    	$cal= $node->field_calorias['und'][0]['value'];
		//$tipo= $node->field_tipo_de_comida
    ?>	
	
			<input type="hidden" name="usuario" value="<?php print $usuario;?>">
		<input type="hidden" name="nid" value="<?php print $node->nid;?>">	
		<input type="hidden" name="fecha" value="<?php print $fecha;?>">
		<input type="hidden" name="cal" value="<?php print $cal;?>">
		<input type="hidden" name="ruta" value="<?php print $node_url;?>">
		<input type="hidden" name="duracion" value="<?php print $node->field_duracion['und'][0]['value'] ?>">
		<input type="hidden" name="nombre" value="<?php print $title;?>">
		<input type="hidden" name="actividad" value="ejercicio">
		<input type="hidden" name="tipo_actividad" value="<?php print $term;?>">
    	<input type="submit" name="registrar" value="Registrar" class="btn btn-success">
    </form>
	<?php }?>
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