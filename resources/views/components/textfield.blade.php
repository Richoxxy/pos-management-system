@php
if(!isset($value)){
    $value = '';
}
@endphp
<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$label}}</label>
    <input type="{{$type}}" value="{{old($name,$value)}}" name="{{$name}}" class="form-control @if(isset($errors) && $errors->has($name)) is-invalid @endif" placeholder="{{$placeholder}}">
    @if(isset($errors) && $errors->has($name))
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
</div>
