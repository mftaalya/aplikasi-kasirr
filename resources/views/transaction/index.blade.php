@extends('layouts.app')

@section('content')
<div class="container">

    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row justify-content-center bg-white ">
        <div class="col-md-4 p-4">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <select name="name" id="name" class="form-control">
                    <option value="" active>Pilih Produk</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}"> {{$product->name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="total_products">Jumlah</label>
                <input type="number" name="qty_products" id="qty_products" class="form-control" required>
            </div>
            <button class="btn btn-block btn-primary" id="show-product">Tambah Produk</button>
        </div>
        <div class="col-md-8 p-4">
            <h5>List Produk</h5>
            <form action="{{ route('transaction.store') }}" method="post" class="mt-4">
                @csrf
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Total Produk</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody id="list-product">
                        <tr id="null">
                            <td colspan="3">Data tidak ditemukan!</td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <label for="total payment">Total Pembayaran</label>
                    <input type="number" name="total_payment" id="total_payment" class="form-control w-25" >
                </div>
                <div class="form-group">
                    <label for="payment">Bayar</label>
                    <input type="number" name="payment" id="payment" class="form-control w-25" required>
                </div>
                <div class="form-group">
                    <label for="change">Kembalian</label>
                    <p id="label-change">Rp. </p>
                    <input type="hidden" name="change" id="change" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center bg-white py-5">
        <div class="col-md-12">
        <h5>List Transaksi</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Total Harga</th>
                        <th>Bayar</th>
                        <th>Kembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>
                            <ul>
                                @foreach($transaction->product as $item)
                                <li>{{ $item->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $transaction->total_price }}</td>
                        <td>{{ $transaction->pay }}</td>
                        <td>{{ $transaction->change }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- JQuery -->
    <script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous">
    </script>

    <!-- Add Product to List -->
    <script>
        $('#show-product').on('click', function(e){
            var product_id= $('#name').val();
            var total_products = $('#qty_products').val();
            $('#null').empty();
            $('select').find('option:selected').remove(); 
            $.get('/list-product?id='+product_id, function(data){
                
                $.each(data, function(index, productObj){
                    var html="<tr>";
                        html+=  "<td width='30%'>";
                        html+=  "<h5>"+productObj.name+"</h5>";
                        html+=  "<p> Rp. "+productObj.price+"</p>";
                        html+=  "</td>";
                        html+=  "<td width='20%'>";
                        html+=  "<input type='number' name='total_products[]' id='total_products"+product_id+"' class='form-control' value='"+total_products+"'>";
                        html+=  "</td>";
                        html+=  "<td width='20%'>";
                        html+=  "<p id='label_total_prices"+product_id+"'>"+productObj.price * total_products+"</p>";
                        html+=  "<input type='hidden' name='total_prices[]' id='total_prices"+product_id+"' class='form-control amount' value='"+productObj.price * total_products+"' >";
                        html+=  "<input type='hidden' name='product_id[]' value='"+product_id+"'>";
                        html+=  "</td>";
                        html+=  "</tr>";

                    // display html value on #list-product
                    $('#list-product').append(html);

                    // display total payment
                    var total = 0;

                    $('.amount').each(function() {
                        total += parseInt($(this).val(),10);
                    });
                    $('#total_payment').val(total);

                    //when #total_products"+product_id keyup run function 
                    $("#total_products"+product_id).on('input',function(){
                        var a = $("#total_products"+product_id).val();
                        var b = productObj.price;
                        var c = a*b; 

                        //display total price per item 
                        $("#total_prices"+product_id).val(c);
                        $("#label_total_prices"+product_id).html(c);

                        //display total price all item
                        var total = 0;

                        $('.amount').each(function() {
                            total += parseInt($(this).val(),10);
                        });
                        $('#total_payment').val(total);
                    })
                    
                    //display change
                    $('#payment').on('input',function(){
                        var payment = $('#payment').val();
                        var change = payment-total;
                        $('#label-change').html("Rp." +change);
                        $('#change').val(change);
                    });

                })
            });
        });

        
    </script>


@endsection
