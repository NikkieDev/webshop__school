<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel='stylesheet' href="css/index.css">
</head>
<body>
  <nav class="nav-wrapper py-2 px-4 flex items-center justify-center">
    <div class="nav--buttons-wrapper flex py-1 px-2 items-center justify-center gap-2 text-sm lg:gap-4 lg:text-base overflow-hidden">
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="index.html">Home</a>
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="products.html">Producten</a>
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="contact.html">Contact</a>
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="about.html">Over ons</a>
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="faq.html">FAQ</a>
    </div>
  </nav>
  <div class="header-wrapper">
    <div class="header--image-wrapper">
      <img src="https:/picsum.photos/1" class="header--image object-fit">
      <p class="header--image__text">Kubyx Webshop</p>
    </div>
  </div>
  <main class="content-wrapper m-2">
    <?php require_once "./partials/product-section.php" ?>

  </main>
</body>
</html>