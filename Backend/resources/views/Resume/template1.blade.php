<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{ asset('../../../css/app.css') }}"> --}}
    @vite('resources/css/app.css')
</head>

<body>
    @if ($resumes)
        <div class="flex flex-wrap w-full p-4">
            @foreach ($resumes as $resume)
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
                                    @if ($item1->duties->count() > 0)
                                        @foreach ($item1->duties as $item)
                                            <li class="my-1.5">
                                                {{ $item->name }}
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex w-full text-base my-2">
                        <h3 class="text-lg font-semibold flex-auto">Skills</h3>

                    </div>
                    <hr>
                    @if ($resume->skills != '')
                        <ul
                            class="mx-auto grid max-w-6xl  grid-cols-1 gap-1 p-1 sm:grid-cols-2 md:grid-cols-5 lg:grid-cols-5">
                            @foreach ($resume->skills as $item)
                                <div class="text-base p-2 rounded text-black w-full bg-slate-400">
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
                        <div class="gap-5 my-2 w-full grid grid-cols-3">
                            @foreach ($resume->certificates as $item)
                                <div class="">
                                    <div class="col-span-1">
                                        <div class="text-base">
                                            <span>{{ $item->pivot->started . ' To ' }}</span>
                                            @if ($item->pivot->finished == null)
                                            <span>Current</span>
                                            @else
                                            <span>{{ $item->pivot->finished }}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <h3 class="text-base font-semibold">Institution</h3>
                                        <p class="text-base">{{ $item->pivot->school }}</p>
                                    </div>
                                    <div class="col-span-2">
                                        <div class="flex">
                                            <p class="text-base flex-auto">
                                                {{ $item->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="flex w-full text-base my-2 pt-4">
                        <h3 class="text-lg font-semibold flex-auto">Refarrals</h3>
                    </div>
                    <hr>
                    <div class="flex flex-row gap-8">
                        @if ($resume->referrals->count() > 0)
                            @foreach ($resume->referrals as $item)
                                <div class="text-base grid grid-cols-2 w-full">
                                    <div class="cols-span-2"><span>{{ $item->full_name }}</span></div>
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
            @endforeach
        </div>
    @endif
</body>

</html>
