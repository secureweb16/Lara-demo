@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="price_box ">
                                  <div class="mepr-price-box-head">
                                    <div class="price_title">$70 </div>
                                    </div>
                                    <div class="plan_cont">
                                        <p>Test 1</p>
                                        <p>Test 2</p>
                                        <p>Test 3</p>
                                    </div>

                                  <div class="buyNow">
                                    @php
                                        $currentusercharge = App\Charge::where(['amount' => 70, 'userid' => Auth::user()->id])->first();
                                    @endphp
                                   @if( count( $currentusercharge ) == 0 ) 
                                    <form class="form-horizontal " role="form" method="POST" action="{{ url('/home') }}">
                                        @csrf
                                        <input type="submit" class="customButton" value="Buy Now"/>
                                        <input type="hidden" name="amount" value="7000" >
                                        <div class="hidescript">
                                            <script
                                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                data-key="{{ $_ENV['STRIPE_KEY'] }}"
                                                data-amount="7000"
                                                data-name="Billing Form 1"
                                                data-description="Single Charge Payment 1"
                                                data-image=""
                                                data-locale="auto">
                                            </script>
                                        </div>
                                    </form>
                                     @else
                                        <button class="customButton" > Already paid </button>
                                     @endif
                                  </div>
                            </div>
                        </div>
                        <div class="col-md-6">                            
                            <div class="price_box ">
                                <div class="mepr-price-box-head">
                                    <div class="price_title">$90 </div>
                                </div>
                                <div class="plan_cont">
                                    <p>Test 1</p>
                                    <p>Test 2</p>
                                    <p>Test 3</p>
                                </div>
                                @php
                                    $currentusercharge = App\Charge::where(['amount' => 90, 'userid' => Auth::user()->id])->first();
                                @endphp
                               @if( count( $currentusercharge ) == 0 ) 
                                    <div class="buyNow">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/home') }}">
                                            @csrf
                                            <input type="submit" class="customButton" value="Buy Now"/>
                                            <input type="hidden" name="amount" value="9000" >
                                            <div class="hidescript">
                                                <script
                                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                    data-key="{{ $_ENV['STRIPE_KEY'] }}"
                                                    data-amount="9000"
                                                    data-name="Billing Form 2"
                                                    data-description="Single Charge Payment 2"
                                                    data-image=""
                                                    data-locale="auto">
                                                </script>
                                            </div>
                                        </form>
                                    </div> 
                                 @else
                                    <button class="customButton" > Already paid </button>
                                 @endif
                            </div> 
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection