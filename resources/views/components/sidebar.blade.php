<!-- Sidebar Section -->
<aside class="md:flex md:row-start-2 md:col-start-2 md:col-end-5 lg:flex-col lg:mx-auto lg:row-start-1 lg:col-start-5 lg:col-end-6">
    <div class="w-full bg-charcoal dark:bg-zinc-800 lg:bg-white dark:lg:bg-zinc-800 shadow flex flex-col lg:flex p-6">
        <p class="text-2xl font-black pb-5 italic text-gray-100 lg:text-slate-900 dark:lg:text-zinc-400 dark:sick-text">
            {{ \App\Models\TextWidget::getTitle('youtube-sidebar') }}
        </p>
        <div class="shadow-xl">
            <x-youtube/>
        </div>
        <a href="https://www.youtube.com/channel/UC-75GKva0z3_s9Hf-BhIMMQ?sub_confirmation=1" class="w-full text-white font-bold text-sm uppercase rounded bg-black hover:sick-text transition ease-in-out flex items-center justify-center px-2 py-3 mt-4">
            SUBSCRIBE
        </a>
    </div> <!-- YouTube end -->

    <div class="w-full bg-charcoal dark:bg-zinc-800 lg:bg-white dark:lg:bg-zinc-800 shadow flex flex-col p-6">
        <p class="text-2xl font-black pb-5 text-gray-100 lg:text-slate-900 dark:lg:text-zinc-400 dark:sick-text">Instagram</p>
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
        <a href="https://www.instagram.com/sickofmetalnet/" class="w-full text-white font-bold text-sm uppercase rounded bg-black hover:sick-text transition ease-in-out flex items-center justify-center px-2 py-3 mt-6">
            <i class="fab fa-instagram mr-2"></i> Follow @SickOfMetalNet
        </a>
    </div> <!-- Instagram end -->
</aside>
<!-- Sidebar section end -->
