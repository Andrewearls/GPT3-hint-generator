@extends('layouts.app')

@section('content')
	<messaging-component posturl="{{route('message.GPT')}}"></messaging-component>
@endsection