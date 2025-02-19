@extends('mainLayout')
@section('page-title', 'Dashboard')
@section('page-content')
<div class="container-fluid">
    People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius
    <p>
        <a href="{{ route('usertool') }}" class="link-primary">Manage User Roles and Permissions</a>
    </p>

    <span>
        <i class="fas fa-caret-left tech-icon"></i>
        <a href="{{ route('home') }}" class="back-link">Back </a>
    </span>

</div>
@endsection

