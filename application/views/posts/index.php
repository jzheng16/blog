<main class="main">


  <a id="create-post-link" href="<?php echo site_url('posts/create') ?>"> Create Post </a>


  <section class='posts'>
    <?php foreach ($posts as $post) : ?> <section class="post">
        <h2 class="post-title"> <?= $post['title']; ?> </h2>
        <p class="post-description"> <?= $post['description']; ?> </p>
      </section>
    <?php endforeach; ?>
    <?= $links ?>
  </section>

</main>