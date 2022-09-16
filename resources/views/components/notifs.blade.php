
<div class="dropdown-menu dropdown-menu-right notification">
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
        <li class="notification" v-for="item in items">
            <div class="media">
                <div class="media-body">
                    <p><strong>@{{ item.texte }}</strong>
                        <span class="n-time text-muted"><a href="#"><i class="icon feather icon-eye m-r-10"></i> </a></span>
                    </p>
                    <p>مدة الضمان الوقتي للإستشارة عدد 062022/211 اوشكت على الإنتهاء</p>
                </div>
            </div>
        </li>
        <li class="n-title">
            <p class="m-b-0">إشعارات لتثبيت المعلومات </p>
        </li>
        <li class="notification">
            <div class="media">
               <div class="media-body">
                    <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                    <p>currently login</p>
                </div>
            </div>
        </li>
        <li class="n-title">
            <p class="m-b-0">إشعارات المهام </p>
        </li>
        <li class="notification">
            <div class="media">
                <div class="media-body">
                    <p><strong>John Doe</strong>
                        <span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span>
                    </p>
                    <p>New ticket Added</p>
                </div>
            </div>
        </li>
        <li class="notification">
            <div class="media">
                <div class="media-body">
                    <p><strong>John Doe</strong>
                        <span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span>
                    </p>
                    <p>New ticket Added</p>
                </div>
            </div>
        </li>
        <li class="notification">
            <div class="media">
                <div class="media-body">
                    <p><strong>John Doe</strong>
                        <span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span>
                    </p>
                    <p>New ticket Added</p>
                </div>
            </div>
        </li>

    </ul>
    <div class="noti-footer">
        <a href="#!">عرض الكل</a>
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
                'http://127.0.0.1:8000/getNotifs'
            );

            setInterval(() => {
                this.getNotifs(
                    'http://127.0.0.1:8000/getNotifs'
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
