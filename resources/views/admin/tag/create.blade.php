@extends('layouts.backend.app')
@section('title', 'Create Tag')

@push('css')


@endpush

@section('content')
<div class="container-fluid">
            <div class="block-header">
                <h2>ADD TAG</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW TAG
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
                            <form method="POST" action="{{ route('admin.tag.store')  }}">
                                @csrf
                                <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your tag name">
                                    </div>
                                </div>
                              

                                 <br>
                                 <a href="{{route('admin.tag.index')}}"class="btn btn-danger m-t-15 waves-effects">BACK<a/>
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