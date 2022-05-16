<!-- breadcumb -->
<section class="page_title corner-title overflow-visible">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center">
            <h1>{{__('msg.my_address')}}</h1>
            <ol class="breadcrumb">
               <li class="breadcrumb-item">
                  <a href="{{ route('home') }}">{{__('msg.home')}}</a>
               </li>
               <li class="breadcrumb-item active">
                  {{__('msg.my_address')}}
               </li>
            </ol>
            <div class="divider-15 d-none d-xl-block"></div>
         </div>
      </div>
   </div>
</section>
<!-- eof breadcumb -->
<div class="main-content">
   <section class="checkout-section ptb-70">
      <div class="container">
         <div class="row">
            <div class="col-lg-3 col-md-12 col-12 mb-4">
               @include("themes.".get('theme').".user.sidebar")
            </div>
            <div class="col-lg-9 col-md-12 col-12">

               @if(isset($data['address']) && is_array($data['address']) && count($data['address']))
               <div id="data-step1" class="account-content px-2 py-4 px-md-4 py-md-3 bg-white shadow rounded" data-temp="tabdata">
                  <div class="m-0"  id="address">
                     <div id="mydesc">

                        <div class="section_title d-flex mb-3 align-items-baseline border-bottom pl-0">
                           <h2>
                              <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block ">{{__('msg.Account Information')}}</span>
                           </h2>
                        </div>
                        <div class="row">
                           @foreach($data['address'] as $a)
                           @if(isset($a->id) && intval($a->id))
                           <div class="col-md-6 mb-3">
                              <div class="cart-total-table address-box commun-table">
                                 <div class="table-responsive">
                                    <table class="table table-shopping-cart" aria-describedby="mydesc" aria-hidden="true">
                                       <thead>
                                          <tr class="delivery-address">
                                             <th scope="col"><input type="radio" name="id" value="{{ $a->id }}" {{ (count($data['address']) == 1 || (isset($a->is_default) && intval($a->is_default)) ? 'checked=checked' : '') }}> {{ $a->type }}
                                                <span class="form-group edit-delete">
                                                   <button class="btn editAddress" data-data='{{ json_encode($a) }}'> <em class="fa fa-pencil-alt"></em></button>
                                                   <a href="{{ route('address-remove', $a->id) }}" class="btn"> <em class="fas fa-times text-danger"></em></a>
                                                </span>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <ul>
                                                   <li class="inner-heading"> <strong>{{ $a->name ?? '' }}</strong></li>
                                                   <li>
                                                      <p>{{ $a->address ?? '' }}, {{ $a->area_name ?? '' }}<br>
                                                         {{ $a->city_name ?? ''}} - {{ $a->pincode ?? '' }}<br>
                                                         {{__('msg.mobile')}}: {{ ($a->country_code ?? '') ." ". ($a->mobile ?? '-') }}
                                                      </p>
                                                   </li>
                                                </ul>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           @endif
                           @endforeach
                        </div>
                        <div class="">
                           <div class="add_new_address_btn col-md-6">
                              <span onclick="address()" class="btn btn-primary">{{__('msg.add_new_address')}}&nbsp;&nbsp;<em class="fas fa-plus"></em></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row ">
                     <div class="col-md-12" id="editAddress">
                        <div class="bg-white">
                           <div class="section_title d-flex mb-3 align-items-baseline border-bottom pl-0">
                              <h2>
                                 <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block ">{{__('msg.edit_address')}}</span>
                              </h2>
                           </div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-lg">
                                    <form action="{{ route('address-add') }}" id='formEditAddress' method="POST">
                                       <input type="hidden" name="id">
                                       <input type="hidden" name="latitude" value="0">
                                       <input type="hidden" name="longitude" value="0">
                                       <input type="hidden" name="country_code" value="0">
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.name')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" name="name" type="text">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                           <br/>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.mobile_no')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" id='editPhone' type="number" name="mobile">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <br/>
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.alternate_mobile_no')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="number" name="alternate_mobile">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <br/>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.address')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="text" name="address">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <br/>
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.landmark')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="text" name="landmark">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                  <label>{{__('msg.select_city')}}</label>
                                                  <br>
                                                  <select name='city' class="form-control" required></select>
                                             </div>
                                         </div>
                                          <br/>

                                       </div>
                                       <br/>
                                       <div class="row">

                                          <br/>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group col mt-1">
                                             <label>{{__('msg.select_area')}}</label>
                                             <br>
                                             <select name='area' class="form-control" required></select>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.pincode')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="number" name="pincode">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <br/>
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                              <div class="form-group mt-1">
                                                <label>{{__('msg.state')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="text" name="state" required>
                                                   </div>
                                                </div>
                                              </div>
                                          </div>
                                          <br/>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.country')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="text" name="country" required>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <br/>
                                       <div class="form-group mt-1">
                                          <label class="radio-inline">
                                             <input class="mr-2" type="radio" name="type" checked value="Home">{{__('msg.home')}}
                                          </label>
                                          <label class="radio-inline  ml-5">
                                             <input class="mr-2" type="radio" name="type" value="Work">{{__('msg.work')}}
                                          </label>
                                          <label class="radio-inline  ml-5">
                                             <input class="mr-2" type="radio" name="type" value="Other">{{__('msg.other')}}
                                          </label>
                                       </div>
                                       <br/>
                                       <div class="form-group mt-1">
                                          <input type="checkbox" name="is_default" class=" mt-1" />
                                          <label class="control-label" for="default-address"> {{__('msg.set_as_default_address')}}</label>
                                       </div>
                                       <div class="form-group">
                                          <button type="submit" class="btn btn-primary btn-block text-uppercase"> {{__('msg.update')}} </button>
                                          <button class="btn btn-primary btn-block text-uppercase AddEditAddressCancel"> {{__('msg.cancel')}} </button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
                  <div class="row padding-bottom {{ count($data['address']) > 0 ? '' : 'visible' }}">
                     <div class="col-md-12" id="addAddress">
                        <div class="bg-white">
                           <div class="section_title d-flex mb-3 align-items-baseline border-bottom pl-0">
                              <h2>
                                 <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block ">{{__('msg.add_new_address')}}</span>
                              </h2>
                           </div>
                           <div class="card-body add-cash-body">
                              <div class="row">
                                 <div class="col-lg-12 col-md-12">
                                    <form action="{{ route('address-add') }}" id='formAddAddress' method='POST'>
                                       <input type="hidden" name="latitude" value="0">
                                       <input type="hidden" name="longitude" value="0">
                                       <input type="hidden" name="country_code" value="0">
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label class="">{{__('msg.name')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="card-inputfield" name="name" type="text" placeholder="Name" required>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.mobile_no')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control card-inputfield" id='addPhone' type="number" placeholder="Mobile No" name="mobile" required>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <br/>
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.alternate_mobile_no')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="number" placeholder="Altername Mobile No" name="alternate_mobile">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group mt-1">
                                                <label>{{__('msg.address')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="text" placeholder="Address" name="address" required>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <br/>
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.landmark')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="text" placeholder="Landmark" name="landmark" required>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                               <label>{{__('msg.select_city')}}</label>
                                               <br>
                                               <select name='city' class="form-control" required>
                                               </select>
                                             </div>
                                         </div>
                                       </div>
                                       <br/>
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.select_area')}}</label>
                                                <br>
                                                <select name='area' class="form-control" required></select>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                <label>{{__('msg.pincode')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <select name='pincode' class="form-control" required></select>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <br/>
                                       <div class="row">
                                          <div class="col-md-6 col-12">
                                              <div class="form-group mt-1">
                                                <label>{{__('msg.state')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="text" name="state" required placeholder="State">
                                                   </div>
                                                </div>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group mt-1">
                                                   <label>{{__('msg.country')}}</label>
                                                <div class="ui search focus">
                                                   <div class="ui left icon input card-detail-desc">
                                                      <input class="form-control" type="text" name="country" required placeholder="Country">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <br/>
                                       <div class="form-group mt-1">
                                          <label class="radio-inline">
                                             <input class="mr-2 " type="radio" name="type" value="Home" checked>{{__('msg.home')}}
                                          </label>
                                          <label class="radio-inline  ml-5">
                                             <input class="mr-2" type="radio" name="type" value="Work">{{__('msg.work')}}
                                          </label>
                                          <label class="radio-inline  ml-5">
                                             <input class="mr-2" type="radio" name="type" value="Other">{{__('msg.other')}}
                                          </label>
                                       </div>
                                       <div class="form-group mt-1 mb-4 mt-3">
                                          <input type="checkbox" name="is_default" class=" mt-1" />
                                          <label class="control-label" for="default-address"> {{__('msg.set_as_default_address')}}</label>
                                       </div>
                                       <div class="form-group">
                                          <button type="submit" class="btn btn-primary btn-block text-uppercase"> {{__('msg.add_new_address')}} </button>
                                          <button class="btn btn-primary btn-block text-uppercase AddEditAddressCancel"> {{__('msg.cancel')}} </button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<script src="{{ theme('js/select2.min.js') }}"></script>
<script src="{{ asset('js/address.js') }}"></script>
