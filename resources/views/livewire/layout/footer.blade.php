<footer class="grid rounded-t-3xl mt-4 sm:grid-cols-1 md:grid-cols-3">
    <div class="p-4 left">
        <ul class="pl-2 list-none static-links">
            <li><a class="no-underline hover:underline" href="{{ route('about_us') }}">About Us</a></li>
            <li><a class="no-underline hover:underline" href="{{ route('careers') }}">Careers</a></li>
            <li><a class="no-underline hover:underline" href="{{ route('privacy') }}">Privacy Policy</a></li>
            <li><a class="no-underline hover:underline" href="{{ route('toc') }}">Terms and Conditions</a></li>
        </ul>
    </div>

    <div class="grid p-4 right md:col-span-2">
        <div class="copyright">
            <p class="text-white">Chatsmith Online Services Copyright &copy; 2020</p>
        </div>

        <div class="grid gap-4 social-links">
            <a href="https://www.facebook.com/Chatsmithonline" target="_blank"><i class="fa-brands fa-3x fa-facebook"></i></a>
            <a href="https://www.linkedin.com/company/chatsmith-online/about/" target="_blank"><i class="fa-brands fa-3x fa-linkedin"></i></a>
            <a href="https://twitter.com/chatsmithonline" target="_blank"><i class="fa-brands fa-3x fa-twitter"></i></a>
        </div>

        <div class="grid gap-4 affiliates">
            <p class="text-white affiliates-text">Affliates</p>

            <div class="grid affiliates-list sm:grid-cols-1 md:grid-cols-4">
                <a href="https://focal.systems/" target="_blank"><img src="{{ asset('images/logo_focal_systems.png') }}" class="affliate-logos" id="logo-focal-systems" alt="Focal Systems logo" title="Focal Systems page"></a>
                <a href="https://www.persistiq.com/" target="_blank"><img src="{{ asset('images/logo_persistiq.png') }}" class="affliate-logos" id="logo-persistiq" alt="PersistIQ logo" title="PersistIQ page"></a>
                <a href="https://www.plateiq.com/" target="_blank"><img src="{{ asset('images/logo_plateiq.png') }}" class="affliate-logos" id="logo-plateiq" alt="Plate IQ logo" title="Plate IQ page"></a>
                <a href="https://www.smartalto.com/" target="_blank"><img src="{{ asset('images/logo_smart_alto.png') }}" class="affliate-logos" id="logo-smart-alto" alt="Smart Alto logo" title="Smart Alto page"></a>
            </div>
        </div>
    </div>
</footer>
