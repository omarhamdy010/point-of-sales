$(document).ready(function () {

    $('.add-product-btn').on('click',function (e) {
        e.preventDefault();
        var name= $(this).data('name');
        var id= $(this).data('id');
        var price= $(this).data('price');

        $(this).removeClass('btn-success').addClass('btn-default disabled');

        var html =`
        <tr>
        <td>${name}</td>
        <td><input type="number" name="quantities[]" data-price="${price}" min="1" value="1" class="form-control input-sm product-quantity"></td>
        <td class="price">${price}</td>
        <td><a class="btn btn-danger btn-sm delete_product" data-id="${id}"><i class="fa fa-trash"></i></a></td>
        </tr>`;
        $('.order-list').append(html);
        calculate_total();
    });
    $('body').on('click','.disabled',function () {
        // alert('this is disabled');
    });

    $('body').on('click','.delete_product',function (e) {
        e.preventDefault();
        var id= $(this).data('id');

        $(this).closest("tr").remove();
        $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
        calculate_total();
    });
    $('body').on('change','.product-quantity',function (e) {

        // var quantity =  parseInt($(this).val());
        // var product_price = $(this).data('price')
        //  parseInt($(this).closest('tr').children('.price').html( quantity * product_price));
        // calculate_total();

        var quantity = $(this).val();
        var price = parseInt($(this).data('price'));
        parseInt($(this).closest('tr').find('.price').html(quantity * price));
        calculate_total();
    });

});//end of document

function calculate_total() {
var price = 0 ;
    $('.order-list .price').each(function (index) {
        price += parseInt($(this).html());
    });
    $('.total-price').html(price);
}

