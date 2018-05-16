<header id="header">
    <div class="container">
        <?php if ($logo): ?>
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" title="<?php print t('Home'); ?>" />
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
    </div>
</header>

<nav class="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <?php if (!empty($primary_nav)): ?>
            <div class="navbar-collapse collapse">
                <?php if (!empty($primary_nav)): ?>
                    <?php print render($primary_nav); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</nav>

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

<?php if (!empty($page['submain'])): ?>
    <?php print render($page['submain']); ?>
<?php endif; ?>

<footer id="footer">
    <div class="container">
        <?php print render($page['footer']); ?>
    </div>
</footer>
