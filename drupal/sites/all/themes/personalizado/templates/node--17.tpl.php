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
  if(isset($_GET['borrar'])){
    print "<div class='alert alert-info'>Mensaje borrado</div>";
  }
  if(isset($_GET['enviado'])){
    print "<div class='alert alert-info'>Mensaje enviado</div>";
  }
  if(isset($misMensajes) && !empty($misMensajes)){
  	if(isset($_GET['borrar'])){
 	print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#com'>Buson de entrada</button>";
    print "<div id='com' class='collapse in'>";
  	}else{
  		 print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#com'>Buson de entrada</button>";
    print "<div id='com' class='collapse'>";
  	}
   
    print "<table class='table'>
      <tr><td>De</td></td><td>Mensaje</td><td>fecha</td></tr>";
       
      foreach ($misMensajes as $mensaje => $mensa) {       
        print "<form method='POST' action='". url("mensaje/form1")."'>";
        print "<tr>";
        foreach ($mensa as $se => $e) {
          if($se=='cod_mensaje'){
            $cod=$e;
          }
          if($se=='emisor'){
           $emisor=$e;
          }
          if($se=='fecha'){
            $fechaBuena=new DateTime($e);
                $prueba = $fechaBuena->format('d-m-Y H:i:s');
            print "<th>$prueba</th>"; 
          }
          if($se!='cod_mensaje' && $se!='receptor' && $se!='fecha'){
            print "<th>$e</th>";
          }

        }
        print "<td><input type='hidden' name='cod' value=$cod>
        <input type='hidden' name='nombre' value=$emisor>
        <input type='submit'name='accion' value='Contestar'></td><td><input type='submit'name='accion' value='Borrar'></td></tr>";
        print "</form>";
      }
      
      print "</table>";
      print "</div>";
  }else{
  	print "<div class='alert alert-info'>No tiene mensajes recibidos</div>" ;
  }
  ?>
<?php
    $misMensajes=db_query("SELECT * FROM mensajes WHERE emisor=:nombre",array(':nombre'=>$nombre))->fetchAll();
  //if(isset($_GET['borrar'])){
  //  print "<div class='alert alert-info'>Mensaje borrado</div>";
  //}
  if(isset($_GET['enviado'])){
    print "<div class='alert alert-info'>Mensaje enviado</div>";
  }
  if(isset($misMensajes) && !empty($misMensajes)){
  	if(isset($_GET['borrar'])){
 	print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#env'>Mensajes Enviados</button>";
      print "<div id='env' class='collapse in'>";
  	}else{
  		 print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#env'>Mensajes Enviados</button>";
      print "<div id='env' class='collapse'>";

  	}
   
        print "<table class='table'>
      <tr><td>Para</td></td><td>Mensaje</td><td>fecha</td></tr>";
       
      foreach ($misMensajes as $mensaje => $mensa) {       
        print "<form method='POST' action='". url("mensaje/form1")."'>";
        print "<tr>";
        foreach ($mensa as $se => $e) {
          if($se=='cod_mensaje'){
            $cod=$e;
          }
          if($se=='receptor'){
           $emisor=$e;
          }
          if($se=='fecha'){
            $fechaBuena=new DateTime($e);
                $prueba = $fechaBuena->format('d-m-Y h:i:s');
            print "<th>$prueba</th>"; 
          }
          if($se!='cod_mensaje' && $se!='emisor' && $se!='fecha'){
            print "<th>$e</th>";
          }

        }
        print "<td><input type='hidden' name='cod' value=$cod>
        <input type='hidden' name='nombre' value=$emisor>
        </td><td><input type='submit'name='accion' value='Borrar'></td></tr>";
        print "</form>";
      }
      
      print "</table>";
      print "</div>";
  }else{
  	print "<div class='alert alert-info'>No ha enviado ningun mensaje</div>" ;
  }
  ?>
  
  <a href="<?php print url('/mensaje/form1'); ?>">Escribir nuevo mensaje</a>
	 
  </div>
   <script type="text/javascript">
     jQuery(document).ready(function($) { 
        $("#demo").show();
        if(!$("tr:nth-child(1)").length){
           $("#tabla").hide();
            
           
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