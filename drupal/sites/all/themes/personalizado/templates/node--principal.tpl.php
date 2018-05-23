   <div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
    <?php $i = 0; ?>
    <?php foreach($node->field_imagenes_slider['und'] as $slide){ ?>
        <li data-target="#myCarousel" data-slide-to="<?php print $i; ?>" class="<?php if($i == 0){print " active ";}?>"></li>
        <?php $i++; ?>
    <?php } ?>
</ol>
<div class="carousel-inner" role="listbox">
    <?php $i = 0; ?>
    <?php foreach($node->field_imagenes_slider['und'] as $slide){ ?>
        <div class="item row <?php if($i == 0){print " active ";}?>">
            <?php if(isset($node->field_texto_imagenes_slider['und'][$i]['value']) && $node->field_texto_imagenes_slider['und'][$i]['value'] != ""){ ?>
                <div class="slideText">
                  <?php if(isset($node->field_enlace_slider['und'][0]['value']) && $node->field_enlace_slider['und'][0]['value']!="vacio"): ?>
                  <a href="<?php print $node->field_enlace_slider['und'][0]['value']; ?>">
                  <?php endif; ?>
                   
                    <?php if(isset($node->field_enlace_slider['und'][0]['value']) && $node->field_enlace_slider['und'][0]['value']!="vacio"): ?>
                </a>
                   <?php    endif; ?>
                </div>
                <!--<div class="col-md-8">-->
            <?php }//else{ ?>
                <div class="col-md-12">
            <?php //} ?>
                <img src="<?php print image_style_url('slide', $slide['uri']); ?>" alt="<?php print $slide['alt']; ?>" 
                    title="<?php print $slide['title']; ?>" class="img-responsive">
                      <div class="carousel-caption">
                        <h3><?php print $node->field_texto_imagenes_slider['und'][$i]['value'] ;?></h3>
                        
                    </div>
                </div>
        </div>
        <?php $i++; ?>
    <?php } ?>
</div>
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
</a>
</div>
   

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
      hide($content['field_imagenes_slider']);
      
    ?>
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
