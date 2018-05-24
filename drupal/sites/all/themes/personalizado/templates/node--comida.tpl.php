<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>  >
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
 <?php 
   if(user_is_logged_in()){
     global $user;
    $usuario = $user->name; 
     }
    $nid=$node->nid;
    $estre=db_query("SELECT field_calificacion_value FROM `field_data_field_calificacion` WHERE entity_id=:nid",array(':nid'=>$nid))->fetchField();
    $totVotos=db_query("SELECT COUNT(*) FROM `valoracion` where cod_act=:nid GROUP by cod_act",array(':nid'=>$nid))->fetchField();
    $tipo="comida";
     ?> 


  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_texto_imagenes_slider']);
      hide($content['field_imagen_slider']);
      print render($content);
      $host= $_SERVER["HTTP_HOST"];
      $url= $_SERVER["REQUEST_URI"];
      $urlfinal= "http://" . $host .base_path();
      

    ?>
    
    <!--<?php foreach ($node->field_imagen['und'] as $fotos) { 
                                   
                                ?>
                                <div class="col-xs-4 col-md-4">
                                    <a href="<?php print image_style_url('ampliada', $fotos['uri']) ?>"  title="<?php print $fotos['title'] ?>" rel="shadowbox[<?php print $title; ?>]">
                                        <img src='<?php print image_style_url('detalle-miniatura', $fotos['uri']) ?>' alt="<?php print $fotos['alt'] ?>" title="<?php print $fotos['title'] ?>" class="img-responsive" />
                                    </a>
                                </div>
                            <?php } ?>
                            -->
  <div id="val">

 <?php if(isset($estre)){?>

  <form  method="POST" action="http://jjml.xyz/drupal/valorar/valor">
  <h2>Califica la comida:</h2>   
   <p class="clasificacion">
      <input id="radio1" type="radio" name="estrellas" value="5" <?php if($estre==5){print "checked";}?>  onclick="enviarEstrellas(jQuery('#radio1').val())" <?php if(!user_is_logged_in()){ print "disabled";} ?>><!--
    --><label for="radio1">★</label><!--
    --><input id="radio2" type="radio" name="estrellas" value="4" <?php if($estre==4){print "checked";}?>  onclick="enviarEstrellas(jQuery('#radio2').val())" <?php if(!user_is_logged_in()){ print "disabled";} ?>><!--
    --><label for="radio2">★</label><!--
    --><input id="radio3" type="radio" name="estrellas" value="3" <?php if($estre==3){print "checked";}?>  onclick="enviarEstrellas(jQuery('#radio3').val())" <?php if(!user_is_logged_in()){ print "disabled";} ?>><!--
    --><label for="radio3">★</label><!--
    --><input id="radio4" type="radio" name="estrellas" value="2" <?php if($estre==2){print "checked";}?>  onclick="enviarEstrellas(jQuery('#radio4').val())" <?php if(!user_is_logged_in()){ print "disabled";} ?>><!--
    --><label for="radio4">★</label><!--
    --><input id="radio5" type="radio" name="estrellas" value="1" <?php if($estre==1){print "checked";}?>  onclick="enviarEstrellas(jQuery('#radio5').val())" <?php if(!user_is_logged_in()){ print "disabled";} ?>><!--
    --><label for="radio5">★</label>
   
  </p>

  <br />

 
    
</form>

</div>
<label style="float: left; clear: both;"><?php print "Total de votos ". $totVotos; ?></label>
<?php }?>

<script>
  jQuery(document).ready(function($) { 
jQuery("#mensaje").hide();
jQuery("#mensaje2").hide();
});
function enviarEstrellas(valor){
    <?php if(user_is_logged_in()){?>
    var parametros ={
      "valor":valor,
      "nid": <?php print $nid;?>,
      "tipo": "comida",
      "uid": "<?php print $usuario ;?>",
    }; 
    jQuery("#mensaje").show();
    document.getElementById("mensaje").innerHTML = "Gracias por su valoracion!";
    
       jQuery.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'http://jjml.xyz/drupal/valorar/valor', //archivo que recibe la peticion
                type:  'post'
              });
     <?php } ?>
    
  
  }
  <?php if(!user_is_logged_in()){?>
      jQuery(".clasificacion").click(function() {
        jQuery("#mensaje2").show();
     document.getElementById("mensaje2").innerHTML = "Registrese para valorar";
    });
    <?php } ?>
</script>

	<?php 

	if(user_is_logged_in()){?>
    <form method="POST" action="<?php print url("registrar/mensaje"); ?>" style="clear: both; float: left">
    	<?php 
	
		
		$term=sacarTipoComida($node->nid);
    	$fecha= date("Y-m-d h:i:s");
    	$cal= $node->field_calorias['und'][0]['value'];

    ?>	

    
	<input type="hidden" name="usuario" value="<?php print $usuario;?>">
		<input type="hidden" name="fecha" value="<?php print $fecha;?>">
		<input type="hidden" name="ruta" value="<?php print $node_url;?>">
		<input type="hidden" name="cal" value="<?php print $cal;?>">
		<input type="hidden" name="duracion" value="0">
		<input type="hidden" name="nombre" value="<?php print $title;?>">
		<input type="hidden" name="actividad" value="comida">
		<input type="hidden" name="tipo_actividad" value="<?php print $term;?>">
    	<input type="submit" name="registrar" value="Registrar" class="btn btn-success">
    </form>

   
	<?php }?>
  </div>
  <br />
   <h3 id="mensaje" class="alert alert-success"></h3>
<h3 id="mensaje2" class="alert alert-warning"></h3>
<button id="imprimir">Imprimar receta</button>
  <script type="text/javascript">
    
    jQuery("#imprimir").click(function(){
      var url="<?php print $urlfinal ?>/print/<?php print $node->nid ?>";
      window.open(url, '_blank');
       
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