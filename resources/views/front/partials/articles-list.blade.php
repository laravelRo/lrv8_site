 {{-- === componenta lista articole ==== --}}
 <div class="list-title">
     {{ $title }} - {{ $pages->total() }}
 </div>

 <div>
     {{ $pages->links() }}
 </div>

 @foreach ($pages as $page)

     <div class="card article my-4 p-5 @if ($loop->odd) shadow bg-light @endif">

         <div class="row">
             <div class="col-md-6 article-info">

                 <a href="{{ route('article', $page->slug) }}">
                     <div class="photo-article">
                         <span class="badge badge-secondary float-left " style="width: max-content;">
                             {{ request('page') ? $loop->iteration + $pages->perPage() * (request('page') - 1) : $loop->iteration }}
                         </span>

                         <img src="/images/pages/{{ $page->photo }}" alt="" title="{{ $page->meta_description }}">
                     </div>

                     <div class="card-title">
                         {{ $page->title }}
                     </div>
                 </a>

                 <div class="meta">
                     <b> autor:</b> <a href="{{ route('articles', ['author' => $page->author->id]) }}"><span
                             class="text-light">{{ $page->author->name }}</span></a>
                 </div>
                 <div>
                     <a href="{{ route('article', $page->slug) }}" class="btn btn-primary float-right ">Vezi articol
                         <i class="fa fa-link"></i></a>
                 </div>

             </div>
             <div class="col-md-6 article-info">

                 <h2 class="subtitle">{{ $page->subtitle }}</h2>
                 <div class="excerpt">
                     {!! $page->excerpt !!}

                 </div>

                 <div class="meta">
                     <b> data publicarii:</b> <span class="text-light">
                         {{ $page->published_at->format('d M Y') }}</span> &nbsp
                     <b> vizualizari:</b> <span class="text-light">
                         {{ $page->views }}</span>


                 </div>



             </div>

         </div>

     </div>
 @endforeach

 <div>
     {{ $pages->links() }}
 </div>

 {{-- <===== componenta lista articole ==== --}}
