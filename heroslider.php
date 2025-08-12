<?php
// hero-slider.php

// 1) Determine the “page slug” dynamically
$pageSlug = basename($_SERVER['PHP_SELF'], '.php');

if ($pageSlug === 'category' && isset($_GET['type'], $_GET['cat_id'])) {
    $pageSlug = 'category-' . $_GET['type'] . '-' . (int)$_GET['cat_id'];
}

// 2) Fetch active slides for this slug
$stmt = $pdo->prepare("
  SELECT * 
    FROM sliders 
   WHERE page = ? 
     AND active = 1 
   ORDER BY display_order
");
$stmt->execute([$pageSlug]);
$slides = $stmt->fetchAll();

// 3) If no slides, bail out
if (empty($slides)) {
    return;
}

// 4) Otherwise render the HTML
?>
<!-- Owl Carousel CSS (load on pages that include this file) -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
/>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
/>

<div id="hero-slider" class="owl-carousel owl-theme mb-5">
  <?php foreach ($slides as $s): 
    $bg   = "background-image:url('".htmlspecialchars($s['image'])."')";
    $open = $s['link'] ? '<a href="'.htmlspecialchars($s['link']).'">' : '';
    $close= $s['link'] ? '</a>' : '';
  ?>
    <div class="slide-item" style="<?= $bg ?>">
      <?= $open ?>
      <?php if ($s['caption']): ?>
        <div class="slider-caption text-white text-center w-100">
          <h3 class="fw-bold display-4"><?= htmlspecialchars($s['caption']) ?></h3>
        </div>
      <?php endif; ?>
      <?= $close ?>
    </div>
  <?php endforeach; ?>
</div>

<!-- jQuery & Owl Carousel JS -->
<script 
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script 
  src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<script>
// your carousel.js initialization
$(document).ready(function(){
  $('#hero-slider').owlCarousel({
    loop: true,
        items: 1,
        dots: false,
        autoplay: true,
        smartSpeed: 1600
  });
});
</script>
