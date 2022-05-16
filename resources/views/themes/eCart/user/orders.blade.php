<!-- breadcumb -->
<section class="page_title corner-title overflow-visible ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>{{__('msg.my_orders')}}</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('my-account') }}">{{__('msg.my_account')}}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{__('msg.my_orders')}}
                    </li>
                </ol>
                <div class="divider-15 d-none d-xl-block"></div>
            </div>
        </div>
    </div>
</section>
<!-- eof breadcumb -->
<div class="order_track_page main-content">
    <section class="checkout-section ptb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div id="data-step1" class="account-content" data-temp="tabdata">
                        <div id="form-print" class="admission-form-wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="heading-part heading-bg mb-30 px-2 py-4 px-md-4 py-md-3 bg-white shadow rounded">
                                        <h2 class="heading m-0">{{__('msg.my_orders')}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-right">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        @if(isset($data['list']['data']) && isset($data['list']['data']) && count($data['list']['data']))
                                        @foreach($data['list']['data'] as $w)
                                        @if(isset($w->items) && is_array($w->items) && count($w->items))
                                        @foreach($w->items as $itm)
                                        @if(isset($itm->id) && intval($itm->id))
                                        <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow rounded mb-4">
                                            <div class="dash-bg-right-title">
                                                <h6>{{__('msg.ordered_id')}} : {{ $itm->order_id ?? '-'}}</h6>
                                                <h6>{{__('msg.order_date')}} :  {{ isset($itm->date_added) ? date('d-m-Y', strtotime($itm->date_added)) : '' }}</h6>
                                            </div>
                                            <div class="order-dashboard">
                                                <ul class="order-dash-desc">
                                                    <li>
                                                        <div class="order-img">
                                                            <img class="lazy" data-original="{{ $itm->image }}" alt="{{ $itm->name ?? 'Product Image'}}">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="order-desc">
                                                            <h4>{{ $itm->name }}</h4>
                                                            <p>{{__('msg.qty')}} : {{ $itm->quantity }}</p>
                                                            <p>{{ get_price($itm->sub_total) }}</p>
                                                            <p>{{__('msg.via')}} : {{ strtoupper($w->payment_method) }}</p>
                                                            @php
                                                            $orderColor='';
                                                            if($itm->active_status == "received"){
                                                            $orderColor = 'received_status_bg';
                                                            }elseif($itm->active_status == "processed"){
                                                            $orderColor = 'awaiting_status_bg';
                                                            }elseif($itm->active_status == "shipped"){
                                                            $orderColor = 'shipped_status_bg';
                                                            }elseif($itm->active_status == "delivered"){
                                                            $orderColor = 'delivered_status_bg';
                                                            }elseif($itm->active_status == "cancelled"){
                                                            $orderColor = 'returned_and_cancel_status_bg';
                                                            }elseif($itm->active_status == "returned"){
                                                            $orderColor = 'returned_and_cancel_status_bg';
                                                            }
                                                            @endphp
                                                            <p class="order__status {{$orderColor}}">{{ strtoupper($itm->active_status) }}</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                @if(count($itm->status))
                                                @php
                                                $orderPlaced = "";
                                                $orderAwaiting_payment = "";
                                                $orderProcessed = "";
                                                $orderShipped = "";
                                                $orderDelivered = "";
                                                $orderCancelled = "";
                                                $orderReturned = "";
                                                foreach($itm->status as $s){
                                                if($s[0] == "received"){
                                                $orderPlaced = $s[1];
                                                }elseif($s[0] == "awaiting_payment"){
                                                $orderAwaiting_payment = $s[1];
                                                }elseif($s[0] == "processed"){
                                                $orderProcessed = $s[1];
                                                }elseif($s[0] == "shipped"){
                                                $orderShipped = $s[1];
                                                }elseif($s[0] == "delivered"){
                                                $orderDelivered = $s[1];
                                                }elseif($s[0] == "cancelled"){
                                                $orderCancelled = $s[1];
                                                }elseif($s[0] == "returned"){
                                                $orderReturned = $s[1];
                                                }
                                                }
                                                @endphp
                                                <div class="track-order">
                                                    <h4>{{__('msg.track_order')}}</h4>
                                                    <div class="bs-wizard">
                                                        @if($orderPlaced != "")
                                                        <div class="bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_placed')}}</div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderPlaced)) }}</div>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date('h:i:s A', strtotime($orderPlaced)) }}</div>
                                                        </div>
                                                        @endif
                                                        @if($orderAwaiting_payment != "")
                                                        <div class="bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.awaiting_payment')}}</div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderPlaced)) }}</div>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date('h:i:s A', strtotime($orderPlaced)) }}</div>
                                                        </div>
                                                        @endif
                                                        @if($orderProcessed != "")
                                                        <div class="bs-wizard-step complete">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_processed')}}</div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderProcessed)) }}</div>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderProcessed)) }}</div>
                                                        </div>
                                                        @elseif($orderCancelled == "")
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_processed')}}
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="#"  class="bs-wizard-dot"></a>
                                                        </div>
                                                        @endif
                                                        @if($orderShipped != "")
                                                        <div class="bs-wizard-step complete">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_shipped')}}</div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderShipped)) }}</div>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderShipped)) }}</div>
                                                        </div>
                                                        @elseif($orderCancelled == "")
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_shipped')}}</div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        @endif
                                                        @if($orderDelivered != "")
                                                        <div class="bs-wizard-step complete">
                                                            <!-- active -->
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_delivered')}}
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderDelivered)) }}</div>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderDelivered)) }}</div>
                                                        </div>
                                                        @elseif($orderCancelled == "")
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_delivered')}}</div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        @endif
                                                        @if ($orderCancelled != '')
                                                        <div class="bs-wizard-step complete">
                                                            <!-- active -->
                                                            <div class="text-center bs-wizard-stepnum">
                                                                {{ __('msg.order_cancelled') }}
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted">
                                                                {{ date('d-m-Y', strtotime($orderCancelled)) }}
                                                            </div>
                                                            <div class="bs-wizard-info text-center text-muted">
                                                                {{ date('h:i:s A', strtotime($orderCancelled)) }}
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($itm->applied_for_return == true)
                                                        @if($orderReturned != "")
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- active -->
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_returned')}}
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderDelivered)) }}</div>
                                                            <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderDelivered)) }}</div>
                                                        </div>
                                                        @elseif($orderCancelled == "")
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum">{{__('msg.order_returned')}}</div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="call-bill">
                                                    <div class="delivery-man">
                                                    </div>
                                                    <div class="order-bill-slip">
                                                        <a href="{{ route('order-track-item', $w->id ?? 0) }}" class="bill-btn hover-btn">{{__('msg.view_details')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @else
                                        <div class="row text-center">
                                            <div class="col-12">
                                                <br><br>
                                                <h3>{{__('msg.no_orders_found')}}.</h3>
                                            </div>
                                            <div class="col-12">
                                                <br><br>
                                                <a href="{{ route('shop') }}" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em> {{__('msg.continue_shopping')}}</a>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row mt-3">
                                            <div class="col">
                                                @if(isset($data['last']) && $data['last'] != "")
                                                <a href="{{ $data['last'] }}" class="btn btn-primary pull-left"><em class="fa fa-arrow-left"></em> {{__('msg.previous')}}</a>
                                            </div>
                                            </a>
                                            @endif
                                            <div class="col text-end">
                                                @if(isset($data['next']) && $data['next'] != "")
                                                <a href="{{ $data['next'] }}" class="btn btn-primary pull-right">{{__('msg.next')}} <em class="ml-2 fa fa-arrow-right"></em></a>
                                            </div>
                                            @endif
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