<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

    <header>
        <?php print render($title_prefix); ?>
        <?php if (!$page): ?>
            <h2<?php print $title_attributes; ?>>
                <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
            </h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
    </header>

    <?php if ($display_submitted): ?>
        <div class="meta submitted">
            <?php print $user_picture; ?>
            <?php print $submitted; ?>
        </div>
    <?php endif; ?>

    <div class="content clearfix"<?php print $content_attributes; ?>>
        <?php
            hide($content['comments']);
            hide($content['links']);
        ?>
        <?php print render($content); ?>
    </div>

    <?php
        if ($teaser || !empty($content['comments']['comment_form'])) {
            unset($content['links']['comment']['#links']['comment-add']);
        }
        $links = render($content['links']);
        if ($links):
    ?>
        <div class="link-wrapper">
            <?php print $links; ?>
        </div>
    <?php endif; ?>

    <?php print render($content['comments']); ?>

</article>
