<div id="notif-bar-app">
<a class="dropdown-toggle" href="#" data-toggle="dropdown">

    <v-icon v-if="bellIcon === 'on'" ><i class="icon feather icon-bell" style="color:red;"></i></v-icon>
        <v-icon v-else><i class="icon feather icon-bell-off"></i></v-icon>
</a>


<div class="dropdown-menu dropdown-menu-right notification" style="overflow: auto; max-height: 500px;">
    <div class="noti-head">
        <h6 class="d-inline-block m-b-0">الإشعارات</h6>
        <div class="float-right">
            <a href="#!" class="m-r-10"></a>
            <a href="#!"></a>
        </div>
    </div>
    <ul class="noti-body" >
        <li class="n-title">
            <p class="m-b-0">إشعارات تذكير </p>
        </li>
        <li class="notification" v-for="item in items.notifsRappel">
            <div class="media">
                <div class="media-body">
                    <p><strong>@{{ item.texte }}</strong>
                        <span class="n-time text-muted"><button type="button" class="btn btn-default"
                                @click="goToAction(item.id)">
                                <i class="icon feather icon-eye m-r-10" title="تثبيت المهمة"></i> </button>
                            <a v-if="item.action !=''" :href="item.action" title="الذهاب إلى المهمة"
                                target="_blank"><i class="icon feather icon-external-link"></i></a>
                        </span>
                    </p>
                </div>
            </div>
        </li>
        <li class="n-title">
            <p class="m-b-0">إشعارات المهام</p>
        </li>
        <li class="notification" v-for="item in items.notifsValidation">
            <div class="media">
                <div class="media-body">
                    <p><strong>@{{ item.texte }}</strong>
                        <span class="n-time text-muted"><button type="button" class="btn btn-default"
                                @click="goToAction(item.id)">
                                <i class="icon feather icon-check-circle m-r-10" title="تثبيت"></i> </button>
                            <a v-if="item.action !=''" :href="item.action" title="الذهاب إلى المهمة"
                                target="_blank"><i class="icon feather icon-external-link"></i></a>
                        </span>
                    </p>
                </div>
            </div>
        </li>
        <li class="n-title">
            <p class="m-b-0">إشعارات أخرى </p>
        </li>
        <li class="notification" v-for="item in items.notifsMessage">
            <div class="media">
                <div class="media-body">
                    <p><strong>@{{ item.texte }}</strong>
                        <span class="n-time text-muted"><button type="button" class="btn btn-default"
                                @click="goToAction(item.id)">
                                <i class="icon feather icon-eye m-r-10"></i> </button>
                        </span>
                    </p>
                </div>
            </div>
        </li>

    </ul>
    <div class="noti-footer">
        <a href="{{ route('notifs.index') }}">عرض الكل</a>
    </div>
</div>
</div>





<!-- Vue JS AXIOS -->
<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/vue-axios.min.js') }}"></script>

<script>
    new Vue({
        el: '#notif-bar-app',
        data() {
            return {
                bellIcon: 'off',
                items: []
            };
        },
        created: function() {
            const timer = setInterval(() => {
                this.getNotifs(
                    '/getNotifs'
                );
            }, 3000);

            const timerDsktop = setInterval(() => {
               this.getDesktopNotifs();
           }, 180000);

           this.$once("hook:beforeDestroy", () => {
               clearInterval(timer);
           });
           this.$once("hook:beforeDestroy", () => {
               clearInterval(timerDsktop);
           });
        },

        methods: {

            getNotifs(uri) {
                axios.get(uri).then((res) => {
                    this.items = res.data
                     let countNotif = this.items.notifsRappel.length + this.items.notifsValidation.length + this.items.notifsMessage.length
                    if (countNotif > 0){
                        this.bellIcon = 'on';
                    }
                    console.log("count notifs :"+countNotif)

                }).catch(err => {});
            },
            goToAction(id) {
                var ref = this
                if (confirm("أنت بصدد تثبيت الإشعار!" + "\n" +
                        "سيقوم البرنامج بوضع علامة مقروءة وتثبيت الإشعار")) {


                    // Send a POST request
                    axios({
                            method: 'post',
                            url: '/notifAction',
                            data: {
                                notifs_id: id
                            }
                        })
                        .then(function(response) {
                            console.log(response);
                            PnotifyCustom(response.data)
                            ref.getNotifs(
                                '/getNotifs'
                            );

                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }

            },
            getDesktopNotifs(){
               $.ajax({
               url: "{{route('notifs.desktop')}}",
               type: 'POST',
               success: function(response) {
                 // alert(response.notifsRappelCount)
                 showNotifG(response.notifsRappelCount, response.notifsValidationCount, response.notifsMessageCount)
               },
               error: function(errors) {
               }
           }); // ajax end
            }
        }
    })
</script>

