<center>
    <div>
    <h1>
        Checkout
    </h1>

    @foreach ($cart as $item)
    <div>
        <h2>
            {{ $item['name'] }}
        </h2>
        <p>
            Qty:
            {{ $item['quantity'] }}
        </p>
        <p>
            Rp {{ number_format($item['price']) }}
        </p>
        <p>
            Subtotal:
            Rp {{ number_format($item['price']*$item['quantity']) }}
        </p>
    </div>
    @endforeach

    <div>
        <h2>
            Total:
            Rp{{ number_format($total) }}
        </h2>
    </div>


    <form action="{{ route('customer2.checkout.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="">
                Metode pembayaran
            </label>
            <select name="payment_method" id="">
                <option value="cash">
                    Tunai
                </option>
                <option value="transfer">
                    transfer
                </option>
            </select>
        </div>
        
        <div>
            <label for="">Catatan pesanan</label>
            <textarea name="notes" id=""></textarea>
        </div>

        <label for="">tipe pesanan</label>
        <select name="order_type" id="">
            <option value="pickup">ambil sendiri</option>
            <option value="delivery">delivery</option>
        </select>
        <label for="">lokasi delivery</label>
        <input type="text" name="delivery_location" id="" placeholder="contoh: XI RPL 2">
        
        <button type="submit">
            Buat pesanan
        </button>
    </form>
</div>
</center>