<?php
/**
 * Title: Footer Pattern
 * Slug: vip-football-theme/footer-pattern
 * Categories: query
 * Block Types: core/query
 */
?>

<!-- site url -->
<div class="content-center footer-logo w-full">
    <a class="text-md" href="<?php echo home_url()?>" title="<?php echo bloginfo('site_name') ?>">
        <img src="/wp-content/uploads/2024/01/stadiumz.co-logo-light-512.webp" alt="" class="w-[180px] m-auto">
    </a>
</div>

<!-- wp:group {"layout":{"type":"flex",", "spacing":{"blockGap":"20px"}}, "className":"content-center"} -->
    
    <?php
    wp_nav_menu(
        array(
            'menu' => 'footer-menu',
            // do not fall back to first non-empty menu
            'theme_location' => '__no_such_location',
            // do not fall back to wp_page_menu()
            'fallback_cb' => false,
            'menu_class' => 'flex items-center justify-center w-full mt-4 sm:justify-center pt-8 sm:mt-0',
            'container' => 'nav',
        )
    );
    ?>
<!-- /wp:group -->

    <hr class="w-full h-[1px] border-0 bg-zinc-700 my-4"/>

    <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center text-md text-[#FFFFFFB2]">
            © <?php echo date('Y');?> by
            <a href="<?php echo home_url()?>" class="text-[#FFFFFFB2] hover:text-white">
                Stadium.co.
            </a>
            All rights reserved.
        </p>
    <!-- /wp:paragraph -->


    <div class="content-center items-center justify-center w-full mt-8">
    <div class="flex items-center justify-center">

          <div class="flex mt-4 sm:justify-center sm:mt-0">

              <a href="#" class="text-white hover:text-gray-100 dark:hover:text-white p-2 bg-[#3e3e3e] hover:bg-[#4267b3] transition duration-300 rounded-full">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                    </svg>
                  <span class="sr-only">Facebook page</span>
              </a>
              
              
              <a href="#" class="text-white hover:text-gray-100 dark:hover:text-white  bg-[#3e3e3e] hover:bg-[#4267b3] transition duration-300 p-2 ms-5 rounded-full">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                    <path fill="currentColor" d="M13.8 10.5 20.7 2h-3l-5.3 6.5L7.7 2H1l7.8 11-7.3 9h3l5.7-7 5.1 7H22l-8.2-11.5Zm-2.4 3-1.4-2-5.6-7.9h2.3l4.5 6.3 1.4 2 6 8.5h-2.3l-4.9-7Z"/>
                </svg>
                  <span class="sr-only">Twitter page</span>
              </a>

              <a href="#" class="text-white hover:text-gray-100 dark:hover:text-white  bg-[#3e3e3e] hover:bg-[#4267b3] transition duration-300 p-2 ms-5 rounded-full">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                    <path fill-rule="evenodd" d="M19.7 3.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.84c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.84A4.225 4.225 0 0 0 .3 3.038a30.148 30.148 0 0 0-.2 3.206v1.5c.01 1.071.076 2.142.2 3.206.094.712.363 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.15 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965c.124-1.064.19-2.135.2-3.206V6.243a30.672 30.672 0 0 0-.202-3.206ZM8.008 9.59V3.97l5.4 2.819-5.4 2.8Z" clip-rule="evenodd"></path>
                </svg>
                  <span class="sr-only">YouTube page</span>
              </a>

              <a href="#" class="text-white hover:text-gray-100 dark:hover:text-white  bg-[#3e3e3e] hover:bg-[#4267b3] transition duration-300 p-2 ms-5 rounded-full">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                    <path d="M5.69998 1.83398H11.3C13.4333 1.83398 15.1666 3.56732 15.1666 5.70065V11.3007C15.1666 12.3262 14.7593 13.3097 14.0341 14.0348C13.309 14.7599 12.3255 15.1673 11.3 15.1673H5.69998C3.56665 15.1673 1.83331 13.434 1.83331 11.3007V5.70065C1.83331 4.67515 2.24069 3.69165 2.96583 2.9665C3.69097 2.24136 4.67448 1.83398 5.69998 1.83398ZM5.56665 3.16732C4.93013 3.16732 4.31968 3.42017 3.86959 3.87026C3.4195 4.32035 3.16665 4.9308 3.16665 5.56732V11.434C3.16665 12.7606 4.23998 13.834 5.56665 13.834H11.4333C12.0698 13.834 12.6803 13.5811 13.1304 13.131C13.5805 12.681 13.8333 12.0705 13.8333 11.434V5.56732C13.8333 4.24065 12.76 3.16732 11.4333 3.16732H5.56665ZM12 4.16732C12.221 4.16732 12.433 4.25512 12.5892 4.4114C12.7455 4.56768 12.8333 4.77964 12.8333 5.00065C12.8333 5.22166 12.7455 5.43363 12.5892 5.58991C12.433 5.74619 12.221 5.83398 12 5.83398C11.779 5.83398 11.567 5.74619 11.4107 5.58991C11.2544 5.43363 11.1666 5.22166 11.1666 5.00065C11.1666 4.77964 11.2544 4.56768 11.4107 4.4114C11.567 4.25512 11.779 4.16732 12 4.16732ZM8.49998 5.16732C9.38403 5.16732 10.2319 5.51851 10.857 6.14363C11.4821 6.76875 11.8333 7.6166 11.8333 8.50065C11.8333 9.38471 11.4821 10.2326 10.857 10.8577C10.2319 11.4828 9.38403 11.834 8.49998 11.834C7.61592 11.834 6.76808 11.4828 6.14296 10.8577C5.51784 10.2326 5.16665 9.38471 5.16665 8.50065C5.16665 7.6166 5.51784 6.76875 6.14296 6.14363C6.76808 5.51851 7.61592 5.16732 8.49998 5.16732ZM8.49998 6.50065C7.96955 6.50065 7.46084 6.71136 7.08577 7.08644C6.71069 7.46151 6.49998 7.97022 6.49998 8.50065C6.49998 9.03108 6.71069 9.53979 7.08577 9.91486C7.46084 10.2899 7.96955 10.5007 8.49998 10.5007C9.03041 10.5007 9.53912 10.2899 9.91419 9.91486C10.2893 9.53979 10.5 9.03108 10.5 8.50065C10.5 7.97022 10.2893 7.46151 9.91419 7.08644C9.53912 6.71136 9.03041 6.50065 8.49998 6.50065Z" fill="white"/>
                </svg>
                  <span class="sr-only">Instagram page</span>
              </a>
              
          </div>

    </div>