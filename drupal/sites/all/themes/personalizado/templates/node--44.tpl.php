<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?> style="margin-top: 2%;">

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
      hide($content);
      hide($content['title'])
    ?>
	<?php if(isset($node->field_image['und'][0])) {?>
  <div id="cont" class="container">
  <div class="row">
    <div class="col-sm-6" >
      <img class="img-thumbnail" src="<?php print image_style_url("medium",$node->field_image['und'][0]['uri']) ?>" alt="Ejercicio aeróbico" style="width:100%"/>
		<div class="middle">
    <div class="text"><a href="<?php print url('/tipo-ejercicios/aeróbico'); ?>">Ejercicio aeróbico</a></div>
  </div>
	</div>
    <div class="col-sm-6" >	
	<img class="img-thumbnail" src="<?php print image_style_url("medium",$node->field_image['und'][2]['uri']) ?>" alt="Ejercicios de flexibilidad" style="width:100%" />
    <div class="middle">
    <div class="text"><a href="<?php print url('/tipo-ejercicios/flexibilidad'); ?>">Ejercicios de flexibilidad</a></div>
		</div>
	</div>
  </div>
   <div class="row">
    <div class="col-sm-6" >
      <img class="img-thumbnail" src="<?php print image_style_url("medium",$node->field_image['und'][1]['uri']) ?>" alt="Ejercicio anaeróbico" style="width:100%" />
    <div class="middle">
    <div class="text"><a href="<?php print url('/tipo-ejercicios/anaerobico'); ?>">Ejercicio anaeróbico</a></div>
  </div>
	</div>
   
	 <div class="col-sm-6" >	
	<img class="img-thumbnail" src="<?php print image_style_url("medium",$node->field_image['und'][3]['uri']) ?>" alt="Ejercicios de fuerza" style="width:100%"/>
    <div class="middle">
    <div class="text"><a href="<?php print url('/tipo-ejercicios/fuerza'); ?>">Ejercicios de fuerza</a></div>
		</div>
	</div>
  </div>
  
  <style>
  #cont img:hover{
	   opacity: 0.5;
  }
  #cont  img {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
	}
	
  #cont {
    position: relative;
  
}
.col-sm-6:hover .middle {
  opacity: 1;
}
.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}
.middle a {
color:white;	
}
.text {
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}
  </style>
</div>
      
      
     
		
		
      
   
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