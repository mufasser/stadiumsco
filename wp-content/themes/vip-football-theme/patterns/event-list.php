<?php
/**
 * Title: List of event, grid
 * Slug: vip-football-theme/event-list
 * Categories: query
 * Block Types: core/query
 */
?>

<div id="eventScrollContainer" class="flex flex-wrap overflow-x-scroll scrolling-touch items-start pb-8">
    <?php 
    $tournamentId = get_the_ID();
        $args = array(
            'post_type' => 'xs2_event',
            'posts_per_page' => 5,
            'order' => 'ASC',
            'orderby' => 'title',
            'ID' => $tournamentId
        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
            ?>
            <?php
                $eventLink = get_the_permalink(get_the_ID());
                
                $tournamentName = get_field('tournament_name',get_the_ID());
                $venueName = get_field('venue_name',get_the_ID());
                
                $eventDate = get_field('date_start',get_the_ID());
                $eventDateTime = formatDateTime($eventDate);

                $price =  intVal(get_field('min_ticket_price_eur', get_the_ID()));
                $price =  getDecoratedPrice($price);

                $hostTeamId =  get_field('hometeam_id', get_the_ID());
                $visitTeamId =  get_field('visitingteam_id', get_the_ID());
                $hostTeamData = getTeamByTeamId($hostTeamId);
                $visitTeamData = getTeamByTeamId($visitTeamId);

                ?>
                <a href="<?php the_permalink() ?>" class="space-y-4"></a>

                <div class="flex-none event-wrapper w-96 md:w-96 sm:w-32 mr-8 md:pb-4 border:1px|solid|gray-300 bg-white shadow-lg transition duration-300 ease-in-out hover:shadow-xl relative rounded-lg">
                    <div class="flex-shrink-0 h-32 w-230 rounded-t-4xl overflow-hidden mb-10">
                    <?php
                        echo get_the_post_thumbnail( get_the_ID(), 'medium',array(
                            'class' => 'w-full h-full object-cover shadow-md hover:shadow-xl rounded-lg',
                        ) );
                        ?>
                    </div>
                    <div class="team-group flex px-4 py-9 absolute top-0 event-teams-wrapper">

                        <div class="flex min-w-0  w-26 md:w-30 sm:w-32">
                            <a href="" class="h-20 w-32 border:1px|solid|gray-300 ">
                                <img src="<?php echo $hostTeamData['logo']; ?>" alt="" sizes="" srcset="" class="w-full rounded-full shadow-lg">
                            </a>
                        </div>
                        <div class="flex py-6 px-4 w-20 md:w-20 sm:w-14">
                            <strong class="text-3xl font-bold text-white">VS</strong>
                        </div>
                        <div class="flex min-w-0  w-26 md:w-30 sm:w-32">
                            <a href="" class="h-20 w-32 border:1px|solid|gray-300 ">
                                <img src="<?php echo $visitTeamData['logo']; ?>" alt="" sizes="" srcset="" class="w-full rounded-full shadow-lg">
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-left px-6">
                        <div class="flex-none justify-center items-center m-1 font-medium py-4 px-8 bg-white rounded-full text-blue-500 bg-blue-100 border border-blue-200 ">
                            <div class="font-normal text-1xl leading-none max-w-full flex-initial"><?php echo $tournamentName?></div>
                        </div>
                    </div>
                    <!-- event title -->
                    <div class="flex flex-wrap justify-left py-6 px-6">
                        <h3 class="font-normal text-[1.2rem] leading-none max-w-full flex-initial font-Poppins font-[600]"><?php the_title(); ?></h3>
                    </div>
                    <!-- venue name -->
                    <div class="flex flex-wrap justify-left mt-4 px-6">
                        <a class="-mx-1.5 -my-1 flex items-center gap-3 rounded-lg px-1.5 py-1 text-[0.8125rem] font-semibold leading-6 text-slate-900 transition hover:bg-slate-900/[0.03]" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="h-6 w-6 text-blue-500">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path strokeLinecap="round" strokeLinejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span class="text-lg font-normal md:inline"><?php echo $venueName?></span>
                        </a>
                    </div>
                    <!-- date name -->
                    <div class="flex flex-wrap justify-between mt-4 px-6">
                        <a href="" class="flex  dark:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="h-6 w-6 text-blue-500">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            <span class="text-md font-normal px-3 md:inline"><?php echo $eventDateTime['date']?></span>
                        </a>
                        <span class="px-4">|</span>
                        <a href="" class="flex  dark:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="h-6 w-6 text-blue-500">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="text-md font-normal px-3 md:inline "><?php echo $eventDateTime['time']?></span>
                        </a>
                    </div>

                    <div class="flex flex-wrap justify-between mt-8 mb-4 px-6">
                        <div class="flex">
                            <span class="text-xl pt-4"><?php echo $price?></span>
                        </div>
                        <a class="flex items-center gap-3 rounded-full px-8 py-4 text-lg text-[0.8125rem] font-bold leading-6 text-white bg-red-500 transition hover:bg-blue-900" 
                        href="<?php echo $eventLink; ?>">
                            Book
                        </a>
                    </div>
                </div>

                
                <?php
            }
            wp_reset_postdata();
        }
    ?>
    
</div>