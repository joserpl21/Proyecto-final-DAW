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
	   if(user_is_logged_in()){
      $host1= "http://".$_SERVER["HTTP_HOST"]. base_path()."valorar/valor";
  
     global $user;
    $usuario = $user->uid; 
    $uid=db_query("select uid from users where uid=:uid", array(':uid'=>$usuario))->fetchField();
    $peso=db_query("SELECT field_peso_value from field_data_field_peso where entity_id=:uid",array(':uid'=>$uid))->fetchField();
     }
    $nid=$node->nid;
    $estre=db_query("SELECT field_calificacion_value FROM `field_data_field_calificacion` WHERE entity_id=:nid",array(':nid'=>$nid))->fetchField();
    $totVotos=db_query("SELECT COUNT(*) FROM `valoracion` where cod_act=:nid GROUP by cod_act",array(':nid'=>$nid))->fetchField();
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_texto_imagenes_slider']);
      hide($content['field_imagen_slider']);
      print render($content);
	  $host= $_SERVER["HTTP_HOST"];
      $url= $_SERVER["REQUEST_URI"];
      $urlfinal= "http://" . $host.$url;
      //print "<div id='body'>".$node->body['und'][0]['value']."</div>";
      //print "<img  class='img-thumbnail'src='".image_style_url('medium',$node->field_imagen['und'][0]['uri'])."'/>";
      
    ?>
  <style type="text/css">

     .clearfix{
     background: white;
  box-shadow: rgba(0,0,0,0.05) 0 3px 3px 0;
  margin: 0 20px 20px;
  
  position: relative;
  font-size: 20px;
  }
  .comment {
  background: white;
  box-shadow: rgba(0,0,0,0.05) 0 3px 3px 0;
  margin: 0 20px 20px;
  padding: 20px;
  position: relative;
  font-size: 15px;
}

.comment-reply a{
  color: white;
}
.comment-reply {
  display: inline-block;
  background-color: rgba(0, 0, 0, .7); /* pink */
  color: white;
  padding: 15px 20px;
  font-size: 15px;
  text-decoration: none;
  margin-bottom: 20px;
  transition: all 800ms cubic-bezier(.190, 1, .220, 1);
  outline: 0;
  position: relative;
}

.comment-reply:active,
.comment-reply:focus,
.comment-reply:hover {
  background: rgba(0, 0, 0, 1); /* pink 10% dark */
}


.comment .comment-reply {
  padding: 5px 10px;
  font-size: 13px;
  margin-bottom: 0;
  float: right;
  padding-left: 15px;
}
.comment span{
  float: right;
} 



  </style>
	<div id="val">
 <?php if(isset($estre)){?>
	<form  method="POST" action="<?php print url("valorar/valor"); ?>">
  <h3>Califica el ejercicio</h3>   
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
	<?php 

	if($urlfinal!="http://jjml.xyz/drupal/" && $urlfinal!="http://jjml.xyz/drupal/tipo-ejercicios/aer%C3%B3bico"
	&& $urlfinal!="http://jjml.xyz/drupal/tipo-ejercicios/anaerobico" && $urlfinal!="http://jjml.xyz/drupal/tipo-ejercicios/flexibilidad" && $urlfinal!="http://jjml.xyz/drupal/tipo-ejercicios/fuerza"){?>

    <style type="text/css">
      
      .field-name-field-imagen .img-responsive{
      float: right;
      margin-top: 3%
      }
      .field-type-youtube{
          margin-top: 10%;
          text-align: center;
      
      }
      .field-name-body{ margin-top: 3%;}
      @media ( max-width: 400px ){
        .ytp-hide-controls{
          width: 50%;
        }
        .exp-responsive{
          background-color: white;
        }
      }
      
    </style>
    <?php if(user_is_logged_in()){?>
   <form method="POST" action="<?php print url("registrar/mensaje")?>"; name='registrar' style="clear: both; float: left" ">
    	<?php 
			global $user;
		$usuario = $user->uid;

		  $term=sacarTipoEjercicio($node->nid);
    	$fecha=  date("Y-m-d H:i:s");
      if(isset($node->field_calorias['und'])){
    	$cal= $node->field_calorias['und'][0]['value'];
      }
	
    ?>	
	
			<input type="hidden" name="uid" value="<?php print $usuario;?>">
		<input type="hidden" name="nid" value="<?php print $node->nid;?>">	
		<input type="hidden" name="fecha" value="<?php print $fecha;?>">
		<input type="hidden" name="cal" value="<?php print $cal;?>">
		<input type="hidden" name="ruta" value="<?php print $node_url;?>">
		<input type="hidden" name="nombre" value="<?php print $title;?>">
		<input type="hidden" name="actividad" value="ejercicio">
		<input type="hidden" name="tipo_actividad" value="<?php print $term;?>">
    	
      <button type='button' class='btn btn-info' data-toggle='collapse' data-target='#reg' >Registrar </button>
      <div id='reg' class='collapse'>
        <?php if(!isset($peso) || empty($peso)){
        print "<div class='alert alert-warning' style='float: left; clear: both;'>Necesita ingresar su peso para organizar correctamente la rutina  ";
        
        print "<a href='". base_path()."user/".$user->uid."/edit'>Editar perfil</a></div>";}else{
           ?>
        Ingresar el tiempo que realizo el ejercicio: <input type="text" name="duracion" id="duracion" required onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">Min
        <input type="submit" name="registrar" value="Registrar" class="btn btn-success" style="float: right; clear: both;">
          
      <?php } ?>

      </div>
    </form>
    <?php }?>
	<?php }

  ?>
   
  </div>
  
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Valoracion</h4>
        </div>
        <div class="modal-body">
          <?php  if(!user_is_logged_in()){
            print "<p>Registre para valorar</p>";
          }else{
 print "<p>Gracias por valorar</p>";
          }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
<script>
  jQuery(".btn-success").show();
jQuery(document).ready(function($) { 
//jQuery("#mensaje").hide();
jQuery("#mensaje2").hide();
});
  

function enviarEstrellas(valor){
    
   	<?php if(user_is_logged_in()){?>
   		var parametros ={
      "valor":valor,
      "nid": <?php print $nid;?>,
      "tipo": "ejercicio",
      "uid": "<?php print $usuario ;?>",
    };
   jQuery("#myModal").modal('show');
   // document.getElementById("mensaje").innerHTML = "Gracias por su valoracion!";
    //alert("El valor de la votacion es " + valor);
       jQuery.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   '<?php print $host1; ?>', //archivo que recibe la peticion
                type:  'post'
              });
       
       <?php } ?>
       
  }
		<?php if(!user_is_logged_in()){?>
  		jQuery(".clasificacion").click(function() {
  			jQuery("#myModal").modal('show');
 		 
		});
  	<?php }?>
</script>
<br />

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
   
  <?php endif; ?>

  <?php print render($content['comments']); ?>
    

</div>