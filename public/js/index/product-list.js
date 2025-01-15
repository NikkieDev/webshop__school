const categoryWrapper = document.querySelector('.categories-wrapper');
const categories = document.querySelectorAll('.category');
const productsListWrapper = document.querySelector('.category--items-wrapper');


function setProducts(products) {
  productsListWrapper.innerHTML = null;
  products.forEach(product => {
    const productWrapper = document.createElement('div');

    productWrapper.classList.add('product--item-wrapper');
    productWrapper.innerHTML = `<div class='product-item'>
    <p class="product--item-title">${product.product_name}</p>
    <span class="product--item-price">&euro;${product.product_price}</span>
    <button class='product--item-add__to__cart' onclick='addToCart(${product.product_id})'>Add to cart</button>
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
  return responseBody.body;
}

document.addEventListener('DOMContentLoaded', async () => {
  try {
    const products = await fetchProducts('Tech');
    setProducts(products);
  } catch (error) {
    productsListWrapper.textContent = error.message;
  }
});

categoryWrapper.addEventListener('category-select', async e => {
  console.log(e);
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
  })
})