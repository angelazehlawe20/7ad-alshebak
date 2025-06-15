@extends('admin.layouts.app')
@section('title', 'Edit About')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit About</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.about.update') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Main Text</label>
                                    <textarea name="main_text" class="form-control" rows="6">{{ old('main_text', $about->main_text) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Why Title</label>
                                    <input type="text" name="why_title" class="form-control" value="{{ old('why_title', $about->why_title) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Why Points (one per line)</label>
                                    <textarea name="why_points" class="form-control" rows="5">{{ old('why_points', implode("\n", json_decode($about->why_points ?? '[]', true))) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Gallery Images</label>
                                    <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*">
                                    @if($about->gallery_images)
                                        <div class="mt-3" id="imagePreview">
                                            @foreach(json_decode($about->gallery_images, true) as $img)
                                                <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail" style="width:100px; height:auto; margin:5px">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <a href="{{ route('about') }}" class="btn btn-light">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
