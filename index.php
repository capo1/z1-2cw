<html lang="<?= get_locale(); ?>">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <?php wp_head(); ?>
</head>

<body>
  <section class="main-container">
    <div class="component-container">
      <h2 class="h2 text-center"><?= __("Monuments in Italy", 'z1'); ?></h2>

      <div id="app" data-url="/wp-json/zadanie/v1/search/" data-placeholder="<?= __('Please type the monument name', 'z1'); ?>">
        <noscript><?= __('You must have Javascript enabled to work for this site', 'z1'); ?></noscript>
      </div>
    </div>
  </section>

  <footer>
    <?php wp_footer(); ?>
  </footer>

</body>

</html>