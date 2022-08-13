@extends('base')

@section('content')
<form id=sectorForm" method="POST" action="{{route('submit-sector')}}">
    @csrf
    <div class="mb-3">
        <h3>Submitted sectors:</h3>
        <p>Sectors:
            @foreach($sectors as $sector)
                {{$sector->name}} (id: {{$sector->id}}).
            @endforeach
        </p>
        <p>Industries:
            @foreach($industries as $industry)
                {{$industry->name}} (id: {{$industry->id}}).
            @endforeach
        </p>
        <p>Products:
            @foreach($products as $product)
                {{$product->name}} (id: {{$product->id}}).
            @endforeach
        </p>
        <p>Product types:
            @foreach($productTypes as $productType)
                {{$productType->name}} (id: {{$productType->id}}).
            @endforeach
        </p>
    </div>
    <h3>Enter new sector:</h3>
    <div class="mb-3">
        <label for="table" class="form-label">Table</label>
        <select id="table" name="table" class="form-select @error('table') is-invalid @enderror">
            <option value="industry" @if (old('table') == 'industry') selected="selected" @endif>Industry</option>
            <option value="product" @if (old('table') == 'product') selected="selected" @endif>Product</option>
            <option value="productType" @if (old('table') == 'productType') selected="selected" @endif>Product type</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
               type="text">
    </div>
    <div class="mb-3">
        <label for="parentId" class="form-label">Parent ID</label>
        <input id="parentId" name="parentId" class="form-control @error('parentId') is-invalid @enderror"
               type="text">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
