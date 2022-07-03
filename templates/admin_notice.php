<?php

/**
 * @var array $bct_bookmaker_popup_errors
 */

?>

<div class="notice notice-warning is-dismissible">
    <div><strong><?php echo BCT_BOOKMAKERS_NAME; ?></strong> has detected several issues that require your attention:</div>
    <?php foreach ($bct_bookmaker_popup_errors as $error) : ?>
        <div>» <?php echo $error; ?></div>
    <?php endforeach; ?>
</div>
