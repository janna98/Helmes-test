@extends('base')

@section('content')
<form method="POST" action="{{route('submit-form')}}">
    @csrf
    <input type="hidden" name="userId" id="userId" @if (Session::has('userId')) value="{!! Session::get('userId') !!}" @endif/>
    <h3>Please enter your name and pick the sectors you are currently involved in</h3>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" name="name" required value="{{old('name')}}" type="text"
               class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sectors" class="form-label">Sectors</label>
        <select id="sectors" name="sectors[]" required
                class="form-select @error('sectors') is-invalid @enderror" multiple size="5">
            <@foreach($selections as $sector)
                <option @if (old('sectors') && in_array("sector_" . $sector['id'], old('sectors'))) selected="selected" @endif
                    value="{{"sector_".$sector['id']}}">{{$sector['name']}}</option>
                @foreach($sector['children'] as $industry)
                    <option @if (old('sectors') && in_array("industry_" . $industry['id'], old('sectors'))) selected="selected" @endif
                        class="level-two" value="{{"industry_" .$industry['id']}}">{{$industry['name']}}</option>
                    @foreach($industry['children'] as $product)
                        <option @if (old('sectors') && in_array("product_" . $product['id'], old('sectors'))) selected="selected" @endif
                        class="level-three" value="{{"product_".$product['id']}}">{{$product['name']}}</option>
                        @foreach($product['children'] as $productType)
                            <option @if (old('sectors') && in_array("productType_" . $productType['id'], old('sectors'))) selected="selected" @endif
                            class="level-four" value="{{"productType_".$productType['id']}}">{{$productType['name']}}</option>
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
        <input id="agreement" name="agreement" required @if(old('agreement')) checked @endif
               class="form-check-input @error('agreement') is-invalid @enderror" type="checkbox">
    </div>
    @error('agreement')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button type="submit" id="submitButton" class="btn btn-primary">Save</button>
    @if (Session::has('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
    @endif
</form>
<script>
    /*let submitButton = document.getElementById("submitButton")
    document.getElementById('agreement').onclick = function() {
        submitButton.disabled = !this.checked;
    };*/
</script>
@endsection
