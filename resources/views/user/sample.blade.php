<x-user.layout :studs="$students" :notifs="$notifications">

<div class="container px-4 mx-auto ">
    <br><br><br>
    <br><br><br>
    <div class="h-screen flex w-full">
        <div class="h-5/6 w-1/3 bg-zinc-50 rounded-lg p-4 mx-2">
            {!! $calChart->container() !!}
        </div>

        <div class="h-5/6 w-1/3 bg-zinc-50 rounded-lg p-4 mx-2">
            {!! $fatChart->container() !!}
        </div>

        <div class="h-5/6 w-1/3 bg-zinc-50 rounded-lg p-4 mx-2">
            {!! $satFatChart->container() !!}
        </div>
    </div>
    <div class="h-screen flex">
        <div class="h-5/6 w-1/3 bg-zinc-50 rounded-lg p-4 mx-2">
            {!! $sodiumChart->container() !!}
        </div>
        <div class="h-5/6 w-1/3 bg-zinc-50 rounded-lg p-4 mx-2">
            {!! $sugarChart->container() !!}
        </div>
    </div>
    


</div>

{{-- Calorie Chart --}}
<script src="{{ $calChart->cdn() }}"></script>

{{ $calChart->script() }}

{{-- Fat Chart Chart --}}
<script src="{{ $fatChart->cdn() }}"></script>

{{ $fatChart->script() }}

{{-- SatFat Chart Chart --}}
<script src="{{ $satFatChart->cdn() }}"></script>

{{ $satFatChart->script() }}

{{-- Sugar Chart Chart --}}
<script src="{{ $sugarChart->cdn() }}"></script>

{{ $sugarChart->script() }}

{{-- Sodium Chart Chart --}}
<script src="{{ $sodiumChart->cdn() }}"></script>

{{ $sodiumChart->script() }}


</x-user.layout>