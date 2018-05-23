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

  <?php 
  global $user;
  $nombre=$user->name;
  $misMensajes=db_query("SELECT * FROM `mensajes` where receptor=:nombre",array(':nombre'=>$nombre))->fetchAll();
 
   print "<table class='table'>
      <tr><td>Emisor</td><td></td><td>receptor</td><td></td><td>Mensaje</td><td></td><td>fecha</td></tr>";
       print "<form method='POST' action=''>";
      foreach ($misMensajes as $mensaje => $mensa) {       
        print "<tr>";
        foreach ($mensa as $se => $e) {
          if($e){
            print "<td>$e<td>";
          }
        }
        print "<td><input type='submit'name='accion' value='Contestar'></td><td><input type='submit'name='accion' value='Borrar'></td></tr>";
        print "</form>";
      }
      
      print "</table>";
  ?>
 <h2 id="demo"></h2>
  <a href="<?php print url('/mensaje/form1'); ?>">Escribir nuevo mensaje</a>
	 
  </div>
   <script type="text/javascript">
     jQuery(document).ready(function($) { 
        if(!$("tr:nth-child(2)").length){
           $("#tabla").hide();
           document.getElementById("demo").innerHTML = "No hay mensajes";
          }
      });
    </script>

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