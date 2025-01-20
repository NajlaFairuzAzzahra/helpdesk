@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Ticket</h1>
    <form action="{{ route('ticket.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="Software">Software</option>
                <option value="Hardware">Hardware</option>
            </select>
        </div>
        <div class="form-group">
            <label for="wo_type">Work Order Type</label>
            <input type="text" name="wo_type" id="wo_type" class="form-control">
        </div>
        <div class="form-group">
            <label for="scope">Scope</label>
            <textarea name="scope" id="scope" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
