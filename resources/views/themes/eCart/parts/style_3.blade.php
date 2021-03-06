@if(isset($s->products) && is_array($s->products) && count($s->products))
<div class="main-content my-2 my-md-3">
    <section class="featured_product">
        <div class="container-fluid">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                <div class="section_title d-flex mb-3 align-items-baseline border-bottom">
                    <h2><span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ $s->title }}</span></h2>
                    <div class="pop_desc_title">
                        @if(isset($s->slug) && $s->slug != "")
                        <a href="{{ route('shop', ['section' => $s->slug]) }}" class="view title-section view-all ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{__('msg.view_all')}}&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                        @endif
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="featured_product_area product_carousel featured-product owl-carousel">
                            @php   $maxProductShow = get('style_3.max_product_on_homne_page');
                            $i=0;
                            @endphp
                            @foreach($s->products as $p)
                            @php
                            $i++;
                            @endphp
                            @if((--$maxProductShow) > -1)
                            @if($i%2 !== 0)
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        @if(!count(getInStockVarients($p)))
                                        <div class="content_label">
                                            <span class="sold-out">{{ __('msg.sold_out') }}</span>
                                        </div>
                                        @endif
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{ route('product-single', $p->slug) }}">
                                                <img class="lazy" data-original="{{ $p->image }}" alt="{{ $p->name ?? 'Product Name'}}">
                                            </a>
                                        </div>

                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="{{ route('product-single', $p->slug) }}">@if(strlen(strip_tags($p->name)) > 25) {!! substr(strip_tags($p->name), 0,25)."..." !!} @else {!! substr(strip_tags($p->name), 0,25) !!} @endif</a>
                                            </h4>
                                            <div class="action_links">
                                                <span class="inner product_data">
                                                    <ul>
                                                        @if(count(getInStockVarients($p)))
                                                        <input type="hidden" class="id" name="id" value="{{ $p->id }}" data-id="{{ $p->id }}">
                                                        @foreach(getInStockVarients($p) as $v)
                                                        <input type="hidden" class="qtyPicker qtyPicker-single-page qty" name="qty" type="number" id="qty-{{ $v->id }}" name="qty" data-min="1" min="1" max="{{(int)$v->stock+1}}" data-max="{{(int)$v->stock+1}}" data-max-allowed="{{ Cache::get('max_cart_items_count')+1 }}" value="{{ $v->cart_count+1 }}" readonly data-qty="{{ $v->cart_count+1 }}">
                                                        <input type="hidden" class="varient" data-varient="{{ $v->id }}" name="varient" value="{{ $v->id }}"  data-price='{{ get_price(get_price_varients($v)) }}' data-mrp='{{ get_price(get_mrp_varients($v)) }}' data-savings='{{ get_savings_varients($v) }}' checked>
                                                        @endforeach
                                                        <input type="hidden" class="slug" value="{{ $p->slug }}" data-slug="{{ $p->slug }}">
                                                        <input type="hidden" class="name" name="name" value="{{ $p->name }}" data-name="{{ $p->name }}">
                                                        <input type="hidden" class="image" name="image" value="{{ $p->image }}" data-image="{{ $p->image }}">
                                                        <input type="hidden" class="price" name="price" value="{{ print_price($p) }}" data-price="{{ print_price($p) }}">
                                                        @if(count(getInStockVarients($p))>1)
                                                        <li class="add_to_cart productmodal"><a title="Add to cart"><span class="fas fa-shopping-cart"></span></a></li>
                                                        @else
                                                        <li class="add_to_cart addtocart_single" data-id="{{ $p->id }}" data-varient="{{ $v->id }}" data-qty="1"><a title="Add to cart"><span class="fas fa-shopping-cart"></span></a></li>
                                                        @endif
                                                        <li class="quick_button productmodal"><a title="quick view"><span class="fas fa-eye"></span></a></li>
                                                        @endif
                                                        @if (session()->has('favourite'))
                                                        @if(in_array($p->id, session()->get('favourite')))
                                                        <li class="wishlist"><a  title="Add to Wishlist" class="saved" data-id='{{ $p->id }}'></a></li>
                                                        @else
                                                        <li class="wishlist"><a  title="Add to Wishlist" class="save" data-id='{{ $p->id }}'></a></li>
                                                        @endif
                                                        @else
                                                        <li class="wishlist"><a  title="Add to Wishlist" class="{{ (isset($p->is_favorite) && intval($p->is_favorite)) ? 'saved' : 'save' }}" data-id='{{ $p->id }}'></a></li>
                                                        @endif
                                                    </ul>
                                                </span>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">{!! print_price($p) !!}</span>
                                                <span class="old_price">{!! print_mrp($p) !!}</span>
                                                @if(get_savings_varients($p->variants[0]))
                                                <span class="discount-percentage discount-product">{{ get_savings_varients($p->variants[0]) }}</span>
                                                @endif
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                @endif
                                @if($i%2 == 0)
                                <article class="single_product">
                                    <figure>
                                        @if(!count(getInStockVarients($p)))
                                        <div class="content_label">
                                            <span class="sold-out">{{ __('msg.sold_out') }}</span>
                                        </div>
                                        @endif
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{ route('product-single', $p->slug) }}">
                                                <img class="lazy" data-original="{{ $p->image }}" alt="{{ $p->name ?? 'Product Name'}}">
                                            </a>
                                        </div>

                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="{{ route('product-single', $p->slug) }}">@if(strlen(strip_tags($p->name)) > 25) {!! substr(strip_tags($p->name), 0,25)."..." !!} @else {!! substr(strip_tags($p->name), 0,25) !!} @endif</a></h4>
                                            </h4>
                                            <div class="action_links">
                                                <span class="inner product_data">
                                                    <ul>
                                                        @if(count(getInStockVarients($p)))
                                                        <input type="hidden" class="id" name="id" value="{{ $p->id }}" data-id="{{ $p->id }}">
                                                        @foreach(getInStockVarients($p) as $v)
                                                        <input type="hidden" class="qtyPicker qtyPicker-single-page qty" name="qty" type="number" id="qty-{{ $v->id }}" name="qty" data-min="1" min="1" max="{{(int)$v->stock+1}}" data-max="{{(int)$v->stock+1}}" data-max-allowed="{{ Cache::get('max_cart_items_count')+1 }}" value="{{ $v->cart_count+1 }}" readonly data-qty="{{ $v->cart_count+1 }}">
                                                        <input type="hidden" class="varient" data-varient="{{ $v->id }}" name="varient" value="{{ $v->id }}"  data-price='{{ get_price(get_price_varients($v)) }}' data-mrp='{{ get_price(get_mrp_varients($v)) }}' data-savings='{{ get_savings_varients($v) }}' checked>
                                                        @endforeach
                                                        <input type="hidden" class="slug" value="{{ $p->slug }}" data-slug="{{ $p->slug }}">
                                                        <input type="hidden" class="name" name="name" value="{{ $p->name }}" data-name="{{ $p->name }}">
                                                        <input type="hidden" class="image" name="image" value="{{ $p->image }}" data-image="{{ $p->image }}">
                                                        <input type="hidden" class="price" name="price" value="{{ print_price($p) }}" data-price="{{ print_price($p) }}">
                                                        @if(count(getInStockVarients($p))>1)
                                                        <li class="add_to_cart productmodal"><a title="Add to cart"><span class="fas fa-shopping-cart"></span></a></li>
                                                        @else
                                                        <li class="add_to_cart addtocart_single" data-id="{{ $p->id }}" data-varient="{{ $v->id }}" data-qty="1"><a title="Add to cart"><span class="fas fa-shopping-cart"></span></a></li>
                                                        @endif
                                                        <li class="quick_button productmodal"><a title="quick view"><span class="fas fa-eye"></span></a></li>
                                                        @endif
                                                        @if (session()->has('favourite'))
                                                        @if(in_array($p->id, session()->get('favourite')))
                                                        <li class="wishlist"><a  title="Add to Wishlist" class="saved" data-id='{{ $p->id }}'></a></li>
                                                        @else
                                                        <li class="wishlist"><a  title="Add to Wishlist" class="save" data-id='{{ $p->id }}'></a></li>
                                                        @endif
                                                        @else
                                                        <li class="wishlist"><a  title="Add to Wishlist" class="{{ (isset($p->is_favorite) && intval($p->is_favorite)) ? 'saved' : 'save' }}" data-id='{{ $p->id }}'></a></li>
                                                        @endif
                                                    </ul>
                                                </span>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">{!! print_price($p) !!}</span>
                                                <span class="old_price">{!! print_mrp($p) !!}</span>
                                                @if(get_savings_varients($p->variants[0])>0)
                                                <span class="discount-percentage discount-product">{{ get_savings_varients($p->variants[0]) }}</span>
                                                @endif
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            @endif
                            @else
                            @break
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endif
