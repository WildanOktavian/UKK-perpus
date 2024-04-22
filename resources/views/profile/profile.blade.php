@extends('layouts.main')

@section('title', 'Profile')

@section('content')
<h1>  Catatan Peminjaman Anda </h1>

<div class="mt-5">
    <x-browwing-table :browwing='$peminjaman' />
</div>
@endsection