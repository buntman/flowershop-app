@extends('components.admin-layout')
<link href="{{asset('css/dashboard-style.css')}}" rel="stylesheet">
@section('title', 'Dashboard')
      <main class="col-md-11 p-4 mt-5 container">
        <div class="row">
        @include('shared.session-success-message')
          <div class="col-md-6 mb-3">
            <div class="card-custom">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-light">Pending Bouquets</h5>
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
                    <p class=" m-0 order-details">Quantity: <span class="started">{{$pending_order->quantity}}</span></p>
                    <p class=" m-0 order-details">Customer: <span class="started">{{$pending_order->user_name}}</span></p>
                  </div>
                <form action="{{route('item.update', $pending_order->item_id)}}" method="POST">
                @csrf
                @method('PATCH')
                <button id="check-button" type="submit" rel="tooltip" class="btn btn-success btn-just-icon btn-sm me-4"
                        title="Mark as Completed">
                        <i class="fas fa-check-circle"></i>
                </button>
                </form>
                </div>
                @endforeach
                @else
                <div class="d-flex justify-content-center align-items-center w-100 py-5">
                <div class="alert alert-info text-center shadow-sm rounded-3 px-4 py-3">
                <i class="fas fa-box-open fa-lg mb-2 d-block text-secondary"></i>
                <p class="m-0 fw-semibold text-secondary">No pending bouquets to make!</p>
                </div>
                </div>
                @endif
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <div class="card-custom">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-light">Completed Bouquets</h5>
              </div>
              <div id="container" class="scrollable mt-2">
                <!-- SECOND SECTION OF SCROLLABLE CONTENT -->
                @if (!$completed_items->isEmpty())
                @foreach($completed_items as $completed_item)
                <div id="card" class="order-card d-flex align-items-center w-100" style="display:none;">
                  <img class="product_image rounded" src="{{route('products.image', $completed_item->image_name)}}" alt="Bouquet" width="120" height="130">
                  <div class="d-flex flex-column w-100 me-5 gap-0 ps-3">
                    <p class="mb-0 fw-bold product_name">{{$completed_item->product_name}}</p>
                    <p class=" m-0 order-details">Order ID: <span class="started">{{$completed_item->order_id}}</span></p>
                    <p class=" m-0 order-details">Quantity: <span class="started">{{$completed_item->quantity}}</span></p>
                    <p class=" m-0 order-details">Customer: <span class="started">{{$completed_item->user_name}}</span></p>
                  </div>
                </div>
                @endforeach
                @else
                <div class="d-flex justify-content-center align-items-center w-100 py-5">
                    <div class="alert alert-success text-center shadow-sm rounded-3 px-4 py-3">
                    <i class="fas fa-clipboard-check fa-lg mb-2 d-block text-success"></i>
                    <p class="m-0 fw-semibold text-success">No completed bouquets yet!</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
      </main>
<script src="/js/dashboard.js"></script>
@section('content')
@endsection
