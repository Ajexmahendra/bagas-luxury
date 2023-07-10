@extends('front.layout.app')

@section('main_content')
    <div class="slider">
        <div class="slide-carousel owl-carousel">
            @foreach ($slide_all as $item)
                <div class="item" style="background-image:url({{ asset('uploads/' . $item->photo) }});">
                    <div class="bg"></div>
                    <div class="text">
                        <h2>{{ $item->heading }}</h2>
                        <p>
                            {!! $item->text !!}
                        </p>
                        @if ($item->button_text != '')
                            <div class="button">
                                <a href="{{ $item->button_url }}">{{ $item->button_text }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="search-section">
        <div class="container">
            <form action="{{ route('cart_submit') }}" method="post">
                @csrf
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select name="room_id" class="form-select">
                                    <option value="">Pilih Room</option>
                                    @foreach ($room_all as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input type="text" name="checkin_checkout" class="form-control daterange1"
                                    placeholder="Checkin & Checkout">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="number" name="adult" class="form-control" min="1" max="30"
                                    placeholder="Dewasa">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="number" name="children" class="form-control" min="0" max="30"
                                    placeholder="Anak-anak">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary">Book Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    @if ($global_setting_data->home_feature_status == 'Show')
        <div class="home-feature">
            <div class="container">
                <div class="row">

                    @foreach ($feature_all as $item)
                        <div class="col-md-3">
                            <div class="inner">
                                <div class="icon"><i class="{{ $item->icon }}"></i></div>
                                <div class="text">
                                    <h2>{{ $item->heading }}</h2>
                                    <p>
                                        {!! $item->text !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif



    @if ($global_setting_data->home_room_status == 'Show')
        <div class="home-rooms">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="main-header">Rooms and Suites</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($room_all as $item)
                        @if ($loop->iteration > $global_setting_data->home_room_total)
                        @break
                    @endif
                    <div class="col-md-3">
                        <div class="inner">
                            <div class="photo">
                                <img src="{{ asset('uploads/' . $item->featured_photo) }}" alt="">
                            </div>
                            <div class="text">
                                <h2><a href="{{ route('room_detail', $item->id) }}">{{ $item->name }}</a></h2>
                                <div class="price">
                                    Rp. {{ number_format($item->price) }}
                                </div>
                                <div class="button">
                                    <a href="{{ route('room_detail', $item->id) }}"
                                        class="btn btn-primary">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="big-button">
                        <a href="{{ route('room') }}" class="btn btn-primary">Lihat Semua Rooms</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


{{-- @if ($global_setting_data->home_testimonial_status == 'Show')
    <div class="testimonial" style="background-image: url(uploads/slide2.jpg)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="main-header">Our Happy Clients</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-carousel owl-carousel">
                        @foreach ($testimonial_all as $item)
                            <div class="item">
                                <div class="photo">
                                    <img src="{{ asset('uploads/' . $item->photo) }}" alt="">
                                </div>
                                <div class="text">
                                    <h4>{{ $item->name }}</h4>
                                    <p>{{ $item->designation }}</p>
                                </div>
                                <div class="description">
                                    <p>
                                        {!! $item->comment !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif --}}


@if ($global_setting_data->home_latest_post_status == 'Show')
    <div class="blog-item">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="main-header">Reviews</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($review as $item)
                    <div class="col-md-4">
                        <div class="card inner text-center">
                            <div class="photo">
                                @foreach ($item->order->orderDetail as $i)
                                    {{-- {{ $i->room->name }} --}}
                                    @if (!empty($i->room->roomPhoto->first()->photo))
                                        <img src="{{ asset('uploads/' . $i->room->roomPhoto->first()->photo) }}"
                                            alt="">
                                    @else
                                        <img src="{{ asset('uploads/' . $i->room->featured_photo) }}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <div class="rating">
                                @php
                                    $maxRating = 5; // Maksimum rating yang mungkin, dalam contoh ini adalah 5 bintang
                                    $fullStars = floor($item->rating); // Jumlah bintang penuh (bulatkan ke bawah)
                                    $halfStar = ceil($item->rating - $fullStars); // Jumlah bintang setengah (bulatkan ke atas)
                                @endphp
                                {{-- Tampilkan bintang penuh --}}
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <span>&#9733;</span>
                                @endfor

                                {{-- Tampilkan bintang setengah (jika ada) --}}
                                @if ($halfStar)
                                    <span>&#189;</span>
                                @endif

                                {{-- Tampilkan bintang kosong (jika ada) --}}
                                @for ($i = 0; $i < $maxRating - $fullStars - $halfStar; $i++)
                                    <span>&#9734;</span>
                                @endfor
                            </div>

                            <div class="text">
                                <div class="short-des">
                                    <p>
                                        @foreach ($item->order->orderDetail as $i)
                                            {{ $i->room->name }}
                                        @endforeach
                                    </p>
                                </div>
                                <h2 style="color: #00215b;!importan">{{ $item->review }}</h2>
                                {{-- <div class="button">
                                    <a href="{{ route('post', $item->id) }}" class="btn btn-primary">Selengkapnya</a>
                                </div> --}}
                                <div class="short-des">
                                    <p>(<strong>{{ $item->customer->name }}</strong>, {{ $item->created_at }})</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif



@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ $error }}',
            });
        </script>
    @endforeach
@endif
@endsection
