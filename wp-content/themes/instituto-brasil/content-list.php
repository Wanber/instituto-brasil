<article <?php post_class('article'); ?> id="post-<?php the_ID(); ?>" itemscope
                                         itemtype="http://schema.org/CreativeWork">

    <div class="w-row">

        <?php $thumb = get_the_post_thumbnail_url() . '?w=100&h=100'; ?>

        <div class="w-clearfix w-col w-col-3">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo $thumb ?>" class="alignleft"/>
                </a>
            <?php endif; ?>
        </div>

        <div class="w-col w-col-9">
            <div class="blog-data-list"><?php echo get_the_date('l, j \d\e F \d\e Y') ?></div>
            <div itemprop="headline" class="blog-titulo-list">
                <a itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage"
                   href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </div>
            <div class="blog-resumo-list">
                <?php echo substr(get_the_excerpt(), 0, 140); ?>
            </div>
        </div>
    </div>

    <hr/>


</article><!-- .article -->