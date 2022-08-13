@extends('base')

@section('content')
<form method="POST" action="{{route('submit-form')}}">
    @csrf
    <h3>Please enter your name and pick the sectors you are currently involved in</h3>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" class="form-control @error('name') is-invalid @enderror"
               type="text">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sectors" class="form-label">Sectors</label>
        <select id="sectors" class="form-select @error('name') is-invalid @enderror" multiple size="5">
            <@foreach($selections as $sector)
                <option value="{{$sector['id']}}">{{$sector['name']}}</option>
                @foreach($sector['children'] as $industry)
                    <option class="ps-2" value="{{$industry['id']}}">{{$industry['name']}}</option>
                    @foreach($industry['children'] as $product)
                        <option class="ps-4" value="{{$product['id']}}">{{$product['name']}}</option>
                        @foreach($product['children'] as $productType)
                            <option class="ps-5" value="{{$productType['id']}}">{{$productType['name']}}</option>
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach>
        </select>
        @error('sectors')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <label class="form-check-label" for="agreement">Agree to terms</label>
        <input id="agreement" class="form-check-input" type="checkbox">
    </div>
    <button type="submit" disabled id="submitButton" class="btn btn-primary">Save</button>
</form>
<script>
    let submitButton = document.getElementById("submitButton")
    document.getElementById('agreement').onclick = function() {
        submitButton.disabled = !this.checked;
    };
</script>
@endsection
