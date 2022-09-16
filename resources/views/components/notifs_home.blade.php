 <!-- Incomeing-section start -->

    <div class="card">
        <div class="card-header">
            <h5>الإشعارات</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <div class="incomeing-scroll ps ps--active-y" style="height:385px;position:relative;">
                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Regarding</th>
                                <th>Activity Type</th>
                            </tr>
                        </thead>
                        <tbody id="app">
                            <tr v-for ="item in items">
                                <td>@{{ item.texte }}</td>
                                <td>Task</td>
                                <td><label class="label label-danger">Open</label></td>
                            </tr>

                        </tbody>
                    </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 385px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 278px;"></div></div></div>
            </div>
        </div>
        <div class="card-footer">
            <h6 class="text-center m-0"><a href="{{ route('notifs.index') }}" target="_blank">عرض الكل</a></h6>
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
                    items.forEach(element => {
                        alert(element.texte)
                    });

                }).catch(err => {});
            }
        }
    })
</script>
