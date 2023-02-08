@if(auth::user()->user_type == 'admin')
    <button type="button" class="btn btn-icon btn-rounded btn-danger"
    title="تثبيت المهمة" onclick="goToAction({{ $id }})"><i
        class="icon feather icon-check-circle"></i></button>
<script>
function goToAction(id) {
    var ref = this
    if (confirm("أنت بصدد تثبيت الإشعار!" + "\n" +
            "سيقوم البرنامج بوضع علامة مقروءة وتثبيت الإشعار")) {


        // Send a POST request
        axios({
                method: 'post',
                url: '/notifAction',
                data: {
                    notifs_id: id,
                    mode: 'admin'
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

}
</script>
@endif

