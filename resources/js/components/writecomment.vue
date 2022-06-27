<template>
    <div>
        <div class="cmnt_frm mar_t30">
            <h2 class="post_dtls_title2 pad_b20">Leave A Comment</h2>
            <div class="cmnt_frm_all">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="cmnt_input">
                            <p class="mar_b10">MESSAGE</p>
                            <textarea v-model="data.commentText" placeholder="Type your comment" name="message" required=""></textarea>
                        </div>
                    </div>
                    <div class="dtls_frm_btn mar_t20">
                        <button class="btn1" @click="addcomment">send message</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            data: {
                commentText: '',
            }
        }
    },
    methods: {
        async addcomment(){
            console.log('afaf')
            const res = await this.callApi('post', '/app/addComment', this.data)
            console.log('afaf',res)
            if(res.status == 200 ){
                console.log('Ok')
            }
            console.log('Not Done')
        }
    }
}
</script>
