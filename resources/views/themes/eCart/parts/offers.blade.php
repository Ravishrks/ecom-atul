{{-- big Offer banner --}}
@if(Cache::has('offers') && is_array(Cache::get('offers')) && count(Cache::get('offers')))
@foreach(Cache::get('offers') as $o)
@if(isset($o->image) && trim($o->image) !== "")
<div class="main-content home-banner banner-sec-2">
   
    <div class="container-fluid  bg-white shadow-sm rounded">
        <div class="row bg-white rounded p15-4">
            <div class="col-md-12">
                <div class="banner_box_content">
                    <img class="lazy" data-original="{{ $o->image }}" alt="ad-1">
                </div>
            </div>
        </div>
    </div>
    
</div>
@endif
@endforeach
@endif