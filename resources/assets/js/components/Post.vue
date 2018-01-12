<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <button  class="btn btn-primary btn-xs pull-right" @click="initAddPost()">
                            + Новая должность
                    </button>
                    Должности</div>
 
                    <div class="panel-body">
 				      <table class="table table-bordered table-striped table-responsive" v-if="posts.length > 0">
                            <tbody>
                                <tr>
                                    <th>Название</th>
                                    <th>Оклад</th>
                                    <th>Приоритет</th>
                                    <th>Действие</th>
                                </tr>
                                <tr v-for="(post, index) in posts">
                                    <td>{{ post.name }}</td>
                                    <td>{{ post.salary }}</td>
                                    <td>{{ post.post_priority }}</td>
                                    <td>
                                        <button class="btn btn-success btn-xs" @click="initUpdatePost(index)">Редактировать</button>
                                        <button class="btn btn-danger btn-xs" @click="deletePost(index)">Удалить</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        
        <div class="modal fade" tabindex="-1" role="dialog" id="add_post_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Новая должность</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" v-if="postserrors">
                            <ul>
                                <li v-for="value in postserrors">{{ value[0] }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label for="name">Название:</label>
                            <input type="text" name="name" id="name" placeholder="Название должности" class="form-control"
                                   v-model="post.name">
                        </div>
                        <div class="form-group">
                            <label for="salary">Оклад:</label>
                            <input type="text" name="salary" id="salary" placeholder="Оклад" class="form-control"
                                   v-model="post.salary">
                        </div>
                        <div class="form-group">
                            <label for="priority">Приоритет:</label>
                            <input type="text" name="priority" id="priority" placeholder="Приоритет" class="form-control"
                                   v-model="post.priority">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" @click="createPost" class="btn btn-primary">Создать должность</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" tabindex="-1" role="dialog" id="update_post_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Изменение должности</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="postserrors">
                            <ul>
                                <li v-for="value in postserrors">{{ value[0] }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" placeholder="Название" class="form-control" v-model="update_post.name">
                        </div>
                        <div class="form-group">
                            <label>Оклад</label>
                            <input type="text" placeholder="Оклад" class="form-control" v-model="update_post.salary">
                        </div>
                        <div class="form-group">
                            <label>Приоритет</label>
                            <input type="text" placeholder="Приоритет" class="form-control" v-model="update_post.post_priority">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" @click="updatePost" class="btn btn-primary">Изменить должность</button>
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
                post: {
                	id: '',
                    name: '',
                    salary: '',
                    priority: ''
                },
                postserrors: null,
                posts:[],
                update_post: {}
				}
        },
    	methods:{
    		initUpdatePost(index){
    			this.postserrors = null;
    			this.update_post = this.posts[index];
    			$("#update_post_model").modal("show");				
			},
    		initAddPost()
            {
            	this.post.id="";
            	this.post.name="";
            	this.post.salary="";
            	this.post.priority="";
                this.postserrors = null;
                $("#add_post_model").modal("show");
            },
    		deletePost(index)
    		{
    			let conf = confirm(`Удалить должность "` + this.posts[index].name + `"`);
                if (conf === true) {
                    axios.delete('/post/' + this.posts[index].id)
                        .then(response => {
                        	this.posts.splice(index, 1);
 	                    })
 	                    .catch(error => {
 	                    	 alert("Ошибка: " + error.response.data.errors.message );
 							 console.log("Error delete post " + this.posts[index].name);
                        });
                }
			},
			createPost()
			{
				axios.post('/post', {
                   name: this.post.name,
                   salary: this.post.salary,
                   priority: this.post.priority
                }).then(response => {
                    this.posts = response.data.posts;
                    $("#add_post_model").modal("hide");
                }).catch(error => {
    	               if (error.response.data.errors) {
                            this.postserrors = error.response.data.errors;
           	          }
                });
			},
			readPosts()
            {
                axios.get('/post')
                    .then(response => {
                        this.posts = response.data.posts;
                     });
            },
            updatePost()
            {
				axios.patch('/post/' + this.update_post.id, {
                   name: this.update_post.name,
                   salary: this.update_post.salary,
                   priority: this.update_post.post_priority
                }).then(response => {
                    this.posts = response.data.posts;
                    $("#update_post_model").modal("hide");
                }).catch(error => {
    	               if (error.response.data.errors) {
                            this.postserrors = error.response.data.errors;
           	          }
                });
				
			}
		},
        mounted() {
 				this.readPosts();
        }
    }
</script>