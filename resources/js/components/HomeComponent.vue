<template>
    <div class="body">
        <div class="container-fluid h-50">
            <div class="row justify-content-center h-50">
                <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." name="" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <ui class="contacts">
                            <li class="active" v-for="friend in FriendList" v-on:click="ViewMessage(friend.id)">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img :src="friend.avatar" class="rounded-circle user_img">
                                            <span v-if="friend.is_active == 1"  class="online_icon"></span>
                                            <span v-else  class="offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>{{ friend.name }}</span>
                                            <p>{{ friend.username }}</p>
                                        </div>
                                    </div>
                            </li>
                        </ui>
                    </div>
                    <div class="card-footer"></div>
                </div></div>
                <div class="col-md-8 col-xl-9 chat"  >
                    <div class="card" v-if="ActiveUser.name">
                        <div class="card-header msg_head" >

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img :src="ActiveUser.avatar" class="rounded-circle user_img">
                                            <span v-if="ActiveUser.is_active == 1"  class="online_icon"></span>
                                            <span v-else  class="offline"></span>
                                        </div>
                                        <div class="user_info" >
                                            <span>{{ ActiveUser.name }}</span>
                                            <p>{{ ActiveUser.username }} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center" >
                                    <div class="video_cam">
                                        <span><i class="fas fa-video"></i></span>
                                        <span><i class="fas fa-phone"></i></span>
                                    </div>
                                    <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                                    <div class="action_menu">
                                        <ul>
                                            <li><i class="fas fa-user-circle"></i> View profile</li>
                                            <li><i class="fas fa-users"></i> Add to close friends</li>
                                            <li><i class="fas fa-plus"></i> Add to group</li>
                                            <li><i class="fas fa-ban"></i> Block</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body msg_card_body"  >
                            <div class="d-flex justify-content-start mb-4" v-for="text in message">
                                <div class="img_cont_msg">
                                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer">
                                    {{ text.message }}
                                    <span class="msg_time">8:40 AM, Today</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    Hi Khalid i am good tnx how about you?
                                    <span class="msg_time_send">8:55 AM, Today</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="input-group">
                                <input name="" class="form-control type_msg" placeholder="Type your message...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                FriendList:[],
                ActiveUser:[],
                active_status:'offline',
                message:[],
            }
        },
        mounted() {
            axios.get('/user-list').then(response =>{
                this.FriendList = response.data;
                // this.active_status = response.data.is_active;
            }).catch(error=>{
                console.log(error);
            })
        },
        methods:{
            ViewMessage(id){
                axios.get('view-message/'+id)
                .then(response => {
                    this.ActiveUser = response.data[0];
                    this.message = response.data[1];
                    console.log(this.message);
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>
    .body{
        height: 100%;
        margin: 0;
        background: #7F7FD5;
        background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
    }

    .chat{
        margin-top: auto;
        margin-bottom: auto;
    }
    .card {
        height: 635px;
        border-radius: 15px !important;
        background-color: rgba(0,0,0,0.4) !important;
    }
    .contacts_body{
        padding:  0.75rem 0 !important;
        overflow-y: auto;
        white-space: nowrap;
    }
    .msg_card_body{
        overflow-y: auto;
    }
    .card-header{
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 0 !important;
    }
    .card-footer{
        border-radius: 0 0 15px 15px !important;
        border-top: 0 !important;
    }
    .container{
        align-content: center;
    }
    .search{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color:white !important;
    }
    .search:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .type_msg {
        background-color: rgba(0,0,0,0.3) !important;
        border: 0 !important;
        color: white !important;
        height: 47px !important;
        overflow-y: auto;
    }
    .type_msg:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .attach_btn{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .send_btn {
        border-radius: 0 15px 15px 0 !important;
        background-color: #82ccdd !important;
        border: 0 !important;
        color: white !important;
        cursor: pointer;
        width: 83px;
        text-align: center;
        font-size: 22px;
    }
    .search_btn{
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .contacts{
        list-style: none;
        padding: 0;
    }
    .contacts li{
        width: 100% !important;
        padding: 5px 10px;
        margin-bottom: 15px !important;
        cursor: pointer;
    }
    .active :hover{
        background-color: rgba(0, 0, 0, 0.03);
    }
    .user_img{
        height: 50px;
        width: 50px;
        border:1.5px solid #f5f6fa;

    }
    .user_img_msg[data-v-782dcf83] {
        height: 22px;
        width: 22px;
        border: 1.5px solid #f5f6fa;
    }
    .img_cont{
        position: relative;
        height: 50px;
        width: 50px;
    }
    .img_cont_msg[data-v-782dcf83] {
        height: 13px;
        width: 28px;
    }
    .online_icon{
        position: absolute;
        height: 15px;
        width:15px;
        background-color: #4cd137;
        border-radius: 50%;
        bottom: 0.2em;
        right: 0.4em;
        border:1.5px solid white;
    }
    .offline{
        position: absolute;
        height: 15px;
        width:15px;
         background-color: #c23616 !important;
        border-radius: 50%;
        bottom: 0.2em;
        right: 0.4em;
        border:1.5px solid white;
    }
    .user_info{
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 15px;
    }
    .user_info span{
        font-size: 15px;
        color: white;
    }
    .user_info p{
        font-size: 10px;
        color: rgba(255,255,255,0.6);
    }
    .video_cam{
        margin-left: 50px;
        margin-top: 5px;
    }
    .video_cam span{
        color: white;
        font-size: 20px;
        cursor: pointer;
        margin-right: 20px;
    }
    .msg_cotainer[data-v-782dcf83] {
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 0px;
        border-radius: 25px;
        background-color: #82ccdd;
        padding: 2px 11px;
        position: relative;
        font-size: 11px;
    }
    .msg_cotainer_send {
        margin-top: auto;
        margin-bottom: auto;
        margin-right: 0px;
        border-radius: 25px;
        background-color: #78e08f;
        padding: 2px 11px;
        position: relative;
        font-size: 11px;
    }
    .msg_time[data-v-782dcf83] {
        position: absolute;
        left: 10px;
        bottom: -12px;
        color: rgba(255,255,255,0.5);
        font-size: 8px;
    }
    .msg_time_send{
        position: absolute;
        right: 10px;
        bottom: -12px;
        color: rgba(255,255,255,0.5);
        font-size: 8px;
    }
    .msg_head{
        position: relative;
    }
    #action_menu_btn{
        position: absolute;
        right: 10px;
        top: 10px;
        color: white;
        cursor: pointer;
        font-size: 20px;
    }
    .action_menu{
        z-index: 1;
        position: absolute;
        padding: 15px 0;
        background-color: rgba(0,0,0,0.5);
        color: white;
        border-radius: 15px;
        top: 30px;
        right: 15px;
        display: none;
    }
    .action_menu ul{
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .action_menu ul li{
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 5px;
    }
    .action_menu ul li i{
        padding-right: 10px;

    }
    .action_menu ul li:hover{
        cursor: pointer;
        background-color: rgba(0,0,0,0.2);
    }
    @media(max-width: 576px){
        .contacts_card{
            margin-bottom: 15px !important;
        }
    }

</style>
