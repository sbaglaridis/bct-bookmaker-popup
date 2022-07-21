<?php

global $_bet;

$bookmaker_id_for_popup = (int)$_bet['popup_bookmaker_id'];

if (empty($bookmaker_id_for_popup)) {
    return '';
}

$popup_img_type = (int)$_bet['popup_img_type'];
$book = new ACFFields($bookmaker_id_for_popup, 'book_');
$bg_color = $book->bg_color ?: '#000';
$aff_link = $book->affiliate_url ?: '';
$popup_link = !empty(get_field('popup_link', $bookmaker_id_for_popup)) ? get_field('popup_link', $bookmaker_id_for_popup) : $aff_link;
$popup_bullets = !empty(get_field('popup_bullets', $bookmaker_id_for_popup)) ? get_field('popup_bullets', $bookmaker_id_for_popup) : '';
$popup_bullets = explode('|', $popup_bullets);
$img_src = ($popup_img_type == 2) ? '/casino-bg-popup.jpg' : '/soccer-player.jpg';
$img_alt = ($popup_img_type == 2) ? 'casino bg popup' : 'soccer player';

?>

<div id="popup-modal" class="popup-modal">
    <div class="popup-modal-content"
         style="background:linear-gradient(to bottom,
         <?php echo get_field('popup_grandient_color_start', $bookmaker_id_for_popup); ?> 0%,
         <?php echo get_field('popup_grandient_color_end', $bookmaker_id_for_popup); ?> 100%)">
        <div class="popup-modal-content__container">
            <div class="popup-modal-content__left">
                <img width="500" height="500" src="<?php echo BCT_BOOKMAKERS_IMAGES . $img_src ?>"
                     alt="<?php echo $img_alt; ?>" loading="lazy" />
            </div>
            <div class="popup-modal-content__right">
                <span class="close-modal"><i class="icon-close"></i></span>
                <img style="background-color: <?php echo $bg_color; ?>" width="94" height="94"
                     src="<?php echo get_the_post_thumbnail_url($bookmaker_id_for_popup, 'thumbnail'); ?>"
                     alt="<?php echo $book->nice_name; ?> Logo" class="popup-modal-content__bookmaker-img"
                     loading="lazy" />
                <?php if (!empty($popup_bullets)) : ?>
                    <ul>
                        <?php foreach ($popup_bullets as $bullet) : ?>
                            <li style="color:<?php echo $book->popup_color_text; ?>"><?php echo trim($bullet); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <a href="<?php echo $popup_link; ?>" rel="nofollow" target="_blank">
                    <div class="popup-modal-content__cta">ΕΓΓΡΑΦΗ</div>
                </a>
                <div class="compliance_asterisk"
                     style="color:<?php echo $book->popup_color_text; ?>">
                    <?php echo Helpers::undoLegalDisclaimersSafariMobileLinks($book->legal_disclaimer); ?>
                </div>
            </div>
        </div>
    </div>
</div>

