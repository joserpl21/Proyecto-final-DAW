<header id="header">
    <div class="container">
        <?php if ($logo): ?>
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                <img src="<?php print(base_path())?>sites/all/themes/personalizado/logo2.png" alt="<?php print t('Home'); ?>" title="<?php print t('Home'); ?>" />
            </a>
        <?php endif; ?>
        <?php if (!empty($site_name)): ?>
            <?php print $site_name; ?>
        <?php endif; ?>
        <?php if (!empty($site_slogan)): ?>
            <?php print $site_slogan; ?>
        <?php endif; ?>
        <?php if (!empty($page['header'])): ?>
            <?php print render($page['header']); ?>
        <?php endif; ?>
    
</header>
<style type="text/css">
  .comment-form{
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
<div class="container">
<nav class="navbar navbar-default">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    
   <?php if (!empty($primary_nav)): ?>
            <div class="navbar-collapse collapse">
                <?php if (!empty($primary_nav)): ?>
                    <?php print render($primary_nav); ?>
                <?php endif; ?>
         
            </div>
        <?php endif; ?>
  </div>
</nav>
  </div>
 
    
        
<?php if (!empty($page['premain'])): ?>
    <?php print render($page['premain']); ?>
<?php endif; ?>

<main>
    <div class="container">
        <div class="row">
            <?php if (!empty($page['sidebar_first'])): ?>
                <aside class="col-sm-3" role="complementary">
                    <?php print render($page['sidebar_first']); ?>
                </aside>
            <?php endif; ?>
            <section<?php print $content_column_class; ?>>
                <?php if (!empty($page['highlighted'])): ?>
                    <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
                <?php endif; ?>
                <?php if (!empty($breadcrumb) && count($breadcrumb)>1): print $breadcrumb; endif;?>
                <a id="main-content"></a>
                <header>
                    <?php print render($title_prefix); ?>
                    <?php if (!empty($title) && $title!='Principal' ): ?>
                        <h1><?php print $title; ?></h1>
                    <?php endif; ?>
                    <?php print render($title_suffix); ?>
                </header>
                <?php print $messages; ?>
                <?php if (!empty($tabs)): ?>
                    <?php print render($tabs); ?>
                <?php endif; ?>
                <?php if (!empty($page['help'])): ?>
                    <?php print render($page['help']); ?>
                <?php endif; ?>
                <?php if (!empty($action_links)): ?>
                    <ul class="action-links"><?php print render($action_links); ?></ul>
                <?php endif; ?>
                <?php print render($page['content']); ?>
            </section>
            <?php if (!empty($page['sidebar_second'])): ?>
                <aside class="col-sm-3" role="complementary">
                    <?php print render($page['sidebar_second']); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</main>
<script type="text/javascript">
    jQuery(document).ready(function($) { 
        $("#volver").click(function(){
           var url = "www.google.com"; 
            $(location).attr('href',url);
        });
        $(".progress").hide();
        //$(".permalink").hide();
        //alert($(".permalink").val());

           $("#edit-locale").hide();
            $("#edit-contact").hide();
            $("#edit-timezone").hide();
            $(".help-block").hide();
            $(".password-help").hide();
            $("label[for='edit-pass']").hide();
            $(".form-item-field-part-und-0-value").hide();
            $(".tabledrag-toggle-weight").hide();
            $(".form-item-print-pdf-size").hide();
            $(".form-item-print-pdf-orientation").hide();
            $(".submitted >.permalink").hide();
           // $(".list-inline").hide();
            
            //if($(".easy-breadcrumb_segment").val()="Node"){
             //   $(".easy-breadcrumb_segment").hide();
            //}
            //$(".easy-breadcrumb_segment-1").val();
            //var pruba=jQuery('.easy-breadcrumb_segment-1').val();
            //alert($("a .easy-breadcrumb_segment-1").val());
           if(!(".view").length){
            $(".btn-success").hide();
            }else{
                $(".btn-success").show();
            }          
      });
</script>

<?php if (!empty($page['submain'])): ?>
    <?php print render($page['submain']); ?>
<?php endif; ?>

<footer id="footer">
    <div class="container">
        <?php print render($page['footer']); ?>
    </div>
</footer>
