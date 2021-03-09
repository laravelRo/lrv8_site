 <div id="sidebar">

     <div class="inner">

         <!-- Search Box -->
         <section id="search" class="alt">
             <form method="get" action="#">
                 <input type="text" name="search" id="search" placeholder="Search..." />
             </form>
         </section>

         <!-- Menu -->
         @include('front.partials.side-menu')


         <!-- Featured Posts -->
         @include('front.partials.side-promo')

         <!-- Footer -->
         <footer id="footer">
             <p class="copyright">
                 Copyright &copy; {{ date('Y') }} Web Desigh

             </p>
         </footer>

     </div>
 </div>
