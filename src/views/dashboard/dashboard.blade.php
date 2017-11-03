@extends('admin::layout.master')

@section('content')
@include('admin::partials.alert-messages')
<div class="block-header">
    <h2>Dashboard</h2>
</div>
<div class="card">
  <div class="body">
    <h4>This is default dashboard page.</h4>
    <table class="table table-striped table-bordered no-margin">
      <tr>
        <td width="120">Route Name</td>
        <td width="10" class="text-center">:</td>
        <td><code>{? schema.route.name ?}dashboard</code></td>
      </tr>
      <tr>
        <td width="120">Controller</td>
        <td width="10" class="text-center">:</td>
        <td><code>{? schema.controller.path ?}/DashboardController.php</code></td>
      </tr>
      <tr>
        <td width="120">View</td>
        <td width="10" class="text-center">:</td>
        <td><code>{? schema.view.path ?}/dashboard/dashboard.blade.php</code></td>
      </tr>
    </table>
  </div>
</div>
@stop
