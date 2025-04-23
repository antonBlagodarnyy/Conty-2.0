<div class="container">
    @if(count($products)>0)
    <table class="table-auto border-collapse border border-gray-300">
        <thead>
            <th class="p-2">Nombre</th>
            <th class="p-2">Gramos</th>
            <th class="p-2">Coste</th>
        </thead>
        <tbody>

            @foreach ($products as $product)
            <tr>
                <td class="p-2 border border-gray-200">{{$product->name}}</td>
                <td class="p-2 border border-gray-200">{{$product->pivot->quantity}}g</td>
                @php
                $cost = ( $product->price / $product->net_content ) * $product->pivot->quantity;
                @endphp
                <td class="p-2 border border-gray-200">{{ number_format($cost,2) }}€</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>