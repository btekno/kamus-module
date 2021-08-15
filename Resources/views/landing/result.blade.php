@extends('qamus::landing.layouts.app')
@section('title', "Hasil Pencarian: $query")

@section('css')
	<style type="text/css">
		.kamus-text {
			color: #d570ab!important;
		}
	</style>
@endsection

@section('js')
	<script type="text/javascript">
		var OBROLIN_DOMAIN = 'https://obrolin.komix.xyz';
		var OBROLIN_UNIQUE = '{{ request()->fullUrl() }}';

		(function() { // DON'T EDIT BELOW THIS LINE
			var d = document.createElement('script');
			d.type = 'text/javascript';
			d.async = true;
			d.src = OBROLIN_DOMAIN + '/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(d);
		})();
	</script>
@endsection

@section('content')

    {!! Form::open(['route' => 'kamus.redirect', 'method' => 'GET', 'class' => 'bt-form mt-10 mb-10']) !!}
        <h5 class="font-semibold text-sm text-gray-400 mb-2 ml-1 uppercase">
            Cari tahu arti kata <span class="text-red-500">*</span>
        </h5>
        <div uk-grid class="uk-grid-collapse">
            <div class="uk-width-expand@m">
                {!! Form::text('query', null, ['class' => 'bt-input', 'placeholder' => 'Ketikkan sesuatu ...', 'required', 'style' => 'border-radius: 4px 0 0 4px;']) !!}
            </div>
            <div class="uk-width-1-5@m">
                {!! Form::select('language', \Modules\Qamus\Entities\Bahasa::pluck('nama', 'kode'), $query, ['class' => 'bt-input', 'style' => 'margin-left: -2px;border-radius: 0;background: #e4e7eb;']) !!}
            </div>
            <div class="uk-width-1-5@m">
                <button type="submit" class="border-2 py-2 px-5 bg-red-500 text-white font-semibold" style="margin-left: -3px;
                    padding: 10px 25px;
                    border-radius: 0 4px 4px 0;
                    border: 1px solid #e4e7eb;
                    background: #d570ab">
                    <i class="uil-search"></i> TERJEMAHKAN
                </button>
            </div>
        </div>
        {!! $errors->first('name', '<p class="text-xs text-red-500 mt-1 ml-2">:message</p>') !!}

        <p class="mt-3 font-small text-xs text-gray-400 ml-1">
            Hasil pencarian hanya terbatas merujuk pada database internal kami saja.<br/>
            Kami tidak terkoneksi dengan Pusat Pembinaan dan Pengembangan Bahasa Republik Indonesia.
        </p>
    {!! Form::close() !!}
	
	<div class="lg:flex lg:space-x-10 mb-10">    
        <div class="lg:w-3/4"> 

        	<div class="bg-white rounded-md shadow-sm border p-0 mb-3">
				<div class="px-5 pt-5">
					<h2 class="font-semibold text-xl mb-0 kamus-text">
						<b>"{{ $query }}"</b> dalam Bahasa Indonesia
					</h2>
				</div>
				<hr class="mt-5">
				<div class="px-5 py-4">
					<p class="mb-0 text-xs font-semibold text-gray-400">FRASA</p>
                	<h5 class="mb-0 text-xl text-black"><b>{{ $result ? $result->kata : $query }}</b></h5>
                	<hr class="mt-2 mb-2">
                	<p class="text-xs text-gray-400">Terjemahan dalam kamus <b>{{ $bahasa->nama }} - Indonesia</b></p>

                	@if(!$result)
                		<h4 class="mb-3 text-danger">Tidak (belum) ada terjemahan</h4>

                		<p class="mb-0 text-muted small">
                			Kamu bisa berkontribusi terhadap kata <b>"{{ $query }}"</b> apabila kamu tahu terjemahan dari <b>Bahasa {{ $bahasa->nama }}</b> ke <b>Bahasa Indonesia</b>.<br/>
                			<a href="javascript:;" onclick="$('#addTranslate').show(500)"><b>Klik di sini</b></a> untuk berkontribusi.
                		</p>

                	@else
                		<h3 class="mb-10 mt-3">
                			<b class="text-3xl text-green-500">{{ $result->terjemahan }}</b>
                		</h3>
                		<p class="mb-0 text-gray-500 text-xs" style="text-align: right;">
                			Kontributor {{ '@'.optional($result->user)->username }}
                		</p>
                		<p class="mb-0 text-gray-400 text-xs">
                			Terjemahan kata ini tidak tepat? Laporkan dan usulkan perbaikan.<br/>
                			@auth
                				<a href="javascript:;" onclick="$('#addTranslate').show(500)"><b>Klik di sini</b></a> 
                			@else
                				<a href="{{ route('login') }}?redirect={{ request()->fullUrl() }}"><b>Klik di sini</b></a> 
                			@endauth
                			untuk berkontribusi.
                		</p>
                	@endif

					<div class="card mt-3" id="addTranslate" style="display: none;">
						{!! Form::open(['class' => 'card-body', 'route' => 'kamus.kontribusi.kata.store', 'files' => true]) !!}
							<button type="button" class="close" onclick="$('#addTranslate').hide(500)">
								<span aria-hidden="true">&times;</span>
							</button>
							<h6 class="card-subtitle mb-0 text-muted">
								<b>Tambah Frasa</b>
							</h6>
							<p class="text-muted mb-0">
								<small>Terjemahan dalam kamus <b>{{ $bahasa->nama }} - Indonesia</b></small>
							</p>

							<hr/>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="frasa" class="mb-0 text-muted">
											<b><small>Frasa dalam {{ $bahasa->nama }} <span class="text-danger">*</span></small></b>
										</label>
										{!! Form::text('frasa', request()->segment(3) ? ucfirst(request()->segment(3)) : null, ['class' => 'form-control', 'required', $result && $result->verified == 1 ? 'readonly' : '']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="frasa_indo" class="mb-0 text-muted">
											<b><small>Frasa dalam Indonesia <span class="text-danger">*</span></small></b>
										</label>
										{!! Form::text('frasa_indo', $result ? $result->terjemahan : null, ['class' => 'form-control', 'required']) !!}
										<small class="form-text text-muted">
											<small>Silahkan pisahkan dengan koma, bila memiliki arti lebih dari satu.</small>
										</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="audio" class="mb-0 text-muted">
											<b><small>Audio (Pelafalan)</small></b>
										</label>
										
										{!! Form::file('audio', ['class' => 'form-control', 'style' => 'height: calc(1.5em + 1.15rem + 2px)']) !!}
										<small class="form-text text-muted">
											<small>Pilih file WAV atau MP3 yang lebih kecil dari 2 MB.</small>
										</small>
									</div>

									<div class="form-group">
										<label for="gambar" class="mb-0 text-muted">
											<b><small>Gambar</small></b>
										</label>
										{!! Form::file('gambar', ['class' => 'form-control', 'style' => 'height: calc(1.5em + 1.15rem + 2px)']) !!}
										<small class="form-text text-muted">
											<small>Pilih file PNG atau JPEG yang lebih kecil dari 2 MB.</small>
										</small>
									</div>
								</div>
							</div>
							<br/>
							<button type="reset" class="btn default text-dark">Batal</button>
							<button type="submit" class="btn btn-primary">Kirim</button>
							
							{!! Form::hidden('bahasa_id', $bahasa->id) !!}
							@if($result)
								{!! Form::hidden('edited', true) !!}
							@endif

						{!! Form::close() !!}
					</div>
				</div>
			</div>

            @if($usulan->count())
            	<div class="bg-white rounded shadow-sm border p-0 mb-5">
					<ul uk-accordion class="mb-0">
						<li class="uk-open">
							<a class="uk-accordion-title font-semibold bg-black hover:text-white text-white rounded p-3" href="#" style="border-radius: 0.25rem 0.25rem 0 0;line-height: 20px;">
								Terjemahan Yang Masuk
							</a>
							<div class="uk-accordion-content pb-0 mt-0">
								<table class="table table-sm mb-0" style="width: 100%" border="1">
									<thead>
										<tr class="bg-gray-200">
											<td class="px-2 py-1 font-semibold">Bahasa {{ $bahasa->nama }}</td>
											<td class="px-2 py-1 font-semibold">Bahasa Indonesia</td>
											<td class="px-2 py-1 font-semibold">Gambar</td>
											<td class="px-2 py-1 font-semibold">Kontributor</td>
											<td class="px-2 py-1 font-semibold" width="15%"></td>
											@auth
												@if(auth()->user()->kamus_access)
													<td width="1"></td>
												@endif
											@endauth
										</tr>
									</thead>
									<tbody>
										@foreach($usulan as $temp)
											<tr>
												<td class="px-2 py-1">
													{{ $result ? $result->kata : $query }}
													@if($temp->audio)
														<i class="material-icons icon" style="font-size: 12px;">volume_up</i>
													@endif
												</td>
												<td class="px-2 py-1">{{ $temp->terjemahan }}</td>
												<td class="px-2 py-1">{{ $temp->gambar ? 'View' : '-' }}</td>
												<td class="px-2 py-1 text-gray-400">{{ optional($temp->user)->username }}</td>
												<td class="px-2 py-1">
													@if($temp->verified == 1)
														<small class="text-green-500">Confirmed</small>
													@endif
												</td>
												@auth
												@if(auth()->user()->kamus_access)
													<td class="px-2 py-1" align="right">
														@if($temp->verified == 1)
															<a href="{{ route('kamus.kontribusi.kata.edit', $temp->id) }}" class="text-success">
																<i class="material-icons icon" style="font-size: 16px;">check</i>
															</a>
														@else
															<a href="{{ route('kamus.kontribusi.kata.update', $temp->id) }}" class="text-success" onclick="event.preventDefault();document.getElementById('confirm{{ $temp->id }}').submit();">
																<b><small>Confirm</small></b>
															</a>
															<form id="confirm{{ $temp->id }}" action="{{ route('kamus.kontribusi.kata.update', $temp->id) }}" method="POST" style="display: none;">
																@csrf
																@method('PUT')
															</form>
														@endif
													</td>
												@endif
												@endauth
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</li>
					</ul>
				</div>
			@endif

            @if($result)
                <div class="bg-white rounded-md shadow-sm border p-0 mb-3">
					<div class="px-5 pt-5">
						<h2 class="font-semibold text-xl mb-0 kamus-text">Contoh Kalimat</h2>
					</div>
					<div class="px-5 py-4">
                    	@if(!$result->contoh)
                    		<p>Tidak ada contoh yang ditemukan, pertimbangkan untuk menambahkan lagi.</p>
                    	@else
                    		@foreach($result->contoh as $i => $temp)
                    			<h6>
                    				{!! str_ireplace($result->kata, '<b>' . strtolower($result->kata) . '</b>', $temp->kalimat) !!}
                    			</h6>
		                    	<p class="mb-0 text-muted">
		                    		<small><b>Terjemahan Indonesia:</b> {{ $temp->kalimat_indo }}</small>
		                    	</p>
		                    	<p class="mb-0 text-right text-muted">
	                    			<small><small>
	                    				@if($temp->verified == 1)
	                    					<span class="text-success">Terverifikasi</span> &nbsp;
	                    				@else
	                    					<span class="text-danger">Belum diverifikasi</span> &nbsp;
	                    				@endif
	                    				Ditulis oleh {{ '@'.optional($temp->user)->username }}
	                    			</small></small>
	                    		</p>
	                    		<hr class="mt-0 mb-5">
                    		@endforeach
	                    @endif

	                    <p class="text-gray-400 text-xs">
	                    	Punya contoh kalimat lain untuk kata <b>{{ $query }}</b> ini?<br/>
	                    	
	                    	@auth
                				<a href="javascript:;" onclick="$('#addExample').show(500)"><b>Klik di sini</b></a> 
                			@else
                				<a href="{{ route('login') }}?redirect={{ request()->fullUrl() }}"><b>Klik di sini</b></a> 
                			@endauth
	                    	
	                    	untuk mengusulkan contoh kalimat lain sekarang!
	                    </p>

	                    <div class="card mt-3" id="addExample" style="display: none;">
							{!! Form::open(['class' => 'card-body', 'files' => true, 'route' => ['kamus.kontribusi.kata.contoh.store', $result->id]]) !!}
								<button type="button" class="close" onclick="$('#addExample').hide(500)">
									<span aria-hidden="true">&times;</span>
								</button>
								<h6 class="card-subtitle mb-0 text-muted">
									<b>Tambah Contoh Kalimat</b>
								</h6>
								<p class="text-muted mb-0">
									<small>Silakan tambahkan contoh kalimat. Kalimat harus terdiri dari 4-12 kata dan mewakili bahasa asli.</small>
								</p>

								<hr class="mt-2" />
								
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="kalimat" class="mb-0 text-muted">
												<b><small>Kalimat dalam {{ $bahasa->nama }} <span class="text-danger">*</span></small></b>
											</label>
											{!! Form::text('kalimat', null, ['class' => 'form-control']) !!}
										</div>
										<div class="form-group">
											<label for="kalimat_indo" class="mb-0 text-muted">
												<b><small>Kalimat dalam Indonesia <span class="text-danger">*</span></small></b>
											</label>
											{!! Form::text('kalimat_indo', null, ['class' => 'form-control']) !!}
										</div>
										<div class="form-group">
											<label for="audio" class="mb-0 text-muted">
												<b><small>Audio (Pelafalan)</small></b>
											</label>
											
											{!! Form::file('audio', ['class' => 'form-control', 'style' => 'height: calc(1.5em + 1.15rem + 2px)']) !!}
											<small class="form-text text-muted">
												<small>Pilih file WAV atau MP3 yang lebih kecil dari 2 MB.</small>
											</small>
										</div>
									</div>
								</div>
								<br/>
								<button type="reset" class="btn default text-dark">Batal</button>
								<button type="submit" class="btn btn-primary">Kirim</button>

							{!! Form::close() !!}
						</div>
                    	
                    </div>
                </div>
            @endif

			<div id="obrol_thread"></div> 
        </div>
        <div class="lg:w-1/3 w-full"> 
            <div uk-sticky="media @m ; offset:80 ; bottom : true" class="uk-sticky">
                
            	@if($related->count() > 0)
            		<div class="bg-white rounded-md shadow-sm border p-0 mb-3">
						<div class="px-5 pt-5">
							<h2 class="font-semibold text-xl mb-0 kamus-text">Paling Mendekati</h2>
						</div>
						<div class="px-5 py-4">
							<div>
								@foreach($related as $temp)
									<div class="flex items-center space-x-4 hover:bg-gray-100 rounded -mx-2 px-3 py-1">
										<div class="flex-1">
											<h3 class="font-semibold capitalize">
												<a href="{{ route('kamus.search', [$temp->bahasa->kode, $temp->kata]) }}">
													{!! strtolower($query) == strtolower($temp->kata) ? '<b>'.$temp->kata.'</b>' : $temp->kata !!}
												</a>
											</h3>
											<div class="text-xs text-gray-500 -mt-0.5">Bahasa {{ $temp->bahasa->nama }}</div>
										</div>
									</div>
		            			@endforeach
		            		</div>
						</div>
					</div>
				@endif

				<div class="bg-white rounded-md shadow-sm border p-0">
					<div class="px-5 pt-5">
						<h2 class="font-semibold text-xl mb-0 kamus-text">Baru Ditambahkan</h2>
					</div>
					<div class="px-5 py-4">
						<div>
							@foreach(Modules\Qamus\Entities\Makna::latest()->paginate(5) as $temp)
								<div class="flex items-center space-x-4 hover:bg-gray-100 rounded -mx-2 px-3 py-1">
									<div class="flex-1">
										<h3 class="font-semibold capitalize">
											<a href="{{ route('kamus.search', [$temp->bahasa->kode, $temp->kata]) }}">
												{!! strtolower($query) == strtolower($temp->kata) ? '<b>'.$temp->kata.'</b>' : $temp->kata !!}
											</a>
										</h3>
										<div class="text-xs text-gray-500 -mt-0.5">Bahasa {{ $temp->bahasa->nama }}</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>

            </div>
        </div>
    </div>
@endsection