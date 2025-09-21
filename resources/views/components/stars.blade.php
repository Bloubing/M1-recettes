 <div class="mt-5" x-data="{
     disabled: false,
     max_stars: 5,
     stars: {{ $recipe->userRating() == null ? 0 : $recipe->userRating()->stars }},
     value: {{ $recipe->userRating() == null ? 0 : $recipe->userRating()->stars }},
     hoverStar(star) {
         if (this.disabled) {
             return;
         }
 
         this.stars = star;
     },
     mouseLeftStar() {
         if (this.disabled) {
             return;
         }
 
         this.stars = this.value;
     },
     rate(star) {
         if (this.disabled) {
             return;
         }
 
         this.stars = star;
         this.value = star;
 
         $refs.rated.classList.remove('opacity-0');
         setTimeout(function() {
             $refs.rated.classList.add('opacity-0');
         }, 2000);
     },
     reset() {
         if (this.disabled) {
             return;
         }
 
         this.value = 0;
         this.stars = 0;
     }
 }" x-init="this.stars = this.value">
     <div class="max-w-6xl">

         <ul class="flex">
             <template x-for="star in max_stars">
                 <li @mouseover="hoverStar(star)" @mouseleave="mouseLeftStar" @click="rate(star)"
                     class="px-1 cursor-pointer" :class="{ 'text-gray-300 cursor-not-allowed': disabled }">
                     <svg x-show="star > stars" class="w-6 h-6 text-gray-300 fill-current"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                         <rect width="256" height="256" fill="none" />
                         <path
                             d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z" />
                     </svg>
                     <svg x-show="star <= stars" class="w-6 h-6 text-yellow-400 fill-current"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                         <rect width="256" height="256" fill="none" />
                         <path
                             d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z" />
                     </svg>
                 </li>
             </template>
         </ul>
     </div>
     <input x-model="value" class="hidden" name="stars" id="stars" required />

 </div>
