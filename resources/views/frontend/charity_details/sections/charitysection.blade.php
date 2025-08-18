<!--Service Details Start-->
<section class="service-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                @if(isset($charity) && $charity)
                {{-- Single charity display when accessed by ID --}}
                <div class="service-details__left">
                    <div class="service-details__img">
                        <img src="{{asset('public/uploads/donate/'.$charity->image)}}" alt="{{$charity->title}}">
                    </div>
                    <div class="service-details__content">
                        <h3 class="service-details__title-1">Our Charity</h3>
                        <p class="service-details__text-1">{!! $charity->title !!}</p>
                        <p class="service-details__text-2">{!! $charity->description !!}</p>

                    </div>
                </div>
                
                @elseif(isset($donates) && $donates->count() > 0)
                {{-- Multiple charities display for listing page --}}
                @foreach($donates as $index => $charity)
                <div class="service-details__left">
                    <div class="service-details__img">
                        <img src="{{asset('public/uploads/donate/'.$charity->image)}}" alt="{{$charity->title}}">
                    </div>
                    <div class="service-details__content">
                        <h3 class="service-details__title-1">{{$charity->title}}</h3>
                        <p class="service-details__text-1">{!! $charity->title !!}</p>
                        <p class="service-details__text-2">{!! $charity->description !!}</p>
                        
                        <div class="mt-4">
                            <a href="{{route('charity.details', $charity->id)}}" class="btn btn-primary">
                                Read More & Donate
                            </a>
                        </div>
                    </div>
                </div>
                
                @if(!$loop->last)
                <hr class="my-5">
                @endif
                @endforeach
                
                @else
                {{-- No data found --}}
                <div class="service-details__left">
                    <div class="service-details__content">
                        <h3 class="service-details__title-1">No Charity Found</h3>
                        <p class="service-details__text-1">Sorry, no charity information is available at the moment.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!--Service Details End-->