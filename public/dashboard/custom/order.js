$(document).ready(function () {

    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'), 2);
        var image = $(this).data('image');

        $(this).removeClass('btn-success').addClass('btn-default disabled');
        // <input type="hidden" name="product_ids[]" value="${id}">

        var html = `<tr>
        <td>${name}</td>
        <td><img style="height:50px;width: 50px;" src="${image}"></td>
        <td><input type="number" name="products[${id}][quantity]" data-price="${price}" min="1" value="1" class="form-control input-sm product-quantity"></td>
        <td class="price">${price}</td>
        <td><a class="btn btn-danger btn-sm delete_product" data-id="${id}"><i class="fa fa-trash"></i></a></td>
        </tr>`;
        $('.order-list').append(html);
        calculate_total();
    });

    $('body').on('click', '.disabled', function () {
        // alert('this is disabled');
    });

    $('body').on('click', '.delete_product', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest("tr").remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');
        calculate_total();
    });

    $('body').on('change', '.product-quantity', function (e) {

        // var quantity =  Number($(this).val());
        // var product_price = $(this).data('price')
        //  Number($(this).closest('tr').children('.price').html( quantity * product_price));
        // calculate_total();

        var quantity = $(this).val();
        var unit_price = parseFloat($(this).data('price'));
        Number($(this).closest('tr').find('.price').html($.number(quantity * unit_price, 2)));
        calculate_total();
    });

    $('.order-products').on('click', function (e) {
        e.preventDefault();
        $('#loading').css('display' , 'flex');

        var url = $(this).data('url');
        var method = $(this).data('method');

        $.ajax({
            url: url,
            method:method,
            success:function (data) {
                $('#loading').css('display' , 'none');
                $('.table_hide').hide();
                $('#order-product-list').empty();
                $('#order-product-list').append(data);
            }
        })
    });

    $(document).on('click','.print-btn',function () {
        $('#print-area').printThis();
    })

});//end of document

function calculate_total() {
    var price = 0;
    $('.order-list .price').each(function (index) {
        // price += Number($(this).html());
        price += parseFloat($(this).html().replace(/,/g, ''));
    });
    if (price > 0) {
        $('#add_order_btn').removeClass('disabled')
    } else {
        $('#add_order_btn').addClass('disabled')
    }
    $('.total-price').html($.number(price, 2));
}

