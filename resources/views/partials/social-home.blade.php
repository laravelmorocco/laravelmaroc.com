<button id="share"
    class="cursor-pointer h-14 w-14 rounded-full  hover:bg-blue-700 bg-blue-500 flex items-center justify-center focus:outline-none">
    <i class='fas fas-share-alt text-2xl text-white'></i>
</button>
<div id="share_icons" class="absolute opacity-0">
    <span
        class="absolute flex items-center justify-center h-8 w-8 rounded-full bg-blue-500 text-white -top-14 left-8 cursor-pointer">
        <i class="fab fa-twitter"></i>
    </span>
    <span
        class="absolute flex items-center justify-center h-8 w-8 rounded-full bg-blue-500 text-white -top-4 left-12 cursor-pointer">
        <i class="fab fa-facebook"></i>
    </span>
    <span
        class="absolute flex items-center justify-center h-8 w-8 rounded-full bg-blue-500 text-white top-6 left-8 cursor-pointer">
        <i class="fab fa-linkedin"></i>
    </span>
</div>



@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById("share").onclick = function() {
                var share_icons = document.querySelector("#share_icons");
                check_opacity = share_icons.classList.contains('opacity-0');
                if (check_opacity) {
                    share_icons.classList.remove('opacity-0');
                    share_icons.classList.add('opacity-1');
                } else {
                    share_icons.classList.remove('opacity-1');
                    share_icons.classList.add('opacity-0');
                }
            };

        });
    </script>
@endpush
