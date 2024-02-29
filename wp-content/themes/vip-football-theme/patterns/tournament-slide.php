<?php
/**
 * Title: List of tournament, slider
 * Slug: vip-football-theme/tournament-slide
 * Categories: query
 * Block Types: core/query
 */
?>
<div id="tournamentScrollContainer" class="flex flex-no-wrap overflow-x-scroll scrolling-touch scroll-smooth items-start mb-2 pb-4">
    <?php 
        $args = array(
            'post_type' => 'tournament',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'title',

        );

        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) {
            
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                ?>
                <div class="flex-none w-32 md:w-48 sm:w-32 mr-2 md:pb-4 p-18 border:1px|solid|gray-300 p-3 rounded-lg rounded-lg">
                    <a href="<?php the_permalink() ?>" class="space-y-4">
                    <div class="aspect-w-16 aspect-h-9 bg-white">
                        <?php //the_title(); ?>
                        <?php
                        echo get_the_post_thumbnail( get_the_ID(), '168-small-square',array(
                            'class' => 'w-full h-full object-cover transition duration-300 ease-in-out shadow-md hover:shadow-xl rounded-lg',
                        ) );
                        ?>
                    </div>
                    </a>
                </div>
                <?php
            }
            wp_reset_postdata();
        }
    ?>
    
</div>