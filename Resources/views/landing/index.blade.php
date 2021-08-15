@extends('qamus::landing.layouts.app')
@section('title', 'Home')
@section('mLanding', 'active')

@section('content')
    
    <div class="uk-height-medium uk-background-cover uk-light p-0" data-src="{{ asset('assets/qamus/img/header-1.png') }}" uk-img>
        <div uk-grid class="mb-20">
            <div class="uk-width-expand@m">
                <div class="p-4 rounded-md" style="background: #1c90bc;">
                    <div class="kx-judul">
                        <h2 class="text-6xl text-white font-bold mb-2" style="letter-spacing: -3px"><b>{{ config('qamus.name') }}</b></h2>
                        <p class="font-small text-white text-lg">
                            {!! config('qamus.tagline') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-4@m"></div>
        </div>
        <br/>
        <div uk-grid class="mt-20">
            <div class="uk-width-expand@m mt-2">
                <br/>
                {!! Form::open(['route' => 'kamus.redirect', 'method' => 'GET', 'class' => 'bt-form mt-10']) !!}
                    <h5 class="font-semibold text-sm text-gray-400 mb-2 ml-1 uppercase">
                        Cari tahu arti kata <span class="text-red-500">*</span>
                    </h5>
                    <div uk-grid class="uk-grid-collapse bg-white p-1 rounded-md">
                        <div class="uk-width-expand@m">
                            {!! Form::text('query', null, ['class' => 'bt-input', 'placeholder' => 'Ketikkan sesuatu ...', 'required', 'style' => 'border-radius: 4px 0 0 4px;']) !!}
                        </div>
                        <div class="uk-width-1-5@m">
                            {!! Form::select('language', \Modules\Qamus\Entities\Bahasa::pluck('nama', 'kode'), null, ['class' => 'bt-input', 'style' => 'margin-left: -2px;border-radius: 0;background: #e4e7eb;']) !!}
                        </div>
                    </div>
                    {!! $errors->first('name', '<p class="text-xs text-red-500 mt-1 ml-2">:message</p>') !!}

                    <p class="mt-2 font-small text-xs text-gray-400 ml-1">
                        Hasil pencarian hanya terbatas merujuk pada database internal kami saja.<br/>
                        Kami tidak terkoneksi dengan Pusat Pembinaan dan Pengembangan Bahasa RI.
                    </p>
                {!! Form::close() !!}
            </div>
            <div class="uk-width-1-4@m"></div>
        </div>
    </div>

    <br/><br/><br/>

    @php
        $counters = [
            [
                'value' => Modules\Qamus\Entities\Bahasa::count(),
                'title' => 'Bahasa Daerah',
                'img' => asset('assets/qamus/img/feature-1.png')
            ],
            [
                'value' => Modules\Qamus\Entities\Makna::count(),
                'title' => 'Terjemahan',
                'img' => asset('assets/qamus/img/feature-3.png')
            ],
            [
                'value' => Modules\Qamus\Entities\Makna::whereNotNull('audio')->count() + Modules\Qamus\Entities\Contoh::whereNotNull('audio')->count(),
                'title' => 'Rekaman Audio',
                'img' => asset('assets/qamus/img/feature-2.png')
            ],
            [
                'value' => Modules\Qamus\Entities\Contoh::count(),
                'title' => 'Contoh Kalimat',
                'img' => asset('assets/qamus/img/feature-4.png')
            ],
        ];
    @endphp

    <div class="grid md:grid-cols-4 grid-cols-3 divide divide-gray-200 gap-x-6 mb-10">
        @foreach($counters as $count)
            <div class="text-center">
                <div class="flex uk-flex-center">
                    <img src="{{ $count['img'] }}" class="h-32 w-32 mb-3">
                </div>
                <h2 class="text-4xl font-bold">{{ $count['value'] }}</h2>
                <p class="text-gray-400 font-medium">{{ $count['title'] }}</p>
            </div>
        @endforeach
    </div>

    <br/><br/>

    <div uk-grid>
        <div class="uk-width-expand@m">
            <h2 class="text-3xl font-bold mb-3 mt-10">Pahami Pengucapannya</h2>
            <p class="text-lg text-small text-gray-400 mb-3">Beberapa bahasa memiliki tata bahasa yang rumit. Kami membantu Anda untuk dapat mengetahui cara pelafalannya melalui Audio.</p>
            <div>
              <div class="flex items-center space-x-4 -mx-2 p-2">
                  <div class="w-14 h-14 flex-shrink-0 rounded-md relative mr-3"> 
                      <svg xmlns="http://www.w3.org/2000/svg" class="fill-current icon-features" viewBox="0 0 100 100"><rect width="100" height="100" rx="35" style="opacity:0.1"></rect><path d="M50,28.52A21.48,21.48,0,1,1,28.52,50,21.5,21.5,0,0,1,50,28.52m0-6A27.5,27.5,0,1,0,77.5,50,27.5,27.5,0,0,0,50,22.5Z"></path><path d="M38.73,61.23l8-24.77h7.33L62,61.23H55.59L54,55.55H46.34l-1.62,5.68Zm11.35-19.4-2.63,9.39h5.47l-2.57-9.39Z"></path></svg>
                  </div>
                  <div class="flex-1">
                      <h3 class="text-lg font-bold">Frasa</h3>
                      <div class="text-sm text-gray-400 -mt-0.5">Pengucapan berdasarkan kata/frasa yang di pilih.</div>
                  </div>
              </div>
              <div class="flex items-center space-x-4 -mx-2 p-2">
                  <div class="w-14 h-14 flex-shrink-0 rounded-md relative mr-3"> 
                      <svg xmlns="http://www.w3.org/2000/svg" class="fill-current icon-features" viewBox="0 0 100 100"><rect width="100" height="100" rx="35" style="opacity:0.10"></rect><path d="M50,25A25,25,0,0,0,28.38,37.5h6.11a20.09,20.09,0,0,1,8.6-6.25A33.37,33.37,0,0,0,41.2,37.5h5.14C47.54,32.56,49.22,30,50,30s2.46,2.56,3.66,7.5H58.8a33.37,33.37,0,0,0-1.89-6.25,20.15,20.15,0,0,1,8.6,6.25h6.11A25,25,0,0,0,50,25ZM22.5,42.5l3.11,15h3.27L31,48.82l2.12,8.68h3.26l3.1-15H35.72l-1.34,8.41-2-8.41H29.6l-2,8.43L26.27,42.5Zm19,0,3.1,15h3.28L50,48.82l2.12,8.68h3.26l3.1-15H54.74l-1.35,8.41-2-8.41H48.61l-2,8.43L45.28,42.5Zm19,0,3.1,15h3.27L69,48.82l2.12,8.68h3.25l3.11-15H73.74L72.4,50.91l-2-8.41H67.62l-2,8.43L64.29,42.5Zm-32.14,20a24.95,24.95,0,0,0,43.24,0H65.51a20.09,20.09,0,0,1-8.6,6.25,33.38,33.38,0,0,0,1.88-6.25H53.65C52.45,67.44,50.78,70,50,70s-2.46-2.56-3.66-7.5H41.2a33.37,33.37,0,0,0,1.89,6.25,20.15,20.15,0,0,1-8.6-6.25Z"></path></svg>
                  </div>
                  <div class="flex-1">
                      <h3 class="text-lg font-bold">Kalimat</h3>
                      <div class="text-sm text-gray-400 -mt-0.5">Pengucapan berdasarkan kalimat dari contoh frasa yang di pilih.</div>
                  </div>
              </div>
          </div>

        </div>
        <div class="uk-width-1-2@m">
            <img src="{{ asset('assets/qamus/img/landing-1.jpg') }}">
        </div>
    </div>

    <br/><br/>

    <div uk-grid>
        <div class="uk-width-1-3@m">
            <img src="{{ asset('assets/qamus/img/landing-2.png') }}">
        </div>
        <div class="uk-width-expand@m">
            <h2 class="text-3xl font-bold mb-3">Pahami Melalui Gambar</h2>
            <p class="text-lg font-small mb-3 text-gray-400">Sebuah gambar bermakna ribuan kata. Itu sebabnya kami menampilkan gambar untuk banyak kata.</p>
        </div>
    </div>

    <br/><br/>

@endsection