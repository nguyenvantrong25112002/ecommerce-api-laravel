<form id="add_attr_size_products" action="{{ route('admin.product.productAttributes') }}" method="POST">
    @csrf
    <input value="{{ $product->id_product }}" name="product_id" type="text" class="form-control" id="id_pro">
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Tên sản phẩm:</label>
        <input value="{{ $product->name_product }}" readonly="true" type="text" class="form-control">
    </div>

    <div class="form-group productAttributes">
        @foreach ($productAttributes as $productAttribute)
            <hr>
            <h3>{{ $productAttribute->name }}</h3>
            @foreach ($productAttribute->hasManyAttributeVal as $attributeValue)
                <div class="form-check productAttribute">
                    <input @foreach ($product->in_many_attr as $attrval)
                    {{ $attributeValue->attrval_id == $attrval->attrval_id ? 'checked' : '' }}
                    @endforeach id="{{ $attributeValue->attrval_id }}"
                    value="{{ $attributeValue->attrval_id }}" type="checkbox" class="form-check-input"
                    name="attrval_id[]">
                    @if (strcmp($productAttribute->type, 'color') == 0)
                        <label class="form-check-label attributeValue" for="{{ $attributeValue->attrval_id }}">
                            <span style="background-color:{{ $attributeValue->value }} "></span>
                        </label>
                    @else
                        <label class="form-check-label"
                            for="{{ $attributeValue->attrval_id }}">{{ $attributeValue->value }}</label>
                    @endif
                </div>
            @endforeach
        @endforeach


    </div>
    <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</form>



{{-- @foreach ($product->in_many_attr as $attrval)
    {{ $attributeValue->attrval_id == $attrval->attrval_id ? 'checked' : '' }}
@endforeach --}}
