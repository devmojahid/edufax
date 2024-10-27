<?php

use \Etn\Utils\Helper;

defined( 'ABSPATH' ) || exit;

$event_options  = get_option("etn_event_options");
$data           = Helper::single_template_options( $single_event_id );

$poorex_event_button_text = get_theme_mod( 'poorex_event_button_text', __( 'Make an Appointment', 'poorex' ) );
$poorex_event_button_url = get_theme_mod( 'poorex_event_button_url', __( '#', 'poorex' ) );


?>

    <div class="tp-event-details__right-box">
       
        <div class="tp-event-details__author-info mb-30 grey-bg d-flex align-items-center">
            <?php 
                $etn_event_schedule = get_post_meta( $single_event_id, 'etn_event_schedule', true);
                if ($etn_event_schedule != '') :  
                    $etn_schedule_topics = get_post_meta($etn_event_schedule[0], 'etn_schedule_topics', true);
                    $etn_schedule_speakers_ids = $etn_schedule_topics[0]['etn_shedule_speaker'];

                foreach($etn_schedule_speakers_ids as $speaker): 
                    $speaker_name = get_post_meta($speaker, 'etn_speaker_title', true);
                    $etn_speaker_designation = get_post_meta($speaker, 'etn_speaker_designation', true);
                    $speaker_avatar = get_the_post_thumbnail_url( $speaker, 'thumbnail' );
                    $speaker_url = get_the_permalink($speaker); 
            ?>
            <div class="tp-event-details__author-thumb">
            <img src="<?php echo esc_url($speaker_avatar); ?>" alt="<?php echo esc_attr($speaker_name); ?>">
            </div>
            <div class="tp-event-details__author-text">
                <a href="<?php echo esc_url($speaker_url); ?>"><h5><?php echo esc_html($speaker_name); ?></h5></a>
                <?php if(!empty($etn_speaker_designation)) : ?>
                <span><?php echo esc_html($etn_speaker_designation); ?></span>
                <?php endif; ?>
            </div>
            <?php endforeach; endif; ?>
        </div>

       

        <div class="tp-event-details__contact-box mb-30">
            <ul>
                <li>
                    <div class="tp-event-details__contact-item d-flex align-items-start">
                        <div class="tp-event-details__contact-icon">
                            <span><i class="flaticon-time"></i></span>
                        </div>
                        <div class="tp-event-details__contact-text">
                            <span><?php echo esc_html__('Event Time:', 'poorex'); ?></span>
                            <b><?php echo esc_html($data['event_start_time'] . esc_html__(" to ","poorex") . $data['event_end_time']); ?></b>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="tp-event-details__contact-item d-flex align-items-start">
                        <div class="tp-event-details__contact-icon">
                            <span><i class="flaticon-calendar"></i></span>
                        </div>
                        <div class="tp-event-details__contact-text">
                            <span><?php echo esc_html__('Date:', 'poorex'); ?></span>
                            <b><?php echo esc_html($data['event_start_date']); ?></b>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="tp-event-details__contact-item d-flex align-items-start">
                        <div class="tp-event-details__contact-icon">
                            <span><i class="flaticon-folder"></i></span>
                        </div>
                        <div class="tp-event-details__contact-text">
                            <span><?php echo esc_html__('Catagory:', 'poorex'); ?></span>
                            <b><?php echo poorex_kses($data['category']); ?></b>
                        </div>
                    </div>
                </li>
                <?php
                        if( !class_exists('Wpeventin_Pro') || get_post_meta($single_event_id, 'etn_event_location_type', true) != 'new_location' ) :
                                if ( !isset($event_options["etn_hide_location_from_details"]) && !empty($data['etn_event_location'])) ;
                    ?>
                <li>
                    <div class="tp-event-details__contact-item d-flex align-items-start">
                        <div class="tp-event-details__contact-icon">
                            <span><i class="flaticon-location"></i></span>
                        </div>
                        <div class="tp-event-details__contact-text">
                            <span><?php echo esc_html__('Location: ', 'poorex'); ?> </span>
                            <a href="#"><b><?php echo esc_html($data['etn_event_location']);  ?></b></a>                                                
                        </div>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <?php if(!empty($poorex_event_button_url)) : ?>
        <div class="event__widget">
            <div class="event__details-btn">
                <a href="<?php echo esc_url($poorex_event_button_url); ?>" class="tp-btn w-100"><?php echo esc_html($poorex_event_button_text); ?></a>
            </div>
        </div>
        <?php endif; ?>

        <?php do_action("etn_after_single_event_meta", $single_event_id); ?>
    </div> <!-- end wrapper -->