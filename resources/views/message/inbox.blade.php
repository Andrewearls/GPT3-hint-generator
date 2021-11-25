@extends('layouts.app')

@section('content')
	{{$channel}}
	<messaging-component 
		posturl="{{route('messages')}}" 
		channel= "{{$channel}}"
	></messaging-component>
@endsection