@extends('layouts.app')
@section('title', 'Tentang Kami')
@section('content')
    <div class="pt-20">
        @include('sections.about')
        @include('sections.vision_mission')
        @include('sections.values')
    </div>
@endsection
