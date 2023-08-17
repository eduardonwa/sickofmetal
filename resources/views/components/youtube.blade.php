<?php
    $videoURL = \App\Models\TextWidget::getContent('youtube-sidebar');
    $videoURL = html_entity_decode($videoURL);
    $videoURL = strip_tags($videoURL);
?>

<lite-youtube videoid="<?php echo $videoURL ?>"></lite-youtube>
