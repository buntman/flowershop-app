@extends('components.admin-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link href="{{asset('css/dashboard-style.css')}}" rel="stylesheet">
@section('title', 'Dashboard')
    <div class="container my-5">
    <table id="orders_table" class="table table-hover">
        <thead>
          <tr>
                <th ">Customer</th>
                <th ">Order #</th>
                <th ">Total</th>
                <th ">Status</th>
          </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr data-bs-toggle="modal" data-bs-target="#order_details_modal" onclick="displayOrderDetails({{ $order->order_id }})">
                <td  class="py-3">{{$order->customer_name}}</td>
                <td  class="py-3">{{$order->order_number}}</td>
                <td  class="py-3">₱{{$order->total}}</td>
                <td  class="py-3">{{$order->status}}</td>
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
<script>
$(document).ready(function() {
    $('#orders_table').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10
    });
});
</script>
<script src="/js/dashboard.js"></script>
