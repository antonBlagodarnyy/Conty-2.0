<div class="container">
    <table class="table-auto border-collapse border border-gray-300">
        @foreach ($products as $product)
        <tr>
            <td class="p-2 border border-gray-200">{{$product->name}}</td>
            <td class="p-2 border border-gray-200">{{$product->pivot->quantity}}g
            </td>
        </tr>
        @endforeach
    </table>
</div>