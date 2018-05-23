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
      if(isset($_GET['nombre'])){
      $buscar=$_GET['nombre'];}
      if(isset($_GET['nombre2'])){
      $buscar2=$_GET['nombre2'];}
    
      if(isset($buscar) &&  !empty($buscar)){
      $comidas=db_query("Select * FROM registro where nombre_usuario=:usuario and actividad='comida' and nombre_actividad like :nombact order by fecha DESC",array(':usuario'=>$user->name,':nombact'=>"%$buscar%"))->fetchAll();
        }else{
           $comidas=db_query("Select * FROM registro where nombre_usuario=:usuario and actividad='comida' order by fecha DESC",array(':usuario'=>$user->name))->fetchAll();
        }

    if(isset($buscar2) &&  !empty($buscar2)){
           $ejercicio=db_query("Select * FROM registro where nombre_usuario=:usuario and actividad='ejercicio' and nombre_actividad like :nombact order by fecha DESC",array(':usuario'=>$user->name,':nombact'=>"%$buscar2%"))->fetchAll();
     }else{
       $ejercicio=db_query("Select * FROM registro where nombre_usuario=:usuario and actividad='ejercicio' order by fecha DESC",array(':usuario'=>$user->name))->fetchAll();
      }
      $datos;
      //print_r($comidas);
     // print_r($ejercicio);
    //    $JsonEjercicio= json_encode($ejercicio);
      if(!empty($comidas) || isset($buscar) ){
      print "<br />";
      if(isset($buscar)){
        print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#com'>Ver comidas</button>";
      print "<div id='com' class='collapse in' style='hight: auto;'>";
      
      }else{
      print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#com'>Ver comidas</button>";
      print "<div id='com' class='collapse'>";
        
      }
       ?>
       <input type="text" id="buscar"style="margin-top: 1%;">
       <input type="submit" value="buscar" onclick="buscador2(jQuery('#buscar').val())">
       <?php 
      if(isset($comidas) && !empty($comidas)){
      print "<table class='table'><tr><td>Fecha</td><td>Nombre Actividad</td><td>cal</td><td>Tipo</td></tr>";
             foreach ($comidas as $co => $c) {       
             foreach ($c as $se => $e) {
          if($se=="fecha"){
          $s=new DateTime($e);
                $fecha = $s->format('d-m-Y h:i:s');            
            
          }
          if($se=="nombre_actividad"){
           $nomAct=$e; 
          }
          if($se=="cal"){
            $cal=$e;            
          }
          if($se=="duracion"){
            $dur=$e;
          }

          if($se=="tipo_actividad"){
            $tipAct=$e;
          }

        }
        print "
<tr><th>$fecha</th>
<th>$nomAct</th>
<th>$cal</th>
<th>$tipAct</th></tr>";
                }
                ?>
            </table>
            <?php }else{
              print "<div class='alert alert-info' style='margin-top 1%;'>No existen comidas con ese filtro!</div>";
            } ?>
        </div>
        <?php }else{?>
            <div class="alert alert-info">Aun  no has registrado ninguna comida!</div>
         <?php } ?> 

<?php 
        if(!empty($ejercicio)|| isset($buscar2)){
        ?>
<br />
        <?php
        if(isset($buscar2)){
        print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#ejer' style='margin-top: 1%;'>Ver ejericios</button>";
      print "<div id='ejer' class='collapse in' style='hight: auto;'>";
      
      }else{
      print "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#ejer' style='margin-top: 1%;'>Ver ejercicio</button>";
      print "<div id='ejer' class='collapse'>";
        
      }?>
        <?php ?>
        <input type="text" id="buscar2" style="margin-top: 1%;">
       <input type="submit" value="buscar" onclick="buscador1(jQuery('#buscar2').val())">
        <?php
        if(isset($ejercicio) && !empty($ejercicio)){
        print "<table class='table'>
      <tr><td>Fecha</td><td>Nombre Actividad</td><td>cal</td><td>duracion</td><td>Tipo</td></tr>";
      foreach ($ejercicio as $co => $c) {       
        print "<tr>";
        foreach ($c as $se => $e) {
           if($se=="fecha"){
            $s=new DateTime($e);
            $fecha = $s->format('d-m-Y h:i:s');
          }
          if($se=="nombre_actividad"){
           $nomAct=$e; 
          }
          if($se=="cal"){
            $cal=$e;            
          }
          if($se=="duracion"){
            $dur=$e;
          }
          //if($se=="actividad"){
            //$act=$e;
          //}
          if($se=="tipo_actividad"){
            $tipAct=$e;
          }      
        }
        print "
<tr><th>$fecha</th>
<th>$nomAct</th>
<th>$cal</th>
<th>$dur</th>
<th>$tipAct</th></tr>";
      }
      
      print "</table>";
       }else{
              print "<div class='alert alert-info' style='margin-top 1%;'>No existen comidas con ese filtro!</div>";
            } 
    ?>
	</div>
<?php }elseif($buscador2){ ?>
  <div class="alert alert-info">No hay ningun ejercicio con ese filtro!</div>
<?php }else{?>
 <div class="alert alert-info">Aun no has registrado niguna ejercicio!</div>
<?php }?>
 <br />

  <?php
  $nids=[];
  $favoritas = db_query("SELECT nombre_actividad as Ejercicios  FROM registro WHERE nombre_usuario=:user and actividad='ejercicio'  GROUP BY nombre_actividad ORDER BY Ejercicios DESC LIMIT 3",array(':user'=>$user->name))->fetchCol();
  $nfav = db_query("SELECT count(*) as Ejercicios  FROM registro WHERE nombre_usuario=:user and actividad='ejercicio'  GROUP BY nombre_actividad ORDER BY Ejercicios DESC LIMIT 3",array(':user'=>$user->name))->fetchCol();
  foreach ($favoritas as $fav) {
    $nids[]= db_query("SELECT nid FROM `node_revision` where title=:titulo",array('titulo'=>$fav))->fetchField();
  }

  foreach ($nids as $img) {
    $imgs[]=db_query("SELECT filename FROM `file_managed` as m inner join field_data_field_imagen as c on m.fid=c.field_imagen_fid where entity_id=:nid",array(':nid'=>$img))->fetchField();
  }

   ?>
   <?php if(isset($favoritas)):?>
    <h2 style="margin-top: 2%;">Ejercicios Favoritos</h2>
    <br />
   <div class="row">
    <?php
    $i=-1;
    foreach ($favoritas as $fav) {
      $i++;
      print "<div class='col-sm-4'>";
      print "<h3><a href=".url("/node/$nids[$i]").">$fav</a><h3>";
     // print "<img src=http://jjml.xyz/drupal/sites/default/files/$imgs[$i] alt=$fav/>" ;
      print "<img src='". image_style_url("medium",$imgs[$i])."'' alt=$fav/>" ;
      print "<h4>Nº de registros $nfav[$i]</h4>";
      print "</div>";
    }
     ?>
    </div>
    <br />
  <?php endif?>

   
  <?php 
 $nids=[];
 $imgs=[];

  $favoritas = db_query("SELECT nombre_actividad as Ejercicios  FROM registro WHERE nombre_usuario=:user and actividad='comida'  GROUP BY nombre_actividad ORDER BY Ejercicios DESC LIMIT 3",array(':user'=>$user->name))->fetchCol();
  $nfav = db_query("SELECT count(*) as Ejercicios  FROM registro WHERE nombre_usuario=:user and actividad='comida'  GROUP BY nombre_actividad ORDER BY Ejercicios DESC LIMIT 3",array(':user'=>$user->name))->fetchCol();
  foreach ($favoritas as $fav) {
    $nids[]= db_query("SELECT nid FROM `node_revision` where title=:titulo",array('titulo'=>$fav))->fetchField();
  };

  foreach ($nids as $img) {
    $imgs[]=db_query("SELECT filename FROM `file_managed` as m inner join field_data_field_imagen as c on m.fid=c.field_imagen_fid where entity_id=:nid",array(':nid'=>$img))->fetchField();
  }

  if(isset($favoritas)){
  ?>

    <h2>Comidas Favoritas </h2> 
   <br />
    <div class="row">
  <?php 
    $i=-1;
    foreach ($favoritas as $fav) {
      $i++;
      print "<div class='col-sm-4'>";
      print "<h3><a href=".url("/node/$nids[$i]").">$fav<a><h3>";
     // print "<img src=http://jjml.xyz/drupal/sites/default/files/$imgs[$i] alt=$fav/>" ;
      print "<img src='". image_style_url("medium",$imgs[$i])."'' alt=$fav/>" ;
      print "<h4>Nº de registros $nfav[$i]</h4>";
      print "</div>";
    }
   ?>
  </div>
  <?php }?>
  </div>
  <script type="text/javascript">
    function buscador2(buscar){

      var url = jQuery(location).attr('href');
      
      //if(url.length>0){
          //alert("Tiene ".tien[0]);
      //}else{
      // if(url.indexOf("nombre=")!=-1){
       // var urlLimpia=url.split('?');
         // url+='&nombre';
       //}else{
        url+="?nombre="+buscar;
     
      //alert("Funcionaa  "+ url);
      window.location.replace(url);
    }
    function buscador1(buscar){

      var url = jQuery(location).attr('href');
      url+="?nombre2="+buscar;
      //alert("Funcionaa  "+ url);
      window.location.replace(url);
    }
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
    
<!--function buscador2(){
  var busqueda=jQuery('form#buscador #edit-search-block-form--2').val();
     //Si el campo de busqueda no esta vacío
  if(busqueda!=''){
    //cogemos la url actual
    var url = jQuery(location).attr('href');
    
    //cogemos los parametros de busqueda
    var URLsearch = window.location.search;
    //comprobamos que hay parametros de busqueda
    if(URLsearch!=''){
      //miramos si ya hemos buscado antes el título
      if(URLsearch.indexOf("title=")!=-1){
        //sustituimos la url entera con la url limpia sin parametros de busqueda
        var urlLimpia=url.split('?');
        url=urlLimpia[0]+'?';
        //miramos si tiene más de un parametro
        if(URLsearch.indexOf('&')!=-1){
              //si los tiene, los almacenamos en un array
            var cadena=URLsearch.split("&"); 
            var contador=0;
            //recorremos el array para completar la cadena
            for (c in cadena){
              //miramos si el array contiene ya el titulo. Si no simplemente se añadirá el título detrás
              if(cadena[c].indexOf("title=")==-1){
                //si no lo contiene, vamos repasando parametro con parametro y concatenandolos
                var aux=cadena[c].replace('?','');
                if(contador==0){
                  url+=aux;
                }else{
                  url+='&'+aux;
                }
                contador++;
              }
            }
        url+='&';
            
        }
      
      //si no hemos buscado nada, directamente lo añadimos.   
      }else{
        
        url+='&';
      }
    //si no hay parametros de busqueda, directamente añadimos el titulo.
    }else{
      url+='?';
    }
    url+='title='+busqueda;
     jQuery('#buscador').attr('action',url);
       jQuery('#buscador').submit();
  }else{
    jQuery('.buscador .mensaje').html('Campo obligatorio.');
    jQuery('.buscador #edit-search-block-form--2').addClass('error');
  }
}-->
</div>