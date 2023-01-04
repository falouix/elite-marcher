 <!-- Incomeing-section start -->
 @php
     if ($col == '12') {
         $classCol = 'col-md-12';
     } else {
         $classCol = '';
     }
 @endphp
 <div class="card user-list table-card {{ $classCol }}">
     <div class="card-header">
         <h5>الإشعارات</h5>
     </div>
     <div class="card-body pb-0">
         <div class="table-responsive">
             <div class="user-scroll" style="height:385px;position:relative;">
                 <table class="table table-hover m-b-0">
                     <tbody id="app">
                         @can('notifs-rappel')
                             <tr>
                                 <td></td>
                                 <td><i class="text-c-green f-20">إشعارات التذكير</i></td>
                             </tr>
                             <tr v-for="item in  items.notifsRappel">
                                 <td><button type="button" class="btn btn-default" title="" data-toggle="tooltip"
                                         data-original-title="وضع علامة مقروءة" @click="goToAction(item.id)"><i
                                             class="icon feather icon-eye"></i> تثبيت</button></td>
                                 <td style="white-space: break-spaces;">@{{ item.texte }}</td>
                             </tr>
                         @endcan
                         @can('notifs-validation')
                             <tr>
                                 <td></td>
                                 <td><i class="text-c-red f-20">إشعارات المهام</i></td>
                             </tr>
                             <tr class="table-warning" v-for="item in  items.notifsValidation">
                                 <td>
                                     <button type="button" class="btn btn-gradient-danger" title=""
                                         data-toggle="tooltip" data-original-title="الإطلاع والتثبيت"
                                         @click="goToAction(item.id)"><i class="feather icon-check-square"></i>
                                         تثبيت</button>
                                 </td>
                                 <td style="white-space: break-spaces;">@{{ item.texte }}</td>
                             </tr>
                         @endcan
                         @can('notifs-message')
                             <tr>
                                 <td></td>
                                 <td><i class="text-c-blue f-20">إشعارات أخرى</i></td>
                             </tr>
                             <tr v-for="item in  items.notifsMessage">
                                 <td><button type="button" class="btn btn-default" title="" data-toggle="tooltip"
                                         data-original-title="وضع علامة مقروءة" @click="goToAction(item.id)"><i
                                             class="icon feather icon-eye"></i> تثبيت</button></td>
                                 <td style="white-space: break-spaces;">@{{ item.texte }}
                                     {{-- item.texte.length>150?item.texte.substring(0,150)+'...':item.texte --}}</td>
                             </tr>
                         @endcan
                     </tbody>
                 </table>
             </div>
         </div>
         <div class="card-footer">
             <h6 class="text-center m-0"><a href="{{ route('notifs.index') }}" target="_blank">عرض الكل</a></h6>
         </div>
     </div>
 </div>
 <!-- Incomeing-section end -->

 <script>


     new Vue({
         el: '#app',
         data() {
             return {
                 now: null,
                 items: []
             };
         },
         created: function() {

             this.getNotifs(
                 '/getNotifs'
             );

             setInterval(() => {
                 this.getNotifs(
                     '/getNotifs'
                 );

             }, 1000 * 60 * 30);
         },

         methods: {
             getNotifs(uri) {
                 axios.get(uri).then((res) => {
                     this.now = 'sgsgsgssgsgs';
                     this.items = res.data
                 }).catch(err => {});
             },
             goToAction(id) {
                 axios.post('/notifAction')
                 // Send a POST request
                 axios({
                         method: 'post',
                         url: '/notifAction',
                         data: {
                             notifs_id: id,
                         }
                     })
                     .then(function(response) {
                         console.log(response);
                         PnotifyCustom(response.data)
                     })
                     .catch(function(error) {
                         console.log(error);
                     });
             }
         }
     })
 </script>
