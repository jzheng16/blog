<?php echo validation_errors(); ?>

<?php
# form_open provided by codeigniter has extra functionality ? read: https://www.codeigniter.com/user_guide/tutorial/create_news_items.html
$options = [
  'id' => 'create-post-form'
];

echo form_open('posts/create', $options); ?>

<h2> Create your own post </h2>
<input name="title" type="text" id="title" placeholder="Enter Title" />
<textarea name="description" id="description" placeholder="Your post..."></textarea>
<section class="category-section">
  <p> Add Categories </p>
  <div class="added-categories">

  </div>
  <?php foreach ($categories as $category) : ?>
    <button class="category-button" data-id=<?= $category['id'] ?>>
      <i class="fas fa-plus"></i>
      <?= $category['description'] ?>
    </button>
  <? endforeach; ?>
</section>
<input id="create-post-button" name="submit" value="Post" type="submit">

</form>