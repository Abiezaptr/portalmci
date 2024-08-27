<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Report | MCI Online Repository</title>
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets') ?>/images/favicon.png">
    <style>
        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>

<body>
    <iframe src="<?php echo base_url('uploads/report/' . $file_name); ?>" allow="autoplay"></iframe>
</body>

</html>