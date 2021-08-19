<template>
    <div class="row">
        <form @submit.prevent="submit_form()" v-if="!commentSuccess">
            <div class="mb-3">
                <label for="commentSubject" class="form-label">Тема комментария</label>
                <input type="text" class="form-control" id="commentSubject" v-model="subject">
                <div class="alert alert-warning" role="alert" v-if="errorsMessage.subject">
                    {{errorsMessage.subject[0]}}
                </div>
            </div>
            <div class="mb-3">
                <label for="commentBody" class="form-label">Комментарий</label>
                <textarea class="form-control" id="commentBody" rows="3" v-model="body"></textarea>
                <div class="alert alert-warning" role="alert" v-if="errorsMessage.body">
                    {{errorsMessage.body[0]}}
                </div>
            </div>
            <button class="btn btn-success" type="submit">Отправить</button>
        </form>
        <div class="alert alert-success" role="alert" v-else>
            Комментарий успешно отправлен!
        </div>
        <div class="list-group" v-for="comment in comments">
            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <img src="https://via.placeholder.com/50/5F113B/FFFFFF/?text=User" class="rounded me-2" alt="...">
                    <h5 class="mb-1">{{ comment.subject }}</h5>
                    <small>{{ comment.created_at }}</small>
                </div>
                <p class="mb-1">{{ comment.body}}</p>
                <small>And some small print.</small>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            subject: '',
            body: ''
        }
    },
    computed: {
        comments() {
            return this.$store.state.article.article.comments;
        },
        commentSuccess(){
            return this.$store.state.article.commentSuccess;
        },
        errorsMessage(){
            return this.$store.state.article.errors;
        }
    },
    methods: {
        submit_form(){
            this.$store.dispatch('article/addComment', {
                subject: this.subject,
                body: this.body,
                article_id : this.$store.state.article.article.id
            })
        }
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>

<style scoped>
</style>