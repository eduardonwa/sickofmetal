<!-- Sidebar Section -->
<aside class="md:flex md:row-start-2 md:col-start-2 lg:flex-col lg:mx-auto lg:row-start-1 lg:col-start-5 lg:col-end-6">
    <div class="w-full bg-white shadow flex flex-col lg:flex my-4 p-6">
        <p class="text-2xl font-semibold pb-5 italic">
            {{ \App\Models\TextWidget::getTitle('youtube-sidebar') }}
        </p>
        <div class="shadow-xl">
            <x-youtube/>
        </div>
        <a href="https://www.youtube.com/channel/UC-75GKva0z3_s9Hf-BhIMMQ?sub_confirmation=1" class="w-full bg-black text-white font-bold text-sm uppercase rounded hover:bg-red-700 transition ease-in-out flex items-center justify-center px-2 py-3 mt-4">
            SUBSCRIBE
        </a>
    </div> <!-- YouTube end -->

    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <p class="text-2xl font-semibold pb-5">Instagram</p>
        <div class="grid grid-cols-3 gap-3">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=1">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=2">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=3">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=4">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=5">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=6">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=7">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=8">
            <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=9">
        </div>
        <a href="#" class="w-full bg-black text-white font-bold text-sm uppercase rounded hover:bg-red-700 transition ease-in-out flex items-center justify-center px-2 py-3 mt-6">
            <i class="fab fa-instagram mr-2"></i> Follow @SickOfMetal
        </a>
    </div> <!-- Instagram end -->
</aside>
<!-- Sidebar section end -->
