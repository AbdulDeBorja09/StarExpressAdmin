@extends('admin.layout.app')
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl">Add Employees</h2>
    </div>
    <div class="panel mt-5 overflow-hidden border-0 p-0">
        <div>
            <h1>Add</h1>
        </div>
    </div>
</div>

@endsection