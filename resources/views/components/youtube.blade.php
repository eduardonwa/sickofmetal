<?php
    $videoURL = \App\Models\TextWidget::getContent('youtube-sidebar');
    $videoURL = html_entity_decode($videoURL);
    $videoURL = strip_tags($videoURL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <iframe 
        class="w-full aspect-video" 
        src="https://www.youtube.com/embed/<?php echo $videoURL?>"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen>
    </iframe>
</body>
</html>