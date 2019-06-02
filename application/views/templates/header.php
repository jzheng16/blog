<html>

<head>
  <link rel="stylesheet" href="<?= base_url() . 'assets/css/posts.css' ?>">
  <?php if (isset($css)) : ?>
    <?php foreach ($css as $path) : ?>
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/' . $path . '.css' ?>">
    <?php endforeach; ?>
  <? endif; ?>
  <title> <?= $title ?> </title>
</head>

<body>