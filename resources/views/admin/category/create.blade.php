@extends('layouts.backend.app')
@section('title', 'Create Category')

@push('css')


@endpush

@section('content')
<div class="container-fluid">
            <div class="block-header">
                <h2>ADD CATEGORY</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW CATEGORY
                            </h2>
                
                @if($errors->any())

                @foreach($errors->all() as $error)

                <div class="alert alert-danger" role="alert">
                    {{  $error }}
                </div>

                @endforeach
                 @endif

                         
                        </div>
                        <div class="body">
                            <form method="POST" action="{{ route('admin.category.store')  }}" enctype="multipart/form-data" >
                                @csrf
                               
                                <div class="form-group">
                                <label for="name">Name</label>
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your category name">
                                    </div>
                                </div>

                                <div class="form-group">
                                <label for="name">Choose Photo (.png, .jpg only)</label>
                                    <div class="form-line">
                                        <input type="file" name="image" id="image" class="form-control" placeholder="Select category photo">
                                    </div>
                                </div>
                              

                                 <br>
                                 <a href="{{route('admin.category.index')}}"class="btn btn-danger m-t-15 waves-effects">BACK<a/>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
            
        </div>

@endsection


@push('js')




@endpush