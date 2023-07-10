@extends('customer.layout.app')

@section('heading', 'Review')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('review_post', $orders->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="rating">Rating:</label>
                                        <select name="rating" class="form-control">
                                            <option value="1">1 Bintang</option>
                                            <option value="2">2 Bintang</option>
                                            <option value="3">3 Bintang</option>
                                            <option value="4">4 Bintang</option>
                                            <option value="5">5 Bintang</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Konten:</label>
                                        <textarea name="review" class="form-control h_100" cols="30" rows="10">{{ old('review') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim Review</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
