const categoryWrapper = document.querySelector('.categories-wrapper');
const categories = document.querySelectorAll('.category');
const productsListWrapper = document.querySelector('.category--items-wrapper');


function setProducts(products) {
  productsListWrapper.innerHTML = null;
  products.forEach(product => {
    const productWrapper = document.createElement('div');
    productWrapper.classList.add('product--item-wrapper');

    productWrapper.innerHTML = `<div class='product-item'>
      <img class="product--item-image" src="/cdn/${product.image_name}" />
      <div class="product--item-cta-wrapper">
        <p class="product--item-title">${product.product_name}</p>
        <div class="product--item-cta">
          <span class="product--item-price">&nbsp;&euro;${product.product_price}</span>
          <button class='product--item-button product--item-add__to__cart' onclick="addToCart('${product.product_uuid}')">Add to cart</button>
          <a class="product--item-button" href="product-detail.php?uuid=${product.product_uuid}">Info</a>
        </div>
      </div>
    </div`;

    productsListWrapper.appendChild(productWrapper);
  });
}

async function fetchProducts(category) {
  const response = await fetch(`/api/get-products.php?cat=${category}`, { method: 'GET' });

  if (response.status !== 200) {
    throw new Error(`No '${category}' products found`);
  }

  const responseBody = await response.json();

  if (responseBody.body.length <= 0) {
    throw new Error(`No '${category}' products found`)
  }

  return responseBody.body;
}

document.addEventListener('DOMContentLoaded', async () => {
  try {
    const products = await fetchProducts(localStorage.getItem('category') || 'Tech');
    setProducts(products);
  } catch (error) {
    productsListWrapper.textContent = error.message;
  }
});

categoryWrapper.addEventListener('category-select', async e => {
  localStorage.setItem('category', e.detail);

  try {
    const products = await fetchProducts(localStorage.getItem('category'));;
    setProducts(products);
  } catch (error) {
    productsListWrapper.textContent = error.message;
  }
});

categories.forEach(categoryEl => {
  categoryEl.addEventListener('click', e => {
    const newEvent = new CustomEvent("category-select", { detail: e.target.getAttribute('data-name') });
    categoryWrapper.dispatchEvent(newEvent);
  });
});