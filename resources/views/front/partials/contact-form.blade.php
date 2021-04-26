 <section class="forms mt-0">
     <form action="{{ route('new-message') }}" method="POST">
         @csrf
         <div class="row">
             <div class="section-heading text-center">
                 <h2>Formular de contact</h2>
             </div>

             <div class="col-md-12">
                 <fieldset>
                     <input name="name" type="text" class="form-control" id="name" placeholder="Numele Dvs..."
                         required="">
                 </fieldset>
             </div>

             <div class="col-md-12">
                 <fieldset>
                     <input name="email" type="text" class="form-control" id="email" placeholder="Adresa de email..."
                         required="">
                 </fieldset>
             </div>

             <div class="col-md-12">
                 <fieldset>
                     <input name="phone" type="text" class="form-control" id="name"
                         placeholder="Telefon mobil (optional)...">
                 </fieldset>
             </div>
             <div class="col-md-12">
                 <select name="subject" id="category">
                     <option value="categories" selected>Subiectul mesajului (optional)</option>
                     <option value="general">General</option>
                     <option value="facturi">Facturi</option>
                     <option value="tehnic">Tehnic</option>
                     <option value="oferta">Oferte si Promotii</option>
                 </select>
             </div>

             <div class="col-md-12">
                 <textarea name="message" id="message" placeholder="Mesajul Dvs..." rows="6"></textarea>
             </div>
             <div class="col-md-12">
                 <div class="radio-item">
                     <input name="accept" type="checkbox" id="demo-priority-small" value="true" required>
                     <label for="demo-priority-small"><a
                             href="{{ route('page.info', config('custominfo.politic')) }}">Accept politica de
                             confidentialitate a
                             datelor</a></label>
                 </div>
             </div>
             <div class="col-md-12">
                 <button type="submit" id="form-submit" class="button w-100">Trimite mesaj</button>
             </div>
         </div>
     </form>
 </section>
