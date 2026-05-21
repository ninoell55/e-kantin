
<center>
<div class="p-4">
    <h1 class="text-2x1 font-bold mb-4">
        keranjang
    </h1>
    @php
    $total = 0;
    @endphp
    @forelse($cart as $item)
    @php
    $total += $item['price']*$item['quantity'];
    @endphp
    <div class="bg-white rounded-x1 shadow p-4 mb-3">
        <h2 class="font-bold text-lg">
            {{ $item['name'] }}
        </h2>
        <p>
            harga:
            RP {{ number_format($item['price']) }}
        </p>
        <p>
               <form action="{{ route('customer.cart.add', $item['product_id']) }}"
        method="POST">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">
            +
        </button>
            </form>
            Quantity:
            {{ $item['quantity'] }}
              <form action="{{ route('customer.cart.decrease', $item['product_id']) }}"
        method="POST">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">
            -
        </button>
</form>
            
        </p>
        <p class="font-bold mt-2">
            subtotal:
            RP {{ number_format($item['price']*$item['quantity']) }}
        </p>
    </div>


    @empty
    <div class="bg-white rounded-xl shadow p-4">

    <p>
        keranjang kosong
    </p>
    </div>
    @endforelse
    <h2 class="text-xl font-bold mt-4">
        Total:
        RP {{ number_format($total) }}
    </h2>

    <a href="{{ route('customer.checkout.index') }}">
        check out
    </a>
</div>
</center>