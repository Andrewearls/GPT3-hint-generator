@extends('layouts.app')

@section('content')
	<messaging-component posturl="{{route('messageGPT')}}"></messaging-component>
@endsection