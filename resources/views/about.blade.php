<x-app-layout meta-title="Sick of Metal Blog - About" :meta-description="'Sick Of Metal blog for the metalhead with rock and heavy metal news and much more'">
    <div class="md:col-start-2 md:col-end-5">
        <div class="space-y-3 text-center flex flex-col justify-center items-center py-12">
            <img class="w-4/5" src="{{ \App\Models\TextWidget::getImage('about') }}" alt="" srcset="">
            <p class="text-lg font-bold text-gray-600">
                {{ \App\Models\TextWidget::getTitle('about') }}
            </p>
            <p class="text-lg text-gray-600">
                {!! \App\Models\TextWidget::getContent('about') !!}
            </p>
            <a href="https://www.youtube.com/channel/UC-75GKva0z3_s9Hf-BhIMMQ?sub_confirmation=1" 
                class="w-44 bg-red-600 text-white font-bold text-lg uppercase rounded hover:bg-red-700 flex items-center justify-center px-2 py-3 mt-4">
                SUBSCRIBE
            </a>
        </div> 
    </div>
</x-app-layout>