@extends('layout')

@section('title', 'Checkout')

@section('extra-css')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')

<div class="container">

    @if(count($errors) > 0)
    <div class="spacer"></div>
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h1 class="checkout-heading stylish-heading">Checkout</h1>
    <div class="checkout-section">
        <div>
            <form action="{{route('checkout.store')}}" method="POST" id="payment-form">
                {{ csrf_field() }}
                <h2>Billing Details</h2>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" required>
                </div>

                <div class="half-form">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" id="province" name="province" value="{{old('province')}}" required>
                    </div>
                </div> <!-- end half-form -->

                <div class="half-form">
                    <div class="form-group">
                        <label for="postalcode">Postal Code</label>
                        <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{old('postalcode')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
                    </div>
                </div> <!-- end half-form -->

                <div class="spacer"></div>

                <h2>Payment Details</h2>

                <div class="form-group">
                    <label for="name_on_card">Name on Card</label>
                    <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="{{old('name_on_card')}}" required>
                </div>

                <div class="form-group">
                    <label for="card-element">
                        <!-- Credit or debit card -->
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here.  -->
                    </div>

                   <!-- Used to display form errors.  -->
                    <div id="card-errors" role="alert"></div>
                </div>


                <div class="spacer"></div>

                <button type="submit" class="button-primary full-width" id="complete-order">Complete Order</button>


            </form>
        </div>



        <div class="checkout-table-container">
            <h2>Your Order</h2>

            <div class="checkout-table">
                @foreach(Cart::instance('default')->content() as $item)
                <div class="checkout-table-row">
                    <div class="checkout-table-row-left">
                        <img src="{{$item->model->getImagePath()}}" alt="item" class="checkout-table-img">
                        <div class="checkout-item-details">
                            <div class="checkout-table-item">{{$item->model->name}}</div>
                            <div class="checkout-table-description">{{$item->model->details}}</div>
                            <div class="checkout-table-price">{{$item->model->getFormattedPrice()}}</div>
                        </div>
                    </div> <!-- end checkout-table -->

                    <div class="checkout-table-row-right">
                        <div class="checkout-table-quantity">{{$item->qty}}</div>
                    </div>
                </div> <!-- end checkout-table-row -->
                @endforeach




            </div> <!-- end checkout-table -->

            <div class="checkout-totals">
                <div class="checkout-totals-left">
                    Subtotal <br>
                    <!-- Discount (10OFF - 10%) <br> -->
                    Tax <br>
                    <span class="checkout-totals-total">Total</span>

                </div>

                <div class="checkout-totals-right">
                    {{ getFormattedPrice(Cart::subtotal())}} <br>
                    <!-- -$750.00 <br> -->
                    {{ getFormattedPrice(Cart::tax()) }} <br>
                    <span class="checkout-totals-total">{{getFormattedPrice(Cart::total())}}</span>

                </div>
            </div> <!-- end checkout-totals -->

        </div>

    </div> <!-- end checkout-section -->
</div>

@endsection
@section('extra-js')
<script src="/js/app.js"></script>
@endsection