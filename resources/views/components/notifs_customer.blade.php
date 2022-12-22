 <!-- Incomeing-section start -->
 @php
 if ($col == "12"){
     $classCol = "col-md-12";
 }else {
     $classCol="";
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
                  <thead>
                      <tr>
                          <th>نص الإشعار</th>
                          <th>قرار</th>
                      </tr>
                  </thead>
                  <tbody id="app">
                      <tr v-for="item in items">
                          <td>@{{ item.texte.length > 150 ? item.texte.substring(0, 150) + '...' : item.texte }}</td>

                          <td><label class="label label-danger">الإطلاع</label></td>
                      </tr>

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
                  '/getNotifsCsutomer'
              );

              setInterval(() => {
                  this.getNotifs(
                      '/getNotifsCsutomer'
                  );

              }, 1000 * 60 * 30);
          },

          methods: {

              getNotifs(uri) {

                  axios.get(uri).then((res) => {
                      this.now = 'sgsgsgssgsgs';
                      this.items = res.data

                  }).catch(err => {});
              }
          }
      })
  </script>
