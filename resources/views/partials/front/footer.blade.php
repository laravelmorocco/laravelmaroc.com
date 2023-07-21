<footer class="container-fluid footer">
    <div class="flex flex-wrap">
        <div class="px-4 w-full">
            <div class="xl:text-5xl lg:text-xl md:text-xl sm:text-xl lg-text">have a project<br>for us?</div>
            <div class="normal-text">
                <p>Contact us and we’ll send you the brief form to fill.<br>
                    Then we’ll contact you within 24 hours.</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col text-center pt-4">
        <div class="md:w-1/2 sm:w-full py-4">
            <div class="contact-info-holder">
                <div class="title">{{ __('Call us') }}</div>
                <div class="contact-info">{{ $phone_number }}</div>
            </div>
        </div>
        <div class="md:w-1/2 sm:w-full py-4">
            <div class="contact-info-holder">
                <div class="title">{{ __('E-mail') }}</div>
                <div class="contact-info"><a href="mailto:{{ $email }}">{{ $email }}</a></div>
                {{-- <div class="social-media">
                    <div class="social-link-holder"><a href="#">Dribbble</a></div>
                    <div class="social-link-holder"><a href="#">Instagram</a></div>
                    <div class="social-link-holder"><a href="#">Twitter</a></div>
                    <div class="social-link-holder"><a href="#">Facebook</a></div>
                    <div class="social-link-holder"><a href="#">Whatsapp</a></div>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
<div class="w-full text-center text-black leading-5 py-5 font-normal bg-gray-600">
    <p>{{ $footer_text }}</p>
</div>
<!-- Scripts -->
<script type="text/javascript" src="{{ asset('/js/app.js') }}" defer></script>
<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/vendors.js') }}"></script>

<!-- Toastr -->
{{-- <script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script> --}}
<!-- Custom JS -->
{{-- <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/popper.min.js') }}"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.js" defer></script> --}}
{{-- <script type="text/javascript" src="{{ asset('/js/anime.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/scrollreveal.min.js') }}"></script> --}}


<input type="hidden" id="main_url" value="{{ route('front.inde') }}">

@php
$mainbs = [];
$mainbs['is_announcement'] = $is_announcement;
$mainbs['announcement_delay'] = $announcement_delay;
$mainbs = json_encode($mainbs);
@endphp

<script>
    var mainbs = {!! $mainbs !!};

    $(document).ready(function() {
        // Add smooth scrolling to all links
        $("a").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function() {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });

    $(window).on('load', function(event) {

        if (mainbs.is_announcement == 1) {
            // trigger announcement banner base on sessionStorage
            let announcement = sessionStorage.getItem('announcement') != null ? false : true;
            // console.log(sessionStorage.getItem('announcement'));
            if (announcement) {
                setTimeout(function() {
                    $('.announcement-banner').trigger('click');
                }, mainbs.announcement_delay * 1000);
            }
        }

    });
</script>

{{-- Cookie alert dialog start --}}
{{-- @if ($is_cooki_alert == 1)
		@include('cookieConsent::index')
	@endif --}}
{{-- Cookie alert dialog end --}}
