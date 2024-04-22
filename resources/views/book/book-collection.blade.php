@extends('layouts.main')

@section('title', 'Peminjaman')

@section('content')

    {{-- <form action="" method="get">
    <div class="row">
      <div class="col-12 col-sm-6">
          <select name="category" id="category" class="form-control">
            <option value="">Select Category</option>
            @foreach ($category as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
            @endforeach
          </select>
      </div>
          
      <div class="col-12 col-sm-6">
          <div class="input-group mb-3">
            <input type="text" name="title" class="form-control" placeholder="Judul Buku" aria-describedby="basic-addon2">
            <button class="btn btn-primary" type="submit">Search</button>
          </div>
        </div>
    </div>
  </form> --}}

    <div class="my-5">
        <div class="row">
            @foreach ($collection as $koleksi)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <img src="{{  $koleksi->book->cover != null ? asset('storage/cover/'. $koleksi->book->cover) : asset('images/cover.png') }}" class="card-img-top" draggable="false">
                    <div class="card-body">
                      <h5 class="card-title">{{ $koleksi->book->book_code }}</h5>
                      <p class="card-text">{{ $koleksi->book->title }}</p>
                      <p class="card-text text-end fw-bold {{ $koleksi->book->status == 'in stock' ? 'text-success' : 'text-danger'}}">
                        {{ $koleksi->book->status }}
                      </p>
                      @if ($koleksi->book->status != 'not available')
                      <form action="{{ route('store-rent')}}" method="post">
                        @csrf
                      <Input type="hidden" name="book_id" value="{{$koleksi->book->id}}">
                      <button class="btn btn-primary">Borrow</button>
                      </form>
                      @endif
                    </div>

                  </div>
            </div>
            @endforeach

    @include('sweetalert::alert')

@endsection
