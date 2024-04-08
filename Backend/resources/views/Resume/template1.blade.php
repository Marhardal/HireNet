<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{ asset('../../../css/app.css') }}"> --}}
    {{-- @vite('resources/css/app.css') --}}
    @vite('resources/css/app.css')
</head>

<body>
    {{-- @dd($resume) --}}
    @if ($resume)
        <div class="flex flex-wrap w-full p-4">
            <div class="flex-1">
                <div class="text-center mx-auto">
                    <h3 class="my-3 text-2xl font-semibold w-full">
                        {{ $resume->user->first_name . ' ' . $resume->user->surname }}
                    </h3>
                    <div class="text-lg font-semibold gap-4 flex justify-center">
                        {{-- <h5>{{ $resume->district . ', ' . $resume->country }}</h5> --}}
                        <h5>{{ $resume->user->phone }}</h5>
                        <h5>{{ $resume->user->email }}</h5>
                    </div>
                </div>
                <div class="flex w-full text-base my-2">
                    <h3 class="text-lg font-semibold flex-auto">Profesional Summary</h3>
                </div>
                <hr class="">
                <p class="my-2 text-base">{{ $resume->summary }}</p>
                <div class="flex w-full text-base my-2">
                    <h3 class="text-lg font-semibold flex-auto">Work History</h3>
                </div>
                <hr>
                <div class="grid grid-cols-4 gap-5">
                    @foreach ($resume->jobs as $item1)
                        <div class="col-span-1">
                            <span class="text-base my-2">{{ $item1->pivot->start }} To </span>
                            @if ($item1->pivot->finish == null)
                                <span>Current</span>
                            @else
                                <span>{{ $item1->pivot->finish }}</span>
                            @endif
                        </div>
                        <div class="col-span-3">
                            <p class="text-base my-2">{{ $item1->name }}</p>
                            {{-- <p class="text-base my-2 cols-span-2">
                                    {{ $item1->employer . ' , ' . $item1->City . ' ' . $item1->country }}
                                </p> --}}
                            <ul class="list-disc ml-4">
                                {!! $item1->pivot->duties !!}
                            </ul>
                        </div>
                    @endforeach
                </div>
                <div class="flex w-full text-base my-2">
                    <h3 class="text-lg font-semibold flex-auto">Skills</h3>

                </div>
                <hr>
                @if ($resume->skills != '')
                    <ul class="mx-auto grid max-w-6xl  grid-cols-5 gap-1 p-1">
                        @foreach ($resume->skills as $item)
                            <div class="text-base p-2 rounded text-black w-full">
                                <li><span>{{ $item->name }}</span></li>
                            </div>
                        @endforeach
                    </ul>
                @endif
                <div class="flex w-full text-base my-2 pt-4">
                    <h3 class="text-lg font-semibold flex-auto">Education</h3>
                </div>
                <hr>
                @if ($resume->certificates != '')
                    <div class="gap-5 my-2 w-full grid grid-cols-2">
                        @foreach ($resume->certificates as $item)
                            <div class="col-span-1">
                                <div class="text-base">
                                    <span>{{ $item->pivot->started . ' To ' }}</span>
                                    @if ($item->pivot->finished == null)
                                        <span>Current</span>
                                    @else
                                        <span>{{ $item->pivot->finished }}</span>
                                    @endif
                                </div>
                                <h3 class="text-base font-semibold">Institution</h3>
                            </div>
                            <div class="col-span-1">
                                <p class="text-base">{{ $item->name }} </p>
                                <p class="text-base">{{ $item->pivot->school }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="flex w-full text-base my-2 pt-4">
                    <h3 class="text-lg font-semibold flex-auto">Refarrals</h3>
                </div>
                <hr>
                <div class="grid grid-cols-3">
                    @if ($resume->referrals->count() > 0)
                        @foreach ($resume->referrals as $item)
                            <div class="text-base w-full">
                                <div class=""><span>{{ $item->full_name }}</span></div>
                                <div class="">
                                    <span>{{ $item->organisation }}</span>
                                </div>
                                <div class=""><span>Phone: {{ $item->phone }}</span></div>
                                <div class=""><span>Email: {{ $item->email }}</span></div>
                            </div>
                        @endforeach
                    @else
                        <p class="trxt-base">Please Insert Referrals</p>
                    @endif
                </div>
            </div>
        </div>
    @endif
</body>

</html>
