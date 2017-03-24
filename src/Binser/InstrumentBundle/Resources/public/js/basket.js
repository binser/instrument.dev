// функции для добавления в корзину
function changeProductPrice($product, count) {
    var $priceBlock = $product.find('.product_price'),
        productPrice = parseInt($product.find('.one_product_price').val()),
        newProductPrice = count * productPrice;

    $priceBlock.text(newProductPrice);
}

function changeCountProduct($button) {
    var increment = $button.hasClass('increment'),
        decrement = !increment,

        $product = $button.closest('.product'),
        $countBlock = $product.find('.product_count_to_add'),
        productCount = parseInt($countBlock.text());

    increment && (productCount += 1);
    decrement && (productCount -= 1);
    $countBlock.text(productCount);

    switch (productCount) {
        case 100:
            increment && $button.addClass('inactive');
            break;
        case 2:
            increment && $product.find('.decrement').removeClass('inactive');
            break;
        case 1:
            decrement && $button.addClass('inactive');
            break;
        case 99:
            decrement && $product.find('.increment').removeClass('inactive');
            break;
    }

    return productCount;
}

function changeProductInfo() {
    var $button = $(this),
        $product = $(this).closest('.product'),
        count = changeCountProduct($button);

    changeProductPrice($product, count);
}

function saveBasketProducts(data) {
    localStorage.setItem('basket_products', JSON.stringify(data));
}

function getBasketProducts() {
    return JSON.parse(localStorage.getItem('basket_products'));
}

function saveBasketSum(sum) {
    localStorage.setItem('basket_sum', sum);
}

function getBasketSum() {
    localStorage.getItem('basket_sum');
}


// функции для отображения корзины
function showProductsInBasket(produsts, $container) {
    var $productsTable = $('<table></table>').addClass('table').addClass('table-striped');
    $.each(produsts, function(product) {
        var productTitle = product[0],
            productPrice = product[1],
            countProducts = product[2],
            $row = $('<tr></tr>'),
            $titleColumn = $('<th></th>').text(productTitle),
            $priceColumn = $('<tr></tr>').text(productPrice + 'руб.'),
            $countColumn = $('<tr></tr>').html('<span class="decrement">-</span>&nbsp;<span class="product_count_to_add">' + countProducts + '</span>&nbsp;<span class="increment">+</span>'),
            $summColumn = $('<tr></tr>').text((productPrice * countProducts) + 'руб.');
        $row.append($titleColumn)
            .append($priceColumn)
            .append($countColumn)
            .append($summColumn)
            .appendTo($productsTable);
    });

    $container.append($productsTable);
}



$(document).ready(function() {
    var products = getBasketProducts(),
        $productsConrainer = $('#products_block'),
        sum = getBasketSum();

    showProductsInBasket(products, $productsConrainer);
});