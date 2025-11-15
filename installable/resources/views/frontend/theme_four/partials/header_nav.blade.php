 <div class="header-bottom px-4 bg-white">
   <div class="container">
    <div class="main-navbar">
     <nav class="navbar navbar-expand-lg">
       <a class="navbar-brand" href="{{ route('index') }}" target="_self" title="Link">
         <img src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="website logo" width="200">
       </a>
       <!-- Navigation items -->
       @php
         $links = json_decode($menus, true);
       @endphp
       <div class="collapse navbar-collapse">
         <ul id="mainMenu" class="navbar-nav mobile-item mx-auto">
           @foreach ($links as $link)
             @php
               $href = getHref($link, $currentLanguageInfo->id);
             @endphp

             @if (!array_key_exists('children', $link))
               {{-- - Level1 links which doesn't have dropdown menus - --}}
                 <li lass="nav-item"><a href="{{ $href }}" target="{{ $link['target'] }}"
                     class="nav-link">{{ $link['text'] }}</a></li>

             @else
               <li class="nav-item">
                 {{-- - Level1 links which has dropdown menus - --}}
                 <a href="{{ $href }}" target="{{ $link['target'] }}"
                   class="nav-link toggle">{{ $link['text'] }}</a>

                 <ul class="menu-dropdown">
                   {{-- START: 2nd level links --}}
                   @foreach ($link['children'] as $level2)
                     @php
                       $l2Href = getHref($level2, $currentLanguageInfo->id);
                     @endphp

                     <li @if (array_key_exists('children', $level2)) class="nav-item" @endif>
                       <a href="{{ $l2Href }}" target="{{ $level2['target'] }}"
                         class="nav-link">{{ $level2['text'] }}</a>

                       @if (array_key_exists('children', $level2))
                         <ul class="menu-dropdown">
                           @foreach ($level2['children'] as $level3)
                             @php
                               $l3Href = getHref($level3, $currentLanguageInfo->id);
                             @endphp
                             <li class="nav-item"><a href="{{ $l3Href }}" target="{{ $level3['target'] }}"
                                 class="nav-link">{{ $level3['text'] }}</a></li>
                           @endforeach
                         </ul>
                       @endif
                     </li>
                   @endforeach
                   {{-- END: 2nd level links --}}
                 </ul>

               </li>
             @endif
           @endforeach
         </ul>
       </div>
       <div class="more-option mobile-item">
         <div class="item">
           <form action="{{ route('change_language') }}" method="GET">
             <div class="language">
               <select class="niceselect" name="lang_code" onchange="this.form.submit()">
                 @foreach ($allLanguageInfos as $languageInfo)
                   <option value="{{ $languageInfo->code }}"
                     {{ $languageInfo->code == $currentLanguageInfo->code ? 'selected' : '' }}>
                     {{ $languageInfo->name }}
                   </option>
                 @endforeach
               </select>
             </div>
           </form>
         </div>
         @if (Auth::check())
           <div class="item">
             <a href="{{ route('user.dashboard') }}" class="btn-icon" title="Link">
               <i class="far fa-user-circle"></i>
             </a>
           </div>
         @else
           <div class="item">
             <a href="{{ route('user.login') }}" class="btn btn-md btn-primary" title="Login" target="_self">{{ __('LogIn') }}</a>
           </div>
         @endif
       </div>
     </nav>
   </div>
   </div>
 </div>
