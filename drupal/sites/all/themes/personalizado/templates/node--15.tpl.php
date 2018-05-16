<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
   <?php
   
   if(isset($_GET['dato'])){
	  drupal_set_message("Dato guardado correctamente");
   }	
	?>
    <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attdibutes; ?>>
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

      global $user;
      //Opcion utilzar el data table si es necesario utilizar el jsondecode y encode
      
      $comidas=db_query("Select * FROM registro where nombre_usuario=:usuario and actividad='comida'",array(':usuario'=>$user->name))->fetchAll();
    
      $ejercicio=db_query("Select * FROM registro where nombre_usuario=:usuario and actividad='ejercicio'",array(':usuario'=>$user->name))->fetchAll();
    //    $JsonEjercicio= json_encode($ejercicio);
      print "<br />";
      print "<h2>Comidas</h2>";
      print "<table class='table'>
      <tr><td>Nombre</td><td></td><td>Fecha</td><td></td><td>Nombre Actividad</td><td></td><td>cal</td><td></td><td>Tipo</td></tr>";
      foreach ($comidas as $co => $c) {       
        print "<tr>";
        foreach ($c as $se => $e) {
          if($se!="duracion" && $e!="comida"){
            print "<td>$e<td>";
          }

   
        }
        print "</tr>";
      }
      
      print "</table >";
      print "<h2>Ejercicios</h2>";
        print "<table class='table'>
      <tr><td>Nombre</td><td></td><td>Fecha</td><td></td><td>Nombre Actividad</td><td></td><td>cal</td><td></td><td>duracion</td><td></td><td>Tipo</td></tr>";
      foreach ($ejercicio as $co => $c) {       
        print "<tr>";
        foreach ($c as $se => $e) {
         if($e!="ejercicio"){
            print "<td>$e<td>";
          }

       
   
        }
        print "</tr>";
      }
      
      print "</table>";

    ?>
	
  </div>
 
  
<!--

  <table id="my-example">
    <thead>
      <tr>
          <th>Nombre de usuario</th>
          <th>Fecha</th>
          <th>Nombre Actividad</th>
          <th>cal</th>
          <th>duracion</th>
          <th>Actividad</th>
          <th>Tipo de Actividad</th>
      </tr>
    </thead>
  </table>
  <script type="text/javascript">
   jQuery(document).ready(function($) { 
      $('#my-example').dataTable({
        "bProcessing": true,
        "sAjaxSource": <?php //print $JsonEjercicio; ?>,
        "aoColumns": [
              { mData: 'nombre_usuario' } ,
              { mData: 'fecha' },
              { mData: 'nombre_actividad' },
              { mData: 'cal' },
              { mData: 'duracion' },
              { mData: 'actividad' },
              { mData: 'tipo_actividad' }

            ]
      });  
  });    

  </script>-->
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