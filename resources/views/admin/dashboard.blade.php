@extends('components.admin-layout')
@section('title', 'Dashboard')
@section('content')
    <link href="{{asset('css/dashboard-style.css')}}" rel="stylesheet">
    <div class="container">
    @include('shared.session-success-message')
    <table id="orders_table" class="table table-hover">
        <thead>
          <tr>
                <th>Customer</th>
                <th>Contact</th>
                <th>Order #</th>
                <th>Total</th>
                <th>Status</th>
          </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td  class="py-3 align-middle">
                    <a
                        class="text-decoration-underline"
                        data-bs-toggle="modal"
                        data-bs-target="#order_details_modal"
                        onclick="displayOrderDetails({{$order->order_id}})">
                        {{$order->customer_name}}
                    </a>
                </td>
                <td  class="py-3 align-middle">{{$order->contact_number}}</td>
                <td  class="py-3 align-middle">{{$order->order_number}}</td>
                <td  class="py-3 align-middle">₱{{$order->total}}</td>
                <td  class="py-3">
            @php
                $statusClasses = [
                'pending' => 'bg-warning text-dark',
                'ready_for_pickup' => 'bg-info text-dark',
                'completed' => 'bg-success text-white',
            ];
                $currentClass = $statusClasses[$order->status] ?? 'bg-secondary text-white';
            @endphp
            <form action="{{ route('orders.updateStatus', $order->order_id) }}" method="POST" class="m-0">
                @csrf
                @method('PATCH')
                <select id="status"
                    name="status"
                    onchange="this.form.submit()"
                    class="form-select form-select-sm border-0 fw-bold text-center {{ $currentClass }}"
                    >
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} class="bg-white text-dark">
                    Pending
                </option>
                <option value="ready_for_pickup" {{ $order->status == 'ready_for_pickup' ? 'selected' : '' }} class="bg-white text-dark">
                    Ready for Pickup
                </option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }} class="bg-white text-dark">
                    Completed
                </option>
                </select>
            </form>
                </td>
            </tr>
            @endforeach
         </tbody>
    </table>
    </div>
    <div class="modal fade mt-5" id="order_details_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-scroll">
            <div class="row mb-2 align-items-center">
        <div class="col-6 fw-bold">Product</div>
        <div class="col-3 text-end fw-bold">Quantity</div>
        <div class="col-3 text-end fw-bold">Price</div>
            </div>
            <div id="modal_body" >
            </div>
        </div>
        </div>
        </div>
    </div>
<script src="{{ asset('/js/dashboard.js') }}"></script>
@endsection
