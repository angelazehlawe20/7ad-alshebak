<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Text Content -->
    <label>Main Text</label>
    <textarea name="main_text" class="form-control" rows="6">{{ old('main_text', $about->main_text) }}</textarea>

    <!-- Box Title -->
    <label class="mt-3">Why Title</label>
    <input type="text" name="why_title" class="form-control" value="{{ old('why_title', $about->why_title) }}">

    <!-- Box Points -->
    <label class="mt-3">Why Points (one per line)</label>
    <textarea name="why_points" class="form-control" rows="5">{{ old('why_points', implode("\n", json_decode($about->why_points ?? '[]', true))) }}</textarea>

    <!-- Upload Gallery Images -->
    <label class="mt-3">Gallery Images</label>
    <input type="file" name="gallery_images[]" class="form-control" multiple>

    <!-- Show existing images -->
    @if($about->gallery_images)
      <div class="mt-3">
        @foreach(json_decode($about->gallery_images, true) as $img)
          <img src="{{ asset('storage/' . $img) }}" style="width:100px; height:auto; margin:5px">
        @endforeach
      </div>
    @endif

    <button class="btn btn-primary mt-4">Save Changes</button>
  </form>
