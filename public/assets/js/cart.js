
const products = document.querySelectorAll('.product');
const sumAmount = document.querySelector('.sum_amount');
let sumProduct = 0;

products.forEach( product => {
    const productQuantity = product.querySelector('.input_quantity');
    const productPrise = product.querySelector('.product_prise');
    sumProduct += Number(productQuantity.value) * Number(productPrise.textContent);

});

sumAmount.textContent = sumProduct + '₽';


const inputQuantity = document.querySelectorAll('.input_quantity');
const edit = document.querySelector('.edit_product');
const tokin = document.querySelector('meta[name=csrf-token').content;
inputQuantity.forEach(element => {
    element.addEventListener('change', function(e){
        let target = e.target;
        const data = {
            "id": target.dataset.id,
            "quantity": target.value
        };
        fetch('/cart/edit', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json;charset=utf-8',
              'X-CSRF-Token': tokin
            },
            body: JSON.stringify(data)
          });
    });
});


 















