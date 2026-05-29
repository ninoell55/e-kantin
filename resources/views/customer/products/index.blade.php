<center>
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">
         daftar produk
    </h1>
    <div class="grid gap-4">
        @foreach ($products as $product)
        <div class="bg-white rounded-xl shadow p-4">
            <h2 class="text-lg font-bold">
                {{ $product->name }}
            </h2>
            <p>
                Rp {{ number_format($product->price) }}
            </p>
            <form action="{{ route('customer2.cart.add',$product->id) }}" 
            method="POST" class="mt-3">
            @csrf
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">
                tambah ke cart
            </button>
            </form>
        </div>
        @endforeach
    </div>
</div>
</center>