<?php 
    $eventMetaData = getVipEventMetadata($args['event']->ID);
?>
<div>
    <h3><a href="<?php echo $args['event']->guid;?>"><?php echo $args['event']->post_title;?></a></h3>
    <div>
        <dd>
            <?php _e('Event Date Start:', 'hello-elementor') ?>
            <?php echo $eventMetaData['date_start'][0]; ?>
        </dd>
        <dd>
            <?php _e('Event Date Stop:', 'hello-elementor') ?>
            <?php echo $eventMetaData['date_stop'][0]; ?>
        </dd>
        <dd>
            <?php _e('Event Confirmed:', 'hello-elementor') ?>
            <?php echo ($eventMetaData['date_confirmed'][0] ==1)?'Yes':'No'; ?>
        </dd>
        <dd>
            <?php _e('Event Status:', 'hello-elementor') ?>
            <?php echo $eventMetaData['event_status'][0]; ?>
        </dd>
        <dd>
            <?php _e('Venue Name:', 'hello-elementor') ?>
            <?php echo $eventMetaData['venue_name'][0]; ?>
        </dd>
        <dd>
            <?php //_e('Host Team:', 'hello-elementor') ?>
            <?php echo $eventMetaData['hometeam_name'][0]; ?>
         <strong>VS</strong>
            <?php //_e('Visit Team:', 'hello-elementor') ?>
            <?php echo $eventMetaData['visiting_name'][0]; ?>
        </dd>
        <dd>
            <?php _e('City:', 'hello-elementor') ?>
            <?php echo $eventMetaData['city'][0]; ?>
        </dd>

        <pre>
            <?php //print_r($eventMetaData);?>
        </pre>
    </div>
</div>


<?php
/*
(
    [ID] => 6444
    [post_author] => 1
    [post_date] => 2023-12-22 21:04:56
    [post_date_gmt] => 2023-12-22 21:04:56
    [post_content] => 
    [post_title] => West Brom vs Preston
    [post_excerpt] => 
    [post_status] => publish
    [comment_status] => closed
    [ping_status] => closed
    [post_password] => 
    [post_name] => west-brom-vs-preston
    [to_ping] => 
    [pinged] => 
    [post_modified] => 2023-12-22 21:04:56
    [post_modified_gmt] => 2023-12-22 21:04:56
    [post_content_filtered] => 
    [post_parent] => 0
    [guid] => https://vipfootballtickets.co.uk/xs2_event/west-brom-vs-preston/
    [menu_order] => 0
    [post_type] => xs2_event
    [post_mime_type] => 
    [comment_count] => 0
    [filter] => raw
)
*/