<div class="dropdown-menu dropdown-menu-right notification" style="overflow: auto; max-height: 500px;">
    <div class="noti-head">
        <h6 class="d-inline-block m-b-0">الإشعارات</h6>
        <div class="float-right">
            <a href="#!" class="m-r-10"></a>
            <a href="#!"></a>
        </div>
    </div>
    <ul class="noti-body" id="notif-bar-app">
        <li class="n-title">
            <p class="m-b-0">إشعارات تذكير </p>
        </li>
        <li class="notification" v-for="item in items.notifsRappel">
            <div class="media">
                <div class="media-body">
                    <p><strong>@{{ item.texte }}</strong>
                        <span class="n-time text-muted"><button type="button" class="btn btn-default"
                                @click="goToAction(item.id)">
                                <i class="icon feather icon-eye m-r-10" title="وضع علامة مقروءة"></i> </button>
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
<!-- Vue JS AXIOS -->
<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/vue-axios.min.js') }}"></script>

<script>
    new Vue({
        el: '#notif-bar-app',
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
                    alert(JSON.stringify(items))

                }).catch(err => {});
            },
            goToAction(id) {
                axios.post('/notifAction')
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
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }
    })
</script>
