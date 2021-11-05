@extends('layouts.app')

@section('content')
	<example-component></example-component>
	<messaging-component posturl="{{route('messageGPT')}}"></messaging-component>
@endsection