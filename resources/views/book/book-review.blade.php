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
            @foreach ($books as $book)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <img src="{{  $book->cover != null ? asset('storage/cover/'. $book->cover) : asset('images/cover.png') }}" class="card-img-top" draggable="false">
                    <div class="card-body">
                      <h5 class="card-title">{{ $book->book_code }}</h5>
                      <p class="card-text">{{ $book->title }}</p>
                      <p class="card-text text-end fw-bold {{ $book->status == 'in stock' ? 'text-success' : 'text-danger'}}">
                        {{ $book->status }}
                      </p>
                      @if ($book->status != 'not available')
                      <form action="{{ route('pengembalian', ['slug' => $book->slug]) }}" method="post">
                        @csrf
                      <Input type="hidden" name="book_id" value="{{$book->id}}">
                      <button class="btn btn-primary">Return</button>
                      </form>
                      @endif
                    </div>

                  </div>
            </div>
            @endforeach

    @include('sweetalert::alert')

@endsection
