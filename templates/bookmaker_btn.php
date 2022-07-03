<?php

global $_bet;

$popup_id = (int) $_bet['popup_bookmaker_id'];
$popup    = new ACFFields( $popup_id, 'popup_' );

$gradient_color_start = $popup->grandient_color_start;
$gradient_color_end   = $popup->grandient_color_end;
$label_bg_color       = $popup->label_bg_color;
$label_text_color     = $popup->label_text_color;

$colors = (object) [
	'container_gradient_start' => empty( $gradient_color_start ) ? '#2b80de' : $gradient_color_start,
	'container_gradient_end'   => empty( $gradient_color_end ) ? '#123752' : $gradient_color_end,
	'label_bg_color'           => empty( $label_bg_color ) ? '#ee381d' : $label_bg_color,
	'label_text_color'         => empty( $label_text_color ) ? '#fff' : $label_text_color,
];

$popup_indicator_gradient = "linear-gradient(to right, " . $colors->container_gradient_end . " 0%, " . $colors->container_gradient_start . " 100%";

if ( empty( $popup_id ) ) :
	return '';
endif;

?>

<div class="popup-bookmaker-widget popup-indicator" data-popup="widget">
    <div class="popup-bookmaker-widget__indicator" style="background: <?php echo $popup_indicator_gradient; ?>; color:<?php echo $popup->color_text; ?>">
        <span style="background-color: <?php echo $colors->label_bg_color; ?>; color:<?php echo $colors->label_text_color; ?>;">ΝΕΟ</span>
        <div class="popup-bookmaker-widget__text">
            <?php echo $_bet['popup_text']; ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 512 512" class="popup-bookmaker-widget__icon">
                <path fill="<?php echo $popup->color_text; ?>" d="M158.186 0l-60.372 60.374 195.626 195.626-195.626 195.626 60.372 60.374 256-256z"></path>
            </svg>
        </div>
    </div>
    <i class="popup-bookmaker-widget__close icon-close-slim close-popup"></i>
</div>
