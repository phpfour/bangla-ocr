@extends('layouts.master')

@section("title") Dashboard @endsection

@section('content')

    @if ($user)

        <div class="col-xs-12">

            <div class="alert alert-info">Add new image by clicking on the + icon on the left sidebar.</div>

            <div class="grid">
                <div class="grid-sizer"></div>
                @foreach($images as $image)
                    <div class="grid-item {{ $image['status'] }}" data-id="{{ $image['id'] }}" data-status="{{ $image['status']  }}"
                         data-preview="<?= Image::url('/uploads/images/' . $image['path'], 400) ?>">
                        <img src="<?= Image::url('/uploads/images/' . $image['path'], 200, 300) ?>"/>
                    </div>
                @endforeach
            </div>

        </div>

    @else

        <div class="col-xs-12">

            <div class="well" style="background-color: #fff">

                <p>We use the OCR capability of Google Drive to perform the image to text conversion of your documents. Thus we need you to sign in using your Google Account and grant access to your Google Drive for performing the OCR.</p>

                <div style="width: 200px;">
                    <a href="{{ url('/google/login') }}" class="btn btn-block btn-social btn-google">
                        <i class="fa fa-google"></i>
                        Sign in with Google
                    </a>
                </div>

            </div>

        </div>

    @endif

@endsection

@section("footer")

    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="uploadModalLabel">Upload Images</h4>
                </div>
                <div class="modal-body">
                    <form action="/upload" class="dropzone" id="dropzone"></form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Upload Files</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="uploadModalLabel">View Image</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="imagePreview" class="col-md-6"></div>
                        <div id="imageText" class="col-md-6">
                            <textarea class="form-control" cols="10" rows="25"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection