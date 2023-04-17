@extends('layouts.app-master')

@section('content')
    @auth
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Roles - Management</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{ $roles->count() }} Roles.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            @can('role-create')
                                                <li><a href="{{ route('roles.create') }}"
                                                        class="btn btn-white btn-dim btn-outline-light"><em
                                                            class="icon ni ni-users"></em><span>NEW</span></a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h5 class="title">All Roles</h5>
                                        </div>
                                        <div class="card-tools me-n1">
                                            <ul class="btn-toolbar gx-1">
                                                <li>
                                                    <a href="#" class="search-toggle toggle-search btn btn-icon"
                                                        data-target="search"><em class="icon ni ni-search"></em></a>
                                                </li><!-- li -->
                                                <li class="btn-toolbar-sep"></li><!-- li -->
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                            <div class="badge badge-circle bg-primary">4</div>
                                                            <em class="icon ni ni-filter-alt"></em>
                                                        </a>
                                                        <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                            <div class="dropdown-head">
                                                                <span class="sub-title dropdown-title">Advance Filter</span>
                                                                <div class="dropdown">
                                                                    <a href="#" class="link link-light">
                                                                        <em class="icon ni ni-more-h"></em>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-body dropdown-body-rg">
                                                                <div class="row gx-6 gy-4">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="overline-title overline-title-alt">Type</label>
                                                                            <select class="form-select js-select2">
                                                                                <option value="any">Any Type</option>
                                                                                <option value="deposit">Deposit</option>
                                                                                <option value="buy">Buy Coin</option>
                                                                                <option value="sell">Sell Coin</option>
                                                                                <option value="transfer">Transfer</option>
                                                                                <option value="withdraw">Withdraw</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="overline-title overline-title-alt">Status</label>
                                                                            <select class="form-select js-select2">
                                                                                <option value="any">Any Status</option>
                                                                                <option value="pending">Pending</option>
                                                                                <option value="cancel">Cancel</option>
                                                                                <option value="process">Process</option>
                                                                                <option value="completed">Completed</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="overline-title overline-title-alt">Pay
                                                                                Currency</label>
                                                                            <select class="form-select js-select2">
                                                                                <option value="any">Any Coin</option>
                                                                                <option value="bitcoin">Bitcoin</option>
                                                                                <option value="ethereum">Ethereum</option>
                                                                                <option value="litecoin">Litecoin</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="overline-title overline-title-alt">Method</label>
                                                                            <select class="form-select js-select2">
                                                                                <option value="any">Any Method</option>
                                                                                <option value="paypal">PayPal</option>
                                                                                <option value="bank">Bank</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <div
                                                                                class="custom-control custom-control-sm custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    id="includeDel">
                                                                                <label class="custom-control-label"
                                                                                    for="includeDel"> Including Deleted</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <button type="button"
                                                                                class="btn btn-secondary">Filter</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-foot between">
                                                                <a class="clickable" href="#">Reset Filter</a>
                                                                <a href="#savedFilter" data-bs-toggle="modal">Save Filter</a>
                                                            </div>
                                                        </div><!-- .filter-wg -->
                                                    </div><!-- .dropdown -->
                                                </li><!-- li -->
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-setting"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                            <ul class="link-check">
                                                                <li><span>Show</span></li>
                                                                <li class="active"><a href="#">10</a></li>
                                                                <li><a href="#">20</a></li>
                                                                <li><a href="#">50</a></li>
                                                            </ul>
                                                            <ul class="link-check">
                                                                <li><span>Order</span></li>
                                                                <li class="active"><a href="#">DESC</a></li>
                                                                <li><a href="#">ASC</a></li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .dropdown -->
                                                </li><!-- li -->
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .card-tools -->


                                        <div class="card-search search-wrap" data-search="search">
                                            <form action="{{ route('roles.search') }}" method="POST">
                                                @csrf
                                                <div class="search-content">
                                                    <a href="#" class="search-back btn btn-icon toggle-search"
                                                        data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                    <input type="text" name="name"
                                                        class="form-control border-transparent form-focus-none"
                                                        placeholder="Quick search by name">
                                                    <button type="submit" class="search-submit btn btn-icon"><em
                                                            class="icon ni ni-search"></em></button>
                                                </div>
                                            </form>
                                        </div>


                                        <!-- .card-search -->
                                    </div><!-- .card-title-group -->
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-tnx">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col tb-col-sm"><span>No</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Role</span></div>
                                            <div class="nk-tb-col nk-tb-col-status">
                                                <span class="sub-text d-none d-md-block">Action</span>
                                            </div>

                                        </div><!-- .nk-tb-item -->
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($roles as $key => $role)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col tb-col-sm">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead"> {{ ++$i }} </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="nk-tb-col nk-tb-col-status">
                                                    @if ($role->name === 'Admin' || $role->name === 'admin')
                                                        <div class="dot dot-success d-md-none"></div>
                                                        <span
                                                            class="badge badge-sm badge-dim bg-outline-success d-none d-md-inline-flex">{{ $role->name }}</span>
                                                    @else
                                                        <div class="dot dot-warning d-md-none"></div>
                                                        <span
                                                            class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">{{ $role->name }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <div class="nk-tb-col nk-tb-col-status">
                                                        <ul class="nk-tb-actions gx-2">
                                                            <li class="nk-tb-action">
                                                                <a class="btn btn-info"
                                                                    href="{{ route('roles.show', $role->id) }}">Show</a>
                                                            </li>
                                                            <li class="btn btn-action">
                                                                {{-- @can('role-edit') --}}
                                                                <a class="btn btn-primary"
                                                                    href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                                {{-- @endcan --}}
                                                            </li>
                                                            <li class="btn btn-action">
                                                                {{-- @can('role-delete') --}}
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                                {!! Form::close() !!}
                                                                {{-- @endcan --}}
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                        @endforeach
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    {{ $roles->links() }}
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    @endauth

    @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
    @endguest

    <script>
        setTimeout(function() {
            $('.alert').slideUp();
        }, 10000); // 10 seconds
    </script>
@endsection
