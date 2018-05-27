<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
   <?php
   
   if(isset($_GET['dato'])){
	  
    print "<div class='alert alert-success'>Inscrito Correctamente</div>";
   }	
   if(isset($_GET['desc'])){
	print "<div class='alert alert-success'>Desinscrito Correctamente</div>";   
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
      // We hide the comments and linksn ow so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_texto_imagenes_slider']);
      hide($content['field_imagen_slider']);
      print render($content);
      hide($content['field_invitar']);
      $cant=db_query("SELECT field_part_value from field_data_field_part where entity_id=:id",array(':id'=>$node->nid))->fetchField();
      $participantes=db_query("SELECT participante FROM `participantes`where cod_evento=:cod",array(':cod'=>$node->nid))->fetchCol();
      
    ?>
      <h3>Nº Participantes</h3>       
    <?php

      print $cant."<br />";
    $v=db_query("SELECT log FROM node_revision WHERE vid=:vid",array(':vid'=>$node->nid))->fetchField();
    
    if($v==0){
      $nveces=db_query("UPDATE `node_revision` SET `log`=1 WHERE vid=:vid",array(':vid'=>$node->nid));
      $emails=[];
      if(isset($node->field_invitar['und'])){
      foreach ($node->field_invitar['und'] as $nod) {
          $emails[]=db_query("SELECT mail from users where name=:nombre",array(':nombre'=>$nod['value']))->fetchField();       
        }
      }
      
        if(isset($emails) && !empty($emails)){
      $host= $_SERVER["HTTP_HOST"];
      $url= $_SERVER["REQUEST_URI"];
      $urlfinal= "http://" . $host . $url;
      $autor=db_query("SELECT uid FROM `node` WHERE nid=:nid
      ",array(':nid'=>$node->nid))->fetchField();
      $nombreAutor = db_query("SELECT name from users where uid=:uid",array(':uid'=>$autor))->fetchField(); 
      foreach ($emails as $email) {
    $para      = $email;
    $titulo    = 'Invitacion a evento';
    $mensaje   = 'Este es un correo de la aplicacion JJML,el usuario ' . $nombreAutor .' te a invitado a participar en el evento ' . $title .' para confirmar ingrese en el siguiente enlace ,registrese y confirme su asistencia ' . $urlfinal;
    $cabeceras = 'From: josep2112ml@gmail.com' . "\r\n" .
    'Reply-To: josep2112ml@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $respuesta=mail($para, $titulo, $mensaje, $cabeceras);
    //print_r($respuesta);
        }     
      }
    }
      
    

    if(user_is_logged_in()){
     global $user;
    $usuario = $user->name;}     
    //var_dump($participantes);
    if(isset($participantes)){
    print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#env'>Participantes registrado</button>";
      print "<div id='env' class='collapse'>"; 
    foreach ($participantes as $part) {
      if(isset($usuario)){
      if($usuario==$part){

        $existe=true;
      }  
      }
      
        print "$part <br />";
      
    }
      print "</div>";
    }


	   if(user_is_logged_in()&& isset($user)){
    
      ?> 

      <form action="<?php print url("participar/registrar"); ?>" method="POST">
        <input type="hidden" name="cod_evento" value="<?php print $node->nid ?>">
        <input type="hidden" name="nid" value="<?php print $user->uid; ?>">
        <input type="hidden" name="usuario" value="<?php print $usuario ?>">
        <input type="hidden" name="ruta" value="<?php print $node_url;?>">
        <input type="submit"  class="btn btn-success" value="Participar" name="accion"<?php if(isset($existe)){if($existe){ print "disabled";}}?>>
        <?php 
        if(isset($existe)){
        if($existe){
          print "<input type='submit' class='btn btn-warning' value='Quitar participacion' name='accion'>";
        }}?>
      </form>
<?php
     }

    ?>


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