<x-layout>
  <div class="filter--section container">
    <!-- this filter section filters the list of products by using js to check the tag if the value of the tag on the button data attribute matches the value of the category on the product attribute  -->
    <!-- you can do a for loop for all the categories and paste the category name in the data-tag attribute for filtering  -->
    <div class="filter--wrapper">
      <button class="filter--button" data-tag="all" aria-current="true">All</button>
      <button class="filter--button" data-tag="shirt">Shirts</button>
      <button class="filter--button" data-tag="shorts">Shorts</button>
      <button class="filter--button" data-tag="senator">Senators</button>
    </div>
  </div>
  <section class="product--section container product-page">
    <h2 class="product--page-header">
      All (8 Products)
    </h2>
    <div class="product--container">
      <!-- paste category of the product here in the data-category for the filtering to work  -->
      <a href="./product.html" data-category="shirt" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8337-6680861cdabff.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>

      <a href="./product.html" data-category="senator" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8336-6680861d35809.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>


      <a href="./product.html" data-category="shorts" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8338-668086222d99d.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>

      <a href="./product.html" data-category="senator" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8339-6680862dce627.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>
    </div>
  </section>
</x-layout>