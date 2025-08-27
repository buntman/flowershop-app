@extends('components.admin-layout')
<link href="{{asset('css/dashboard-style.css')}}" rel="stylesheet">
@section('title', 'Dashboard')
      <main class="col-md-11 p-4 mt-5 container">
        <div class="row">

          <div class="col-md-6 mb-3">
            <div class="card-custom">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-light">Pending Orders</h5>
              </div>
              <!-- SCROLLABLE CONTENT -->
              <div class="scrollable mt-2">
                <!-- CONTENT-SECTION -->
              @if(!$pending_orders->isEmpty())
              @foreach ($pending_orders as $pending_order)
                <div class="order-card d-flex align-items-center w-100">
                  <img src="{{ route('products.image', $pending_order->image_name) }}" alt="Bouquet" width="120" height="130" class="rounded">
                  <div class="d-flex flex-column w-100 gap-0 ps-3">
                    <p class="mb-0 fw-bold product_name">{{ $pending_order->product_name }}</p>
                    <p class=" m-0 order-details">Order ID: <span class="started">{{$pending_order->order_id}}</span></p>
                    <p class=" m-0 order-details">Customer: <span class="started">{{$pending_order->user_name}}</span></p>
                    <p class=" m-0 order-details">Quantity: <span class="started">{{$pending_order->quantity}}</span></p>
                    <div class=" d-flex flex justify-content-start align-items-center">
                      <span>
                        <p class=" m-0 order-details">Pickup Schedule: <span class="started">{{$pending_order->pickup_date}} {{$pending_order->pickup_time}}</span></p>
                      </span>
                    </div>
                  </div>
            <button id="check-button" type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm me-4"
                        title="Mark as Completed">
                     <i class="fas fa-check-circle"></i>
            </button>
                </div>
                @endforeach
                @else
                <div class="d-flex justify-content-center align-items-center w-100 py-5">
                <div class="alert alert-info text-center shadow-sm rounded-3 px-4 py-3">
                <i class="fas fa-box-open fa-lg mb-2 d-block text-secondary"></i>
                <p class="m-0 fw-semibold text-secondary">No Pending Orders!</p>
                </div>
                </div>
                @endif
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <div class="card-custom">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-light">Completed Orders</h5>
              </div>
              <div id="container" class="scrollable mt-2">
                @if (!$completed_orders->isEmpty())
                @foreach($completed_orders as $completed_order)
                <!-- SECOND SECTION OF SCROLLABLE CONTENT -->
                <div id="card" class="order-card d-flex align-items-center w-100" style="display:none;">
                  <img class="product_image rounded" src="" alt="Bouquet" width="120" height="130">
                  <div class="d-flex flex-column w-100 me-5 gap-0 ps-3">
                    <p class="mb-0 fw-bold product_name"></p>
                    <p class=" m-0 order-details">Order ID: <span class="started order_id"></span></p>
                    <p class=" m-0 order-details">Customer: <span class="started customer_name"></span></p>
                    <div class=" d-flex flex justify-content-start align-items-center">
                      <span>
                        <p class=" m-0 order-details">Pickup Schedule: <span class="started pickup_schedule"></span></p>
                      </span>
                      <span class="ms-3 ps-5">
                        <p class=" m-0 order-details">Status: <span class="status"></span></p>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
                @else
                <div class="d-flex justify-content-center align-items-center w-100 py-5">
                    <div class="alert alert-success text-center shadow-sm rounded-3 px-4 py-3">
                    <i class="fas fa-clipboard-check fa-lg mb-2 d-block text-success"></i>
                    <p class="m-0 fw-semibold text-success">No Completed Orders Yet!</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
      </main>
<script src="/js/dashboard.js"></script>
@section('content')
@endsection
