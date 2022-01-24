<article class="posts-container__post posts-container__post--hero">
    <a class="post" href="<?php the_permalink(); ?>">
        <div class="post__image" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>)">
            <div class="post__overlay">
                <h2 class="post__title"><?php the_title(); ?></h2>
                <time class="post__date"><?php echo get_the_date(); ?></time>
            </div>
        </div>
    </a>
</article>