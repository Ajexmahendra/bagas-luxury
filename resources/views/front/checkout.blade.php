@extends('front.layout.app')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $global_page_data->checkout_heading }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 checkout-left">
                    <form action="{{ route('payment') }}" method="post" class="frm_checkout" enctype="multipart/form-data">
                        @csrf
                        <div class="billing-info">
                            <h4 class="mb_30">Billing Information</h4>
                            @php
                                if (session()->has('billing_name')) {
                                    $billing_name = session()->get('billing_name');
                                } else {
                                    $billing_name = Auth::guard('customer')->user()->name;
                                }
                                
                                if (session()->has('billing_email')) {
                                    $billing_email = session()->get('billing_email');
                                } else {
                                    $billing_email = Auth::guard('customer')->user()->email;
                                }
                                
                                if (session()->has('billing_phone')) {
                                    $billing_phone = session()->get('billing_phone');
                                } else {
                                    $billing_phone = Auth::guard('customer')->user()->phone;
                                }
                                if (session()->has('billing_address')) {
                                    $billing_address = session()->get('billing_address');
                                } else {
                                    $billing_address = Auth::guard('customer')->user()->address;
                                }
                            @endphp
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Name: *</label>
                                    <input type="text" class="form-control mb_15" name="billing_name"
                                        value="{{ $billing_name }}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Email Address: *</label>
                                    <input type="text" class="form-control mb_15" name="billing_email"
                                        value="{{ $billing_email }}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Phone Number: *</label>
                                    <input type="text" class="form-control mb_15" name="billing_phone"
                                        value="{{ $billing_phone }}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Address: *</label>
                                    <input type="text" class="form-control mb_15" name="billing_address"
                                        value="{{ $billing_address }}">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    {{-- <label for="">Pilih cara pembayaran: *</label>
                                    <select name="payment_method" class="form-control select2" id="paymentMethodChange"
                                        autocomplete="off" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="midtrans">Midtrans</option>
                                        <option value="transfer">Transfer Bank</option>
                                    </select> --}}
                                    {{-- <label for="">Pembayaran: *</label> --}}
                                    <input type="hidden" class="form-control mb_15" name="payment_method" value="transfer">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary bg-website mb_30">Continue to payment</button>
                    </form>
                </div>
                <div class="col-lg-4 col-md-6 checkout-right">
                    <div class="inner">
                        <h4 class="mb_10">Cart Details</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @php
                                        $arr_cart_room_id = session()->get('cart_room_id');
                                        $arr_cart_checkin_date = session()->get('cart_checkin_date');
                                        $arr_cart_checkout_date = session()->get('cart_checkout_date');
                                        $arr_cart_adult = session()->get('cart_adult');
                                        $arr_cart_children = session()->get('cart_children');
                                        $total_price = 0;
                                        
                                        for ($i = 0; $i < count($arr_cart_room_id); $i++) {
                                            $room_data = DB::table('rooms')
                                                ->where('id', $arr_cart_room_id[$i])
                                                ->first();
                                            $d1 = explode('/', $arr_cart_checkin_date[$i]);
                                            $d2 = explode('/', $arr_cart_checkout_date[$i]);
                                            $d1_new = $d1[2] . '-' . $d1[1] . '-' . $d1[0];
                                            $d2_new = $d2[2] . '-' . $d2[1] . '-' . $d2[0];
                                            $t1 = strtotime($d1_new);
                                            $t2 = strtotime($d2_new);
                                            $diff = ($t2 - $t1) / 60 / 60 / 24;
                                            $total_price += $room_data->price * $diff;
                                        
                                            echo '<tr>';
                                            echo '<td>';
                                            echo $room_data->name;
                                            echo '<br>';
                                            echo '(' . $arr_cart_checkin_date[$i] . ' - ' . $arr_cart_checkout_date[$i] . ')';
                                            echo '<br>';
                                            echo 'Adult: ' . $arr_cart_adult[$i] . ', Children: ' . $arr_cart_children[$i];
                                            echo '</td>';
                                            echo '<td class="p_price">';
                                            echo 'Rp. ' . $room_data->price * $diff;
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    @endphp

                                    <tr>
                                        <td><b>Total:</b></td>
                                        <td class="p_price"><b>Rp. {{ $total_price }}</b></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
